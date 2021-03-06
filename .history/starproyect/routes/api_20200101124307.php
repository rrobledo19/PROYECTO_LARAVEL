<?php

use Illuminate\Http\Request;
use JasperPHP\JasperPHP as JasperPHP; 

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
    Route::resource('clientes','controller_clientes', ['only' =>['index','store','show','update','destroy']]);
    Route::get('cliente_x_cedula/{identificacion}', 'controller_clientes@buscar_x_cedula');
    Route::get('Reportes', 'controller_clientes@Reporte');
    Route::get('Compila', 'controller_clientes@Compilar');

    Route::resource('cartera','controller_cartera', ['only' =>['index','store','show','update','destroy']]);
    Route::resource('codeudor','controller_codeudor', ['only' =>['index','store','show','update','destroy']]);
    
    Route::resource('credito_maestro','controller_credito_maestro', ['only' =>['index','store','show','update','destroy']]);
    Route::post('create_credito_detalle','controller_credito_maestro@storeDetalleCredito');    
    Route::get('credito_cliente/{id_cliente}','controller_credito_maestro@show_x_cliente');
    Route::get('credito_detalle/{id_credito}','controller_credito_maestro@show_detalle_credito');
    

    Route::get('credito_detalle/{id_credito}','controller_credito_detalle@buscar_x_credito');
    Route::get('campos_seleccionados','controller_credito_detalle@seleccionado');
    

    Route::resource('departamentos','departamento_controller', ['only' =>['index','store','show','update','destroy']]);
   
    Route::resource('municipios','municipios_controller', ['only' =>['index','store','show','update','destroy']]);
    Route::get('mncpios_x_dprtmnto/{id_dpto}','municipios_controller@municipios_departamento');

    Route::resource('pagosmaestro','controller_pagosmaestro', ['only' =>['index','store','show','update','destroy']]);
    Route::get('ncouta','controller_pagosmaestro@mincouta');
    Route::get('lista_pagos_cliente','controller_pagosmaestro@listado_pagos'); 
    Route::post('pagos_detalles/{id_pago}','controller_pagosmaestro@storeDetallePago');
    }); 
   
   
