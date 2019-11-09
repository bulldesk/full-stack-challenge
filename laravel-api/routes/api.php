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

Route::apiResource('leedstatus', 'LeedStatusesController');
Route::apiResource('leedstates', 'LeedStatesController');
Route::apiResource('country', 'CountriesController');
Route::apiResource('company', 'CompaniesController');
Route::apiResource('state', 'StatesController');
Route::apiResource('city', 'CitiesController');
Route::apiResource('leed', 'LeedsController');