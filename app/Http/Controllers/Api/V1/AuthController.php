<?php

namespace Emaj\Http\Controllers\Api\V1;

use Emaj\Http\Controllers\Controller;
use Emaj\Repositories\Cadastro\UsuarioRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

/**
 * Classe responsável por gerenciar a requisições das páginas
 *
 * PHP version 7.2
 *
 * @category   Controller
 * @package    V1
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
class AuthController extends Controller
{

    /**
     *
     * @var UsuarioRepository
     */
    private $repository;

    public function __construct(UsuarioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $v = Validator::make($credentials, [
                    'email' => 'required|email',
                    'password' => 'required|min:3',
        ]);
        if ($v->fails()) {
            return response()->json([
                        'status' => 'error',
                        'errors' => $v->errors()
                            ], 422);
        }
        if ($token = $this->guard()->attempt($credentials)) {
            return response()->json(['status' => 'success'], 200)->header('Authorization', $token);
        }
        return response()
                        ->json(
                                ['status' => 'error',
                                    'errors' => [
                                        'message' => 'E-mail ou senha inválidos, tente novamente!',
                                        'email' => '',
                                        'password' => '']], 401);
    }

    public function logout()
    {
        $this->guard()->logout();
        return response()->json([
                    'status' => 'success',
                    'message' => 'Deslogado com sucesso!'
                        ], 200);
    }

    public function user(Request $request)
    {
        $user = $this->repository->find(Auth::user()->id);
        return response()->json([
                    'status' => 'success',
                    'data' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['role'] = auth()->user()->role;

        $v = Validator::make($data, ['nome_completo' => 'required|min:5',
                    'email' => ['required', 'email', Rule::unique('usuarios')->ignore($id)],
                    'password' => 'required|min:6|confirmed',
                    'avatar' => 'nullable',
                    'telefone' => 'required|min:8']);
        if ($v->fails()) {
            return response()->json([
                        'status' => 'error',
                        'errors' => $v->errors()
                            ], 422);
        }
        return $this->repository->update($data, $id);
    }

    public function refresh()
    {
        try {
            if ($token = $this->guard()->refresh()) {
                return response()
                                ->json(['status' => 'success'], 200)
                                ->header('Authorization', $token);
            }
        } catch (TokenExpiredException $ex) {
            return response()->json(['error' => 'Token de acesso expirado, faça o login novamente.'], 401);
        } catch (Exception $ex) {
            return response()->json(['error' => 'Erro ao atualizar o token de acesso!'], 401);
        }
    }

    private function guard()
    {
        return Auth::guard();
    }

}
