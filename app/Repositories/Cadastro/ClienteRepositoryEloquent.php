<?php

namespace Emaj\Repositories\Cadastro;

use Emaj\Entities\Cadastro\Cliente;
use Emaj\Entities\Cadastro\ComposicaoFamiliar;
use Emaj\Entities\Cadastro\Endereco;
use Emaj\Entities\Cadastro\Telefone;
use Exception;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

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
class ClienteRepositoryEloquent extends BaseRepository implements ClienteRepository
{

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

    public function create(array $attributes)
    {
        try {
            DB::beginTransaction();
            $cliente = parent::create($attributes['informacoesPessoais']);
            $cliente->endereco()->create($attributes['endereco']);
            $cliente->composicao_familiar()->create($attributes['composicaoFamiliar']);
            $cliente->telefones()->createMany($attributes['telefones']);
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
        try {
            DB::beginTransaction();
            $cliente = parent::update($attributes['informacoesPessoais'], $id);
            $cliente->endereco()->update($attributes['endereco'], $attributes['endereco']['id']);
            $cliente->composicao_familiar()->update($attributes['composicaoFamiliar'], $attributes['composicaoFamiliar']['id']);
            foreach ($attributes['telefones'] as $telefone) {
                $cliente->telefones()->update($telefone, $telefone['id']);
            }
            DB::commit();
        } catch (Exception $ex) {
            DB::rollback();
            return response()->json([
                        'status' => 'error',
                        'errors' => $ex->getMessage()
                            ], 422);
        }
    }

//    public static function getRules($data)
//    {
//        return [
//            'renda' => 'required|numeric'
//        ];
//    }
}
