<?php

namespace App\Http\Controllers;
use  App\model_clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class controller_clientes extends Controller
{
    public function index(){
        $cliente = model_clientes::all()->toArray(); 
        return response()->json($cliente);
    }

    public function store(Request $request)
    {
        //
        try{
            
            $clientes = new model_clientes([

                'consecutivo' => $request->input('consecutivo'),  
                'n_formato'=> $request->input('n_formato'), 
                'nombres'=> $request->input('nombres'),  
                'apellidos'=> $request->input('apellidos'),  
                'direccion'=> $request->input('direccion'),  
                'telefono'=> $request->input('telefono'), 
                'email'=> $request->input('email'),  
                'identificacion'=> $request->input('identificacion'),  
                'n_identificacion'=> $request->input('n_identificacion'),  
                'departamento'=> $request->input('departamento'),  
                'municipio'=> $request->input('municipio'),  
                'barrio'=> $request->input('barrio'),  
                'cobrador'=> $request->input('cobrador'),  
                'referencia'=> $request->input('referencia'),  
                'observacion'=> $request->input('observacion'),  
                'estado'=> $request->input('estado'),
                  
            ]);
            
            Log::info('model_clientes  almacenada con existos!');
            
            $clientes->save();
            
            return response()->json(['status' => true, 'Genial!'], 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo almacenar modelo de clientes  '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
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