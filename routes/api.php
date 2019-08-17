<?php

use Illuminate\Http\Request;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1/auth')
        ->namespace('Api\V1')
        ->group(function () {
            Route::post('login', 'AuthController@login');
            Route::get('refresh', 'AuthController@refresh');
            Route::group(['middleware' => 'auth:api'], function() {
                Route::get('user', 'AuthController@user');
                Route::put('user/{id}', 'AuthController@update');
                Route::post('logout', 'AuthController@logout');
            });
        });


Route::prefix('v1')
        ->middleware('auth')
        ->namespace('Api\V1')
        ->group(function () {
            Route::get('dashboard/estatisticas', 'DashboardController@estatisticas');

            Route::post('fichatriagens/imprimir-ficha-triagem', 'Movimento\FichaTriagensController@imprimirFichaTriagem');
            Route::get('fichatriagens/autocomplete', 'Movimento\FichaTriagensController@autocomplete');

            Route::get('clientes/autocomplete', 'Cadastro\ClientesController@autocomplete');
            Route::get('alunos/autocomplete', 'Cadastro\AlunosController@autocomplete');

            Route::get('protocolos/autocomplete', 'Cadastro\ProtocolosController@autocomplete');
            Route::post('protocolos/imprimir-ficha-triagem', 'Cadastro\ProtocolosController@imprimirFichaTriagem');

            Route::get('protocoloalunos/autocomplete', 'Cadastro\ProtocoloAlunosController@autocomplete');

            Route::apiResources([
                'usuarios' => 'Cadastro\UsuariosController',
                'tipodemandas' => 'Cadastro\TipoDemandasController',
                'clientes' => 'Cadastro\ClientesController',
                'alunos' => 'Cadastro\AlunosController',
                'avaliacoes' => 'Cadastro\AvaliacoesController',
                'avaliacaoarquivos' => 'Cadastro\AvaliacaoArquivosController',
                'protocolos' => 'Cadastro\ProtocolosController',
                'protocoloalunos' => 'Cadastro\ProtocoloAlunosController',
                'fichatriagens' => 'Movimento\FichaTriagensController'
            ]);
            Route::get('parametrostriagem', 'Cadastro\ParametrosTriagemController@show');
            Route::post('parametrostriagem', 'Cadastro\ParametrosTriagemController@store');
            Route::delete('telefones/{id}', 'Cadastro\TelefonesController@destroy');
            Route::put('telefones/{id}', 'Cadastro\TelefonesController@update');
            Route::get('avaliacoes-aluno/{id}', 'Cadastro\AvaliacoesController@avaliacoesAluno');
            Route::get('avaliacaoarquivos/download/{id}', 'Cadastro\AvaliacaoArquivosController@download');
        });
