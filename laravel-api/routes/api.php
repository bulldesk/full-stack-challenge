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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('leedstatus', 'LeedStatusesController');
Route::apiResource('leedstates', 'LeedStatesController');
Route::apiResource('country', 'CountriesController');
Route::apiResource('company', 'CompaniesController');
Route::apiResource('state', 'StatesController')->middleware('auth:api');
Route::apiResource('city', 'CitiesController');
Route::apiResource('leed', 'LeedsController');
Route::apiResource('user', 'UserController');

Route::post('leedsimport', 'ImportController@upload')->middleware('auth:api');

Route::get('/que',function (){                                                     // route from /que
    $queue = Queue::push('LogMessage', array('message' => 'Time: '.time()));               // this will push job in queue
                                // OR
    //$queue = Queue::later($delay,'LogMessage', array('message' => 'Time: '.time()));     // this will push job in queue after $delay 
    //sleep(5);    //you can add delay here too
    
    print_r(" ".$queue." ".time());            //prints queue_id and time stamp
 });
 
 
 class LogMessage{                                                                //bad practice to deploy code here :p
 
 
       public function fire($job,$data){                                         //takes data and performs action.
            
            File::append(app_path().'/queue.txt',$data['message'].PHP_EOL);
            $job->delete();
 
 
        }
 }
