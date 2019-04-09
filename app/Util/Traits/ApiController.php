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
 * @package    Util\Traits
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
trait ApiController
{

    public function index(Request $request)
    {
        $data = $request->all();
        $limit = $data['limit'] ?? 20;
        $order = $data['order'] ?? null;

        if ($order) {
            $order = explode(',', $order);
        }
        $order[0] = $order[0] ?? 'id';
        $order[1] = $order[1] ?? 'asc';

        $where = $data['where'] ?? [];
        $like = $data['like'] ?? null;

        if ($like) {
            $like = explode(',', $like);
            $like[1] = '%' . $like[1] . '%';
        }
        $users = $this->model
                ->orderBy($order[0], $order[1])
                ->where(function ($query) use ($like) {
                    if ($like) {
                        return $query->where($like[0], 'like', $like[1]);
                    }
                    return $query;
                })
                ->where($where)
                ->with($this->relationships())
                ->paginate($limit);
        return response()->json($users);
    }

    public function show($id)
    {
        $result = $this->model
                ->with($this->relationships())
                ->findOrFail($id);
        return response()->json($result);
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

        $result = $this->model->create($data);
        return response()->json($result);
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
        $result = $this->model->findOrFail($id);
        $result->update($data);
        return response()->json($result);
    }

    public function destroy($id)
    {
        $result = $this->model->findOrFail($id);
        $result->delete();
        return response()->json($result);
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
    private function hasErrors($data)
    {
        if (method_exists($this->model, 'getRules')) {
            $validator = Validator::make($data, $this->model->getRules($data));
            if ($validator->fails()) {
                return $validator->errors();
            }
        }
    }

}
