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
     * Método responsável por o número de atendimentos no mês
     * 
     * @return int
     */
    public function getAtendimentosMes()
    {
        return $this->pushCriteria(MesCriteria::class)
                    ->count();
    }

    public static function getRules($data)
    {
        return [
            'protocolo' => 'required',
            'cliente_id' => 'required|numeric',
            'tipo_demanda_id' => 'required|numeric',
            'parte_contraria_id' => 'nullable|numeric',
            'aluno_id' => 'nullable|numeric',
            'tipo_status_id' => 'required|numeric',
        ];
    }

}
