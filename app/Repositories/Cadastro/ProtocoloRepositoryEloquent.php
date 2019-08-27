<?php

namespace Emaj\Repositories\Cadastro;

use Emaj\Criteria\MesCriteria;
use Emaj\Entities\Cadastro\Cliente;
use Emaj\Entities\Cadastro\Protocolo;
use Emaj\Exceptions\ValidationException;
use Emaj\Repositories\AbstractRepository;
use Emaj\Util\Functions;
use Emaj\Util\Status;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Repository responsável por gerenciar a entidade Protocolo
 *
 * PHP version 7.2
 *
 * @category   Repository
 * @package    Cadastro
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      2.0.0
 */
class ProtocoloRepositoryEloquent extends AbstractRepository implements ProtocoloRepository
{

    /**
     * @var ProtocoloAlunoProfessorRepository
     */
    private $protocoloAlunoProfessorRepository;

    /**
     * @var ClienteRepository
     */
    private $clienteRepository;

    /**
     * @var ParametroTriagemRepository
     */
    private $parametroTriagemRepository;

    /**
     *
     * @var Cliente 
     */
    private $cliente;

    public function __construct(Container $app, ParametroTriagemRepository $parametroTriagemRepository, ClienteRepository $clienteRepository, ProtocoloAlunoProfessorRepository $protocoloAlunoProfessorRepository)
    {
        parent::__construct($app);
        $this->parametroTriagemRepository = $parametroTriagemRepository;
        $this->clienteRepository = $clienteRepository;
        $this->protocoloAlunoProfessorRepository = $protocoloAlunoProfessorRepository;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Protocolo::class;
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
        return $this->save($attributes);
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
        try {
            DB::beginTransaction();

            $this->inativaProtocoloAlunosProfessores($attributes, $id);

            $protocolo = $this->save($attributes, $id);

            DB::commit();
            return $protocolo;
        } catch (ValidationException $ex) {
            DB::rollback();
            throw $ex;
        } catch (\Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }

    /**
     * Método responsável por criar ou atualizar o registro de um protocolo.
     * 
     * @param array $attributes
     * @param int | null $id
     * @return array
     * @throws ValidationException
     */
    private function save(array $attributes, $id = null)
    {
        $this->setStatus($attributes);
        $this->validaClienteIgualParteContraria($attributes);
        $this->validaDadosCliente($attributes);
        $this->validaRendaCliente();
        return parent::updateOrCreate(['id' => $id], $attributes);
    }

    /**
     * Método responsável por pegar as 5 demandas mais utilizadas
     * 
     * @return array
     */
    public function getTop5DemandasMaisAtendidas()
    {
        $top5DemandasMaisAtendidas = DB::table('protocolos')
                ->select(DB::raw('count(tipo_demandas.nome) as value, tipo_demandas.nome as name'))
                ->join('tipo_demandas', 'tipo_demandas.id', '=', 'protocolos.tipo_demanda_id')
                ->groupBy('tipo_demandas.nome')
                ->orderBy('value', 'DESC')
                ->limit('5')
                ->get();
        return $top5DemandasMaisAtendidas;
    }

    /**
     * Método responsável por retornar o número de clientes
     * 
     * @return array
     */
    public function getNumeroClientes()
    {
        return $this->model
                        ->distinct('cliente_id')
                        ->count('cliente_id');
    }

    /**
     * Método responsável por retornar o número de parte contrárias
     * 
     * @return array
     */
    public function getNumeroParteContrarias()
    {
        return $this->model
                        ->distinct('parte_contraria_id')
                        ->count('parte_contraria_id');
    }

    /**
     * Método responsável por o número de atendimentos no mês
     * 
     * @return int
     */
    public function getAtendimentosMes()
    {
        return $this->pushCriteria(MesCriteria::class)
                        ->count();
    }

    /**
     * Método responsável por buscar os dados para a grid
     * 
     * @param int $limit
     * @param array $columns
     * @param array $order
     * @param array $data
     * 
     * @return mixed
     */
    public function getDataIndex(int $limit = 10, array $columns = ['*'], array $order = ['id', 'desc'], array $data = [])
    {
        $columns = [
            'protocolos.id',
            'protocolos.cliente_id',
            'protocolos.protocolo',
            'protocolos.numero_processo',
            'protocolos.parte_contraria_id',
            'parte_contrarias.nome_completo AS nome_parte_contraria',
            'tipo_demandas.nome AS nome_tipo_demanda',
            'protocolos.status',
            'protocolos.ativo',
        ];
        return $this->getBySearch($data)
                        ->leftJoin('clientes AS parte_contrarias', 'protocolos.parte_contraria_id', '=', 'parte_contrarias.id')
                        ->leftJoin('tipo_demandas', 'protocolos.tipo_demanda_id', '=', 'tipo_demandas.id')
                        ->orderBy($order[0], $order[1])
                        ->paginate($limit, $columns);
    }

    /**
     * Método responsável por realizar a busca pelo valor e campo passado
     * @param array $values
     * @return mixed
     */
    public function getBySearch(array $values)
    {
        $criteria = $this->model->newQuery();
        if (isset($values['protocolo'])) {
            $criteria->where('protocolo', 'like', "%{$values['protocolo']}%");
        }
        if (isset($values['numero_processo'])) {
            $criteria->where('numero_processo', 'like', "%{$values['numero_processo']}%");
        }
        if (isset($values['nome_parte_contraria'])) {
            $criteria->whereHas('parte_contraria', function ($criteria) use ($values) {
                $criteria->where('nome_completo', 'like', "%{$values['nome_parte_contraria']}%");
            });
        }
        if (isset($values['nome_tipo_demanda'])) {
            $criteria->whereHas('tipo_demanda', function ($criteria) use ($values) {
                $criteria->where('nome', 'like', "%{$values['nome_tipo_demanda']}%");
            });
        }
        if (isset($values['status'])) {
            $criteria->where('status', '=', $values['status']);
        }
        if (isset($values['cliente_id'])) {
            $criteria->where('cliente_id', '=', (int) $values['cliente_id']);
        }
        if (isset($values['ativo'])) {
            $criteria->where('protocolos.ativo', '=', (boolean) $values['ativo']);
        }

        return $criteria;
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
        return [
            'protocolo' => 'required'
        ];
    }

    /**
     * Método responsável por setar o valor no status
     * 
     * @param array $attributes
     */
    private function setStatus(&$attributes)
    {
        if (isset($attributes['numero_processo'])) {
            $attributes['status'] = Status::AJUIZADO;
        } else {
            $attributes['status'] = Status::NAO_AJUIZADO;
        }
    }

    /**
     * Método responsável por verificar se o cliente não é igual a parte contrária
     * 
     * @param array $attributes
     * @throws ValidationException
     */
    private function validaClienteIgualParteContraria($attributes)
    {
        if (isset($attributes['parte_contraria_id']) && $attributes['cliente_id'] == $attributes['parte_contraria_id']) {
            throw ValidationException::withMessages([
                'cliente_id' => 'Cliente e Parte Contrária iguais, por favor verifique.'
            ]);
        }
    }

    /**
     * Método responsável por verificar se os dados do cliente estão incompletos
     * 
     * @param array $attributes
     * @throws ValidationException
     */
    private function validaDadosCliente($attributes)
    {
        if (!isset($attributes['cliente_id'])) {
            throw ValidationException::withMessages([
                'cliente_id' => 'É necessário informar o Cliente.'
            ]);
        }
        $this->cliente = $this->clienteRepository->find((int) $attributes['cliente_id']);

        if ($this->cliente->parte_contraria) {
            throw ValidationException::withMessages([
                'cliente_id' => 'Os dados desse Cliente estão incompletos, por favor verifique o cadastro do mesmo.'
            ]);
        }
    }

    /**
     * Método responsável por verificar se a renda do cliente está dentro do limite
     * dos parametros da triagem
     * 
     * @throws ValidationException
     */
    private function validaRendaCliente()
    {
        $parametrosTriagem = $this->parametroTriagemRepository->first();

        if ($this->cliente->renda > $parametrosTriagem->renda) {
            $msg = 'A renda desse cliente está acima dos valores permitidos que é de R$ ' . Functions::getMoedaFormatadaReal($parametrosTriagem->renda) . ', por favor verifique.';
            throw ValidationException::withMessages([
                'cliente_id' => $msg
            ]);
        }
    }

    /**
     * Método responsável por inativar os protocolos alunos professores quando o protocolo
     * está sendo inativado
     *
     * @param array $attributes
     * @param       $id
     *
     * @return void
     */
    private function inativaProtocoloAlunosProfessores(array $attributes, $id)
    {
        $ativo = isset($attributes['ativo']) ? $attributes['ativo'] : null;

        if (!$ativo) {
            $protocoloAlunosProfessores = $this->protocoloAlunoProfessorRepository->findByField('protocolo_id', (int) $id);
            foreach ($protocoloAlunosProfessores as $protocoloAlunoProfessor) {
                $protocoloAlunoProfessor->ativo = false;
                $this->protocoloAlunoProfessorRepository->update($protocoloAlunoProfessor->toArray(), $protocoloAlunoProfessor->id);
            }
        }
    }

}
