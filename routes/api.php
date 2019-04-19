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
            Route::apiResources([
                'usuarios' => 'Cadastro\UsersController',
                'tipodemandas' => 'Cadastro\TipoDemandasController'
            ]);
        });
