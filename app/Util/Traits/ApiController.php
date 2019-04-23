<?php

namespace Emaj\Util\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function response;

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

    public function index(Request $request)
    {
        $data = $request->all();
        $limit = $data['limit'] ?? 20;
        $columns = $data['columns'] ?? ['*'];
        $order = $data['order'] ?? null;

        if ($order) {
            $order = explode(',', $order);
        }
        $order[0] = $order[0] ?? 'id';
        $order[1] = $order[1] ?? 'asc';

        $this->registro = $this->repository->with($this->relationships())->orderBy($order[0], $order[1])->paginate($limit, $columns);
        return $this->registro;
    }

    public function show($id)
    {
        $this->registro = $this->repository->with($this->relationships())->find($id);
        return $this->registro;
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if ($errors = $this->hasErrors($data)) {
            return response()->json([
                        'status' => 'error',
                        'errors' => $errors
                            ], 422);
        }
        $this->registro = $this->repository->create($data);
        return $this->registro;
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        if ($errors = $this->hasErrors($data)) {
            return response()->json([
                        'status' => 'error',
                        'errors' => $errors
                            ], 422);
        }
        $this->registro = $this->repository->update($data, $id);
        return $this->registro;
    }

    public function destroy($id)
    {
        return response()->json($this->repository->delete($id));
    }

    protected function relationships()
    {
        if (isset($this->relationships)) {
            return $this->relationships;
        }
        return [];
    }

    /**
     * Método responsavél por verificar se existe erro nos dados que estão sendo inseridos.
     * 
     * @param array $data
     * @return array|void
     */
    protected function hasErrors($data)
    {
        if (method_exists($this->repository, 'getRules')) {
            $validator = Validator::make($data, $this->repository->getRules($data));
            if ($validator->fails()) {
                return $validator->errors();
            }
        }
    }

}
