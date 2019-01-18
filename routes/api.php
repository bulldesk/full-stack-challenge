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

Route::post('/login', 'AuthBasicController@login');

Route::middleware(['auth.basic.once'])->group(function () {
    Route::post('/importacao/headers', 'ImportController@getHeaders');
    Route::post('/importacao/importar', 'ImportController@importar');
});