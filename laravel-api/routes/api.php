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

//Rotas para o jwt 

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});
// Rotas CRUD

Route::apiResource('leedstatus', 'LeedStatusesController')->middleware('auth:api');
Route::apiResource('leedstates', 'LeedStatesController')->middleware('auth:api');
Route::apiResource('country', 'CountriesController')->middleware('auth:api');
Route::apiResource('company', 'CompaniesController')->middleware('auth:api');
Route::apiResource('state', 'StatesController')->middleware('auth:api');
Route::apiResource('city', 'CitiesController')->middleware('auth:api');
Route::apiResource('leed', 'LeedsController')->middleware('auth:api');
Route::apiResource('user', 'UserController');// Middleware configurado no contrutor do controller para poder excluir o store de auth e então cadastrar usuario sem logar

//Rota para importação
Route::post('leedsimport', 'ImportController@upload')->middleware('auth:api');