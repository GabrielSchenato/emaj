<?php

namespace Emaj\Http\Controllers\Api\V1\Cadastro;

use Emaj\Http\Controllers\CrudController;
use Emaj\Mail\UserMailable;
use Emaj\Repositories\Cadastro\UsuarioRepository;
use Illuminate\Http\Request;
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
class UsersController extends CrudController
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
        Mail::to($data['email'])->send(new UserMailable($this->registro, $data['password']));
        return $this->registro;      
    }

    public function me()
    {
        $result = \Auth::user();
        $user = [];
        if ($result) {
            $user = $this->repository->find($result->id);
        }

        return response()->json($user);
    }

}
