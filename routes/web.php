<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/portal', function () {
    return view('inicio');
});*/



Route::namespace('Institucional')
        ->group(function () {
            Route::get('/', 'HomeController')->name('institucional.home');
            Route::get('/sobre', 'SobreController')->name('institucional.sobre');
            Route::get('/como-funciona', 'ComoFuncionaController')->name('institucional.como_funciona');
            Route::get('/contato', 'ContatoController')->name('institucional.contato');
            Route::post('/contato-enviar', 'ContatoController@contatoEnviar')->name('institucional.contato_enviar');
});


Route::namespace('Portal')
        ->group(function () {
            Route::get('/portal', 'PortalController')->name('portal.home');
});