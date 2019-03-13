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
            Route::get('/', 'HomeController@index')->name('institucional.home');
            Route::get('/sobre', 'SobreController@index')->name('institucional.sobre');
});


Route::namespace('Portal')
        ->group(function () {
            Route::get('/portal', 'PortalController@index')->name('portal.home');
});