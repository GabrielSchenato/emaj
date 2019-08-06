<?php

namespace Emaj\Util\Traits;

use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Trait responsável por gerenciar as requisições para a API
 *
 * PHP version 7.2
 *
 * @category   Trait
 * @package    Traits
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
trait ApiController
{

    /**
     *
     * @var \Prettus\Repository\Eloquent\BaseRepository
     */
    protected $repository;

    /**
     * Váriavel responsável por armazenar o registro
     */
    protected $registro;

    /**
     * Método responsável por retornar os registros para o front-end.
     * 
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $data = $request->all();

        $this->registro = $this->repository->getDataIndex((int) $data['limit'], ['*'], $this->order($data), $data);

        return $this->registro;
    }

    /**
     * Método responsável por buscar o registro e retornar para o front-end.
     * 
     * @param int $id
     * @return mixed
     */
    public function show($id)
    {
        $this->registro = $this->repository->with($this->relationships())->find($id);
        return $this->registro;
    }

    /**
     * Método responsável salvar o registro e retornar para o front-end.
     * 
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $this->registro = $this->repository->create($data);
        return $this->registro;
    }

    /**
     * Método responsável atualizar o registro e retornar para o front-end.
     * 
     * @param Request $request
     * @param int $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $this->registro = $this->repository->update($data, $id);
        return $this->registro;
    }

    /**
     * Método responsável por deletar o registro.
     * 
     * @param int $id
     * @return boolean
     */
    public function destroy($id)
    {
        try {
            return response()->json([
                        'status' => $this->repository->delete($id) ? 'success' : 'error'
            ]);
        } catch (QueryException $ex) {
            if ($ex->getCode() == 23000) {
                return response()->json([
                            'status' => 'error',
                            'errors' => 'Não foi possível deletar esse registro, pois o mesmo possui algum vínculo a outro registro.'
                                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
        }
    }

    /**
     * Método responsável por retornar os relacionamentos da entidade.
     * 
     * @return array
     */
    protected function relationships()
    {
        if (isset($this->relationships)) {
            return $this->relationships;
        }
        return [];
    }

    /**
     * Método responsável por retornar a ordenação a ser usada.
     * 
     * @param array $data
     * @return array
     */
    protected function order(array $data)
    {
        $order = $data['order'] ?? null;
        if ($order) {
            $order = explode(',', $order);
        }
        $order[0] = $order[0] ?? 'id';
        $order[1] = $order[1] ?? 'asc';
        return $order;
    }

}
