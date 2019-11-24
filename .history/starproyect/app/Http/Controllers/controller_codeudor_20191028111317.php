<?php

namespace App\Http\Controllers;

use  App\model_codeudor;
use Illuminate\Support\Facades\Input; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class controller_codeudor extends Controller
{
    //
    public function index(){
        $codeudor = model_codeudor::all()->toArray(); 
        return response()->json($codeudor);
    }

    public function store(Request $request)
    {
        //
        try{
            
            $codeudors = new model_codeudor([
                'id_codeudor' => $request->input('id_codeudor'),  
                'id_cliente'=> $request->input('id_cliente'), 
                'nombre'=> $request->input('nombre'),  
                'apellido'=> $request->input('apellido'),  
                'direccion'=> $request->input('direccion'),  
                'telefono'=> $request->input('telefono'),
                'identificacion'=> $request->input('identificacion'),
                'estado'=> $request->input('estado')
            ]);
            
            Log::info('model_codeudor  almacenada con existos!');
            
            $codeudors->save();
            
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
            $codeudor = model_codeudor::find($id);
            
            if(!$codeudor){
                return response()->json(['Este Id no existe.'], 404);
            }
            
            return response()->json($codeudor, 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo mostrar model_codeudor '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function update(Request $request, $id)
    {
        //
        try{
            
            $codeudor = model_codeudor::find($id);
            
            if(!$codeudor){
                return response()->json(['Este Id no existe.'], 404);
            }
            
            $codeudor ->update($request->all());

            $codeudor->save();
            
            return response()->json('model_codeudor actualizada!', 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo actualizar model_codeudor '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function destroy($id)
    {
        //
        try{
            $codeudor = model_codeudor::find($id);
            
            if(!$codeudor){
                return response()->json(['Este Id no existe.'], 404);
            }
            
            $codeudor->delete();
            
            return response()->json('model_codeudor eliminado.', 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo eliminar model_codeudor '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }
}
