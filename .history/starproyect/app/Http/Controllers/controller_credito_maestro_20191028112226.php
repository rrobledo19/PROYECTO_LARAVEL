<?php

namespace App\Http\Controllers;

use  App\model_credito_maestro;
use Illuminate\Support\Facades\Input; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class controller_credito_maestro extends Controller
{
    //
    public function index(){
        $credito_maestro = model_credito_maestro::all()->toArray(); 
        return response()->json($credito_maestro);
    }

    public function store(Request $request)
    {
        //
        try{
            
            $credito_maestros = new model_credito_maestro([

                'id_cartera' => $request->input('id_cartera'),  
                'id_cliente'=> $request->input('id_cliente'), 
                'id_credito'=> $request->input('id_credito'),  
                'vlor_facturado'=> $request->input('vlor_facturado'),  
                'vlor_pagado'=> $request->input('vlor_pagado'),  
                'vlor_saldo'=> $request->input('vlor_saldo')
                  
            ]);
            
            Log::info('model_credito_maestro  almacenada con existos!');
            
            $credito_maestros->save();
            
            return response()->json(['status' => true, 'Genial!'], 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo almacenar modelo de carteras  '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }


    public function show($id)
    {
        //
        try{
            $credito_maestro = model_credito_maestro::find($id);
            
            if(!$credito_maestro){
                return response()->json(['Este Id no existe.'], 404);
            }
            
            return response()->json($credito_maestro, 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo mostrar model_credito_maestro '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function update(Request $request, $id)
    {
        //
        try{
            
            $credito_maestro = model_credito_maestro::find($id);
            
            if(!$credito_maestro){
                return response()->json(['Este Id no existe.'], 404);
            }
            
            $credito_maestro ->update($request->all());

            $credito_maestro->save();
            
            return response()->json('model_credito_maestro actualizada!', 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo actualizar model_credito_maestro '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function destroy($id)
    {
        //
        try{
            $credito_maestro = model_credito_maestro::find($id);
            
            if(!$credito_maestro){
                return response()->json(['Este Id no existe.'], 404);
            }
            
            $credito_maestro->delete();
            
            return response()->json('model_credito_maestro eliminado.', 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo eliminar model_credito_maestro '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }
}
