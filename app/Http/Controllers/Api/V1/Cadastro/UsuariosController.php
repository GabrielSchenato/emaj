<?php

namespace Emaj\Http\Controllers\Api\V1\Cadastro;

use Emaj\Criteria\AtivoCriteria;
use Emaj\Criteria\ProfessorCriteria;
use Emaj\Http\Controllers\CrudController;
use Emaj\Mail\EdicaoUsuarioMailable;
use Emaj\Mail\NovoUsuarioMailable;
use Emaj\Repositories\Cadastro\UsuarioRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

/**
 * Classe responsável por gerenciar a requisições das páginas
 *
 * PHP version 7.2
 *
 * @category   Controller
 * @package    Cadastro
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
class UsuariosController extends CrudController
{

    protected $repository;

    public function __construct(UsuarioRepository $repository)
    {
        $this->repository = $repository;
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
        Mail::to($data['email'])->send(new NovoUsuarioMailable($this->registro, $data['password']));
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
        if(isset($data['password'])){
            Mail::to($data['email'])->send(new EdicaoUsuarioMailable($this->registro, $data['password']));
        }
        return $this->registro;
    }

    public function me()
    {
        $result = auth()->user();
        $user = [];
        if ($result) {
            $user = $this->repository->find($result->id);
        }

        return $user;
    }

    /**
     * Retorna todos os dados para os autocomplete
     * 
     * @return array
     */
    public function autocomplete()
    {
        $query = Input::get('query');
        $this->registro = $this->repository->pushCriteria(AtivoCriteria::class)
                                           ->pushCriteria(ProfessorCriteria::class)
                                           ->whereLike('nome_completo', $query, ['id', 'nome_completo']);
        return $this->registro;
    }

}
