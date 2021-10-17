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