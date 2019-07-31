<?php

namespace Emaj\Repositories\Movimento;

use Emaj\Criteria\MesCriteria;
use Emaj\Entities\Movimento\FichaTriagem;
use Emaj\Repositories\AbstractRepository;
use Emaj\Repositories\Cadastro\ClienteRepositoryEloquent;
use Emaj\Repositories\Cadastro\ParametroTriagemRepositoryEloquent;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Repository responsável por gerenciar a entidade Ficha de Triagem
 *
 * PHP version 7.2
 *
 * @category   Repository
 * @package    Movimento
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
class FichaTriagemRepositoryEloquent extends AbstractRepository implements FichaTriagemRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return FichaTriagem::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function create(array $attributes)
    {
        try {
            DB::beginTransaction();

            if (isset($attributes['numero_processo'])) {
                $attributes['status'] = FichaTriagem::AJUIZADO;
            } else {
                $attributes['status'] = FichaTriagem::NAO_AJUIZADO;
            }

            $validator = Validator::make($attributes, $this->getRules($attributes));
            if ($validator->fails()) {
                return response()->json([
                            'status' => 'error',
                            'errors' => $validator->errors()
                                ], 422);
            }

            if (isset($attributes['parte_contraria_id']) && $attributes['cliente_id'] == $attributes['parte_contraria_id']) {
                return response()->json([
                            'status' => 'error',
                            'errors' => ['cliente_parte_contraria' => 'Você não pode usar o mesmo cliente no campo parte contrária!']
                                ], 422);
            }

            $clienteRepository = new ClienteRepositoryEloquent($this->app);
            $cliente = $clienteRepository->find($attributes['cliente_id']);

            if ($cliente->cpf == null && $cliente->rg == null && $cliente->renda == null) {
                return response()->json([
                            'status' => 'error',
                            'errors' => ['cliente_invalido' => 'Os dados desse cliente estão incompletos!']
                                ], 422);
            }

            $parametrosTriagemRepository = new ParametroTriagemRepositoryEloquent($this->app);
            $parametrosTriagem = $parametrosTriagemRepository->first();

            if ($cliente->renda > $parametrosTriagem->renda) {
                return response()->json([
                            'status' => 'error',
                            'errors' => ['cliente_renda_superior' => 'A renda desse cliente está acima dos valores permitidos!']
                                ], 422);
            }

            parent::create($attributes);

            DB::commit();
        } catch (Exception $ex) {
            DB::rollback();
            return response()->json([
                        'status' => 'error',
                        'errors' => $ex->getMessage()
                            ], 422);
        }
    }

    public function update(array $attributes, $id)
    {
        if (isset($attributes['numero_processo'])) {
            $attributes['status'] = FichaTriagem::AJUIZADO;
        } else {
            $attributes['status'] = FichaTriagem::NAO_AJUIZADO;
        }
        $validator = Validator::make($attributes, $this->getRules($attributes));
        if ($validator->fails()) {
            return response()->json([
                        'status' => 'error',
                        'errors' => $validator->errors()
                            ], 422);
        }

        if (isset($attributes['parte_contraria_id']) && $attributes['cliente_id'] == $attributes['parte_contraria_id']) {
            return response()->json([
                        'status' => 'error',
                        'errors' => ['cliente_parte_contraria' => 'Você não pode usar o mesmo cliente no campo parte contrária!']
                            ], 422);
        }

        $clienteRepository = new ClienteRepositoryEloquent($this->app);
        $cliente = $clienteRepository->find($attributes['cliente_id']);

        if ($cliente->cpf == null && $cliente->rg == null && $cliente->renda == null) {
            return response()->json([
                        'status' => 'error',
                        'errors' => ['cliente_invalido' => 'Os dados desse cliente estão incompletos!']
                            ], 422);
        }

        $parametrosTriagemRepository = new ParametroTriagemRepositoryEloquent($this->app);
        $parametrosTriagem = $parametrosTriagemRepository->first();

        if ($cliente->renda > $parametrosTriagem->renda) {
            return response()->json([
                        'status' => 'error',
                        'errors' => ['cliente_renda_superior' => 'A renda desse cliente está acima dos valores permitidos!']
                            ], 422);
        }
        parent::update($attributes, $id);
    }

    /**
     * Método responsável por pegar as 5 demandas mais utilizadas
     * 
     * @return array
     */
    public function getTop5DemandasMaisAtendidas()
    {
        $top5DemandasMaisAtendidas = DB::table('ficha_triagens')
                ->select(DB::raw('count(tipo_demandas.nome) as value, tipo_demandas.nome as name'))
                ->join('tipo_demandas', 'tipo_demandas.id', '=', 'ficha_triagens.tipo_demanda_id')
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
        $numeroClientes = DB::table('ficha_triagens')
                ->distinct('cliente_id')
                ->count('cliente_id');
        return $numeroClientes;
    }

    /**
     * Método responsável por retornar o número de parte contrárias
     * 
     * @return array
     */
    public function getNumeroParteContrarias()
    {
        $numeroParteContrarias = DB::table('ficha_triagens')
                ->distinct('parte_contraria_id')
                ->count('parte_contraria_id');
        return $numeroParteContrarias;
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
            'ficha_triagens.id',
            'ficha_triagens.protocolo',
            'ficha_triagens.cliente_id',
            'ficha_triagens.parte_contraria_id',
            'ficha_triagens.numero_processo',
            'ficha_triagens.status',
            'ficha_triagens.ativo',
            'clientes.nome_completo AS nome_cliente',
            'parte_contrarias.nome_completo AS nome_parte_contraria',
            'tipo_demandas.nome AS nome_tipo_demanda',
            'alunos.nome_completo AS nome_aluno'
        ];
        return $this->getBySearch($data)
                        ->leftJoin('clientes', 'ficha_triagens.cliente_id', '=', 'clientes.id')
                        ->leftJoin('clientes AS parte_contrarias', 'ficha_triagens.parte_contraria_id', '=', 'parte_contrarias.id')
                        ->leftJoin('tipo_demandas', 'ficha_triagens.tipo_demanda_id', '=', 'tipo_demandas.id')
                        ->leftJoin('alunos', 'ficha_triagens.aluno_id', '=', 'alunos.id')
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
        if (isset($values['nome_cliente'])) {
            $criteria->whereHas('cliente', function ($criteria) use ($values) {
                $criteria->where('nome_completo', 'like', "%{$values['nome_cliente']}%");
            });
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
        if (isset($values['nome_aluno'])) {
            $criteria->whereHas('aluno', function ($criteria) use ($values) {
                $criteria->where('nome_completo', 'like', "%{$values['nome_aluno']}%");
            });
        }
        if (isset($values['ativo'])) {
            $criteria->where('ficha_triagens.ativo', '=', (boolean) $values['ativo']);
        }

        return $criteria;
    }

    /**
     * Método responsável por buscar os dados e retornar para o autocomplete
     * 
     * @param string $value
     * @param int $idAluno
     */
    public function getDataAutocomplete($value, int $idAluno = null)
    {
        $criteria = $this->model->newQuery();

        $criteria->where(function ($query) use ($value) {
            $query->whereHas('cliente', function ($subquery ) use ($value) {
                        $subquery->where('nome_completo', 'like', "%{$value}%");
                    })
                    ->orWhereHas('parte_contraria', function ($subquery) use ($value) {
                        $subquery->where('nome_completo', 'like', "%{$value}%");
                    })
                    ->orWhereHas('tipo_demanda', function ($subquery) use ($value) {
                        $subquery->where('nome', 'like', "%{$value}%");
                    })
                    ->orWhere('numero_processo', 'like', "%{$value}%")
                    ->orWhere('protocolo', 'like', "%{$value}%");
        });

        if ($idAluno) {
            $criteria->where('aluno_id', '=', $idAluno);
        }

        return $criteria->orderBy('created_at', 'desc')
                        ->limit(10)
                        ->get();
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
            'protocolo' => 'required',
            'cliente_id' => 'required|numeric',
            'parte_contraria_id' => 'nullable|numeric',
            'aluno_id' => 'nullable|numeric',
        ];
    }

}
