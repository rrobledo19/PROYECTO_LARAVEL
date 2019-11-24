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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, x-requested-with');



Route::group(['prefix' => 'auth'], function () {
    
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });

    //Rutas protegidas
    Route::resource('cliente','controller_clientes', ['only' =>['index','store','show','destroy']]);
    Route::resource('cartera','controller_cartera', ['only' =>['index','store','show','destroy']]);
    Route::resource('codeudor','controller_codeudor', ['only' =>['index','store','show','destroy']]);

});