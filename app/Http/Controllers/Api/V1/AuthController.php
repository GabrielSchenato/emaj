<?php

namespace Emaj\Http\Controllers\Api\V1;

use Emaj\Http\Controllers\Controller;
use Emaj\Repositories\Cadastro\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{

    /**
     *
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
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
        return response()->json(['status' => 'error', 'errors' => ['message' => 'E-mail ou senha inválidos, tente novamente!', 'email' => '', 'password' => '']], 401);
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
        unset($data['role']);

        $v = Validator::make($data, ['nome_completo' => 'required|min:5',
                    'email' => ['required', 'email', Rule::unique('users')->ignore($id)],
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
        if ($token = $this->guard()->refresh()) {
            return response()
                            ->json(['status' => 'successs'], 200)
                            ->header('Authorization', $token);
        }
        return response()->json(['error' => 'Erro ao atualizar o token de acesso!'], 401);
    }

    private function guard()
    {
        return Auth::guard();
    }

}
