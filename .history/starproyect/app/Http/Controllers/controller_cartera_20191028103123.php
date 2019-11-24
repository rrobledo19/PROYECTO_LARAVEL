<?php

namespace App\Http\Controllers;

use  App\model_cartera;
use Illuminate\Support\Facades\Input; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class controller_cartera extends Controller
{
    //
    public function index(){
        $cartera = model_cartera::all()->toArray(); 
        return response()->json($cartera);
    }

    public function store(Request $request)
    {
        //
        try{
            
            $carteras = new model_cartera([

                'id_cartera' => $request->input('id_cartera'),  
                'id_cliente'=> $request->input('id_cliente'), 
                'id_credito'=> $request->input('id_credito'),  
                'vlor_facturado'=> $request->input('vlor_facturado'),  
                'vlor_pagado'=> $request->input('vlor_pagado'),  
                'vlor_saldo'=> $request->input('vlor_saldo')
                  
            ]);
            
            Log::info('model_cartera  almacenada con existos!');
            
            $carteras->save();
            
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
            $categorias = def_categorias::find($id);
            
            if(!$categorias){
                return response()->json(['Este Id no existe.'], 404);
            }
            
            return response()->json($categorias, 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo mostrar def_categorias '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function update(Request $request, $id)
    {
        //
        try{
            
            $categorias = def_categorias::find($id);
            
            if(!$categorias){
                return response()->json(['Este Id no existe.'], 404);
            }
            
            $categorias ->update($request->all());

            $categorias->save();
            
            return response()->json('def_categorias actualizada!', 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo actualizar def_categorias '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function destroy($id)
    {
        //
        try{
            $categorias = def_categorias::find($id);
            
            if(!$categorias){
                return response()->json(['Este Id no existe.'], 404);
            }
            
            $categorias->delete();
            
            return response()->json('def_categorias eliminado.', 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo eliminar def_categorias '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }
}
