<?php

namespace App\Http\Controllers;

use  App\Cartera;
use Illuminate\Support\Facades\Input; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class controller_cartera extends Controller
{
    //
    public function index(){
        $cartera = Cartera::all()->toArray(); 
        return response()->json($cartera);
    }

    public function store(Request $request)
    {
        //
        try{
            
            $carteras = new Cartera([

                'id_cartera' => $request->input('id_cartera'),  
                'id_cliente'=> $request->input('id_cliente'), 
                'id_credito'=> $request->input('id_credito'),  
                'vlor_facturado'=> $request->input('vlor_facturado'),  
                'vlor_pagado'=> $request->input('vlor_pagado'),  
                'vlor_saldo'=> $request->input('vlor_saldo')
                  
            ]);
            
            Log::info('Cartera  almacenada con existos!');
            
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
            $cartera = Cartera::find($id);
            
            if(!$cartera){
                return response()->json(['Este Id no existe.'], 404);
            }
            
            return response()->json($cartera, 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo mostrar Cartera '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function update(Request $request, $id)
    {
        //
        try{
            
            $cartera = Cartera::find($id);
            
            if(!$cartera){
                return response()->json(['Este Id no existe.'], 404);
            }
            
            $cartera ->update($request->all());

            $cartera->save();
            
            return response()->json('Cartera actualizada!', 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo actualizar Cartera '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function destroy($id)
    {
        //
        try{
            $cartera = Cartera::find($id);
            
            if(!$cartera){
                return response()->json(['Este Id no existe.'], 404);
            }
            
            $cartera->delete();
            
            return response()->json('Cartera eliminado.', 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo eliminar Cartera '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }
}