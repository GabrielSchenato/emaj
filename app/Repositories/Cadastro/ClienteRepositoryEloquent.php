<?php

namespace Emaj\Repositories\Cadastro;

use Emaj\Criteria\MesCriteria;
use Emaj\Criteria\PreAtendimentoCriteria;
use Emaj\Entities\Cadastro\Cliente;
use Emaj\Repositories\AbstractRepository;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Repository responsável por gerenciar a entidade Cliente
 *
 * PHP version 7.2
 *
 * @category   Repository
 * @package    Cadastro
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
class ClienteRepositoryEloquent extends AbstractRepository implements ClienteRepository
{

    /**
     * @var TelefoneRepository
     */
    private $telefoneRepository;

    /**
     * @var ComposicaoFamiliarRepository
     */
    private $composicaoFamiliarRepository;

    /**
     * @var EnderecoRepository
     */
    private $enderecoRepository;

    public function __construct(Container $app, EnderecoRepository $enderecoRepository, ComposicaoFamiliarRepository $composicaoFamiliarRepository, TelefoneRepository $telefoneRepository)
    {
        parent::__construct($app);
        $this->enderecoRepository = $enderecoRepository;
        $this->composicaoFamiliarRepository = $composicaoFamiliarRepository;
        $this->telefoneRepository = $telefoneRepository;
        $this->setWrapNameException('cliente');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Cliente::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @override
     * Save a new entity in repository
     *
     * @throws ValidatorException
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->save($attributes, null);
    }

    /**
     * @override
     * Update a entity in repository by id
     *
     * @throws ValidatorException
     *
     * @param array $attributes
     * @param       $id
     *
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        return $this->save($attributes, $id);
    }

    /**
     * Método responsável por criar ou atualizar o registro de um cliente.
     * 
     * @param array $attributes
     * @param int | null $id
     * @return array
     * @throws ValidationException
     */
    private function save(array $attributes, $id = null)
    {
        try {
            DB::beginTransaction();

            $required = $this->required($attributes['informacoesPessoais']);
            $this->enderecoRepository->setNeedToValidate($required);
            $this->composicaoFamiliarRepository->setNeedToValidate($required);
            $this->telefoneRepository->setNeedToValidate($required);

            $cliente = parent::updateOrCreate(['id' => $id], $attributes['informacoesPessoais']);

            $endereco = $this->saveEndereco($attributes, $cliente->id);
            $composicaoFamiliar = $this->saveComposicaoFamiliar($attributes, $cliente->id);
            $telefones = $this->saveTelefones($attributes, $cliente->id);

            DB::commit();
            return [
                'informacoesPessoais' => $cliente,
                'endereco' => $endereco,
                'composicaoFamiliar' => $composicaoFamiliar,
                'telefones' => $telefones
            ];
        } catch (ValidationException $ex) {
            DB::rollback();
            throw $ex;
        } catch (\Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }

    /**
     * Método responsável por criar ou atualizar o endereço do cliente.
     * 
     * @param array $attributes
     * @param int $idCliente
     * @return mixed
     */
    private function saveEndereco(array $attributes, int $idCliente)
    {
        $endereco = array_merge($attributes['endereco'], ['cliente_id' => $idCliente]);
        $id = $endereco['id'] ?? null;
        return $this->enderecoRepository->updateOrCreate(['id' => $id], $endereco);
    }

    /**
     * Método responsável por criar ou atualizar a composição familiar do cliente.
     * 
     * @param array $attributes
     * @param int $idCliente
     * @return mixed
     */
    private function saveComposicaoFamiliar(array $attributes, int $idCliente)
    {
        $composicaoFamiliar = array_merge($attributes['composicaoFamiliar'], ['cliente_id' => $idCliente]);
        $id = $composicaoFamiliar['id'] ?? null;
        return $this->composicaoFamiliarRepository->updateOrCreate(['id' => $id], $composicaoFamiliar);
    }

    /**
     * Método responsável por criar ou atualizar os telefones do cliente.
     * 
     * @param array $attributes
     * @param int $idCliente
     * @return mixed
     */
    private function saveTelefones(array $attributes, int $idCliente)
    {
        $telefones = [];
        foreach ($attributes['telefones'] as $telefone) {
            $telefone = array_merge($telefone, ['cliente_id' => $idCliente]);
            $id = $telefone['id'] ?? null;
            $telefones[] = $this->telefoneRepository->updateOrCreate(['id' => $id], $telefone);
        }
        return $telefones;
    }

    /**
     * Método responsável por retornar as regras a serem aplicadas ao criar ou editar
     * um registro
     * 
     * @param array $data
     * @param int $id
     * 
     * @return array Regras para serem aplicadas
     */
    public function getRules(array $data, int $id = null)
    {
        if ($this->required($data)) {
            return [
                'nome_completo' => ['required', 'min:4', 'max:255', Rule::unique('clientes')->ignore($id)],
                'cpf' => 'required',
                'rg' => 'required',
                'profissao' => 'required|max:100',
                'sexo' => ['required', Rule::in(['M', 'F'])],
                'estado_civil' => ['required', Rule::in(['Solteiro', 'Casado', 'Separado', 'Divorciado', 'Viúvo'])],
                'email' => ['nullable', 'email', Rule::unique('clientes')->ignore($id)],
                'renda' => 'required',
                'local_trabalho' => 'nullable|max:255',
                'nacionalidade_id' => 'required|numeric'
            ];
        }

        return [
            'nome_completo' => ['required', 'min:4', 'max:255', Rule::unique('clientes')->ignore($id)],
        ];
    }

    /**
     * Método responsável por o número de pré atendimentos no mês
     * 
     * @return int
     */
    public function getPreAtendimentosMes()
    {
        return $this->pushCriteria(PreAtendimentoCriteria::class)
                        ->pushCriteria(MesCriteria::class)
                        ->count();
    }

    /**
     * Verifica se os campos são obrigatórios
     * @param array $data
     * @return boolean
     */
    private function required($data)
    {
        if (isset($data['parte_contraria']) && $data['parte_contraria']) {
            return false;
        } else if (isset($data['pre_atendimento']) && $data['pre_atendimento']) {
            return false;
        }
        return true;
    }

    /**
     * Método responsável por buscar os dados e retornar para o autocomplete
     * 
     * @param string $value
     */
    public function getDataAutocomplete($value)
    {
        $this->applyCriteria();
        $this->applyScope();

        $model = $this->model->where(function ($query) use ($value) {
                    $query->where('nome_completo', 'LIKE', "%{$value}%")
                    ->orWhere('representado_assistido', 'LIKE', "%{$value}%")
                    ->orWhere('id', '=', (int) $value);
                })
                ->orderBy('nome_completo', 'asc')
                ->limit(10)
                ->get(['id', 'nome_completo', 'representado_assistido', 'cpf', 'rg', 'renda']);

        $this->resetModel();

        return $model;
    }

    /**
     * Método responsável por realizar a busca pelo valor e campo passado
     * @param array $values
     * @return mixed
     */
    public function getBySearch(array $values)
    {
        $criteria = $this->model->newQuery();
        if (isset($values['id'])) {
            $criteria->where('id', '=', (int) $values['id']);
        }
        if (isset($values['nome_completo'])) {
            $criteria->where('nome_completo', 'like', "%{$values['nome_completo']}%");
        }
        if (isset($values['cpf'])) {
            $criteria->where('cpf', 'like', "%{$values['cpf']}%");
        }
        if (isset($values['rg'])) {
            $criteria->where('rg', 'like', "%{$values['rg']}%");
        }
        if (isset($values['renda'])) {
            $criteria->where('renda', 'like', "%{$values['renda']}%");
        }
        if (isset($values['representado_assistido'])) {
            $criteria->where('representado_assistido', 'like', "%{$values['representado_assistido']}%");
        }
        if (isset($values['ativo'])) {
            $criteria->where('ativo', '=', (boolean) $values['ativo']);
        }
        if (isset($values['created_at'])) {
            $criteria->where('created_at', 'like', "{$values['created_at']}%");
        }

        return $criteria;
    }

    /**
     * Método responsável por buscar os clientes vinculados a um determinado aluno.
     * 
     * @param int $IdAluno
     * @param array $columns
     * @return array
     */
    public function getClientesByAluno(int $IdAluno, array $columns = ['*'])
    {
        $subQuery = '(SELECT ft.id
                    FROM ficha_triagens ft
                    WHERE ft.cliente_id = clientes.id
                    ORDER BY ft.created_at ASC
                    LIMIT 1)';
        return $this->model
                        ->join('ficha_triagens', 'ficha_triagens.id', '=', DB::raw($subQuery))
                        ->where('ficha_triagens.aluno_id', '=', $IdAluno)
                        ->groupBy('clientes.id')
                        ->orderBy('clientes.nome_completo', 'asc')
                        ->get($columns);
    }

}
