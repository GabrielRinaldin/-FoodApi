<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('auth/register', 'ApiAuthController@register');

Route::post('auth/login', 'ApiAuthController@login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('me', function (Request $request) {
        return auth()->user();
    });

    Route::post('auth/logout', 'ApiAuthController@logout');
});

//Rotas para endereço
Route::get('user/endereco/{id}', 'EnderecoController@index');
Route::get('user/endereco/show/{id}', 'EnderecoController@show');
Route::post('user/endereco', 'EnderecoController@store');
Route::post('user/endereco/{id}', 'EnderecoController@update');
Route::delete('user/endereco/{id}', 'EnderecoController@delete');

//Rotas para doações
Route::get('user/doacao/{id}', 'DoacaoController@index');
Route::get('user/doacao/show/{id}', 'DoacaoController@show');
Route::post('user/doacao', 'DoacaoController@store');
Route::post('user/doacao/{id}', 'DoacaoController@update');
Route::get('doacao/', 'DoacaoController@mostraTodasDoacoes');

//Rotas para doações realizada
Route::get('user/doacoes-realizada/', 'DoacaoRealizadaController@index');
Route::post('user/doacoes-realizada/', 'DoacaoRealizadaController@store');
Route::post('user/doacoes-realizada/edit', 'DoacaoRealizadaController@edit');
Route::get('user/doacoes-realizada/espera/', 'DoacaoRealizadaController@pegaDoadoesRealizadas');


//Rotas para analise das doações realizada 
Route::get('/doacoes-realizada/quilos', 'DoacaoRealizadaAnaliseController@pegaTodasDoacoesQuilos');
Route::get('/doacoes-realizada/quilos/mes', 'DoacaoRealizadaAnaliseController@pegaDoacoesMesQuilos');
Route::get('/doacoes-realizada/unidade' ,'DoacaoRealizadaAnaliseController@pegaTodasDoacoesUnidades');
Route::get('/doacoes-realizada/unidade/mes', 'DoacaoRealizadaAnaliseController@pegaDoacoesMesUnidades');




