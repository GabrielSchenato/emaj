<?php

namespace Emaj\Repositories\Movimento;

use Emaj\Entities\Movimento\FichaTriagem;
use Emaj\Repositories\Cadastro\ClienteRepositoryEloquent;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

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
class FichaTriagemRepositoryEloquent extends BaseRepository implements FichaTriagemRepository
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

            if ($attributes['cliente_id'] == $attributes['parte_contraria_id']) {
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

            $parametrosTriagemRepository = new \Emaj\Repositories\Cadastro\ParametroTriagemRepositoryEloquent($this->app);
            $parametrosTriagem = $parametrosTriagemRepository->first();

            if ($cliente->renda > $parametrosTriagem->renda) {
                return response()->json([
                            'status' => 'error',
                            'errors' => ['cliente_renda_superior' => 'A renda desse cliente está acima dos valores permitidos!']
                                ], 422);
            }

            $numeroProtocoloRepository = new NumeroProtocoloRepositoryEloquent($this->app);

            $protocolo = $numeroProtocoloRepository->create([]);

            $attributes = array_merge($attributes, ['numero_protocolo_id' => $protocolo->id]);

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

        if ($attributes['cliente_id'] == $attributes['parte_contraria_id']) {
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

        $parametrosTriagemRepository = new \Emaj\Repositories\Cadastro\ParametroTriagemRepositoryEloquent($this->app);
        $parametrosTriagem = $parametrosTriagemRepository->first();

        if ($cliente->renda > $parametrosTriagem->renda) {
            return response()->json([
                        'status' => 'error',
                        'errors' => ['cliente_renda_superior' => 'A renda desse cliente está acima dos valores permitidos!']
                            ], 422);
        }
        parent::update($attributes, $id);
    }

    public static function getRules($data)
    {
        return [
            'cliente_id' => 'required|numeric',
            'tipo_demanda_id' => 'required|numeric',
            'parte_contraria_id' => 'required|numeric',
            'aluno_id' => 'nullable|numeric',
            'tipo_status_id' => 'required|numeric',
        ];
    }

}
