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

                'id_clientes' => $request->input('id_clientes'),  
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
            $clientes = model_clientes::find($id);
            
            if(!$clientes){
                return response()->json(['Este Id no existe.'], 404);
            }
            
            return response()->json($clientes, 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo mostrar model_clientes '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function update(Request $request, $id)
    {
        //
        try{
            

                
            DB::table('cliente')
            ->where('id_cliente', $id)
            ->update([
                ['n_formato'=> $request->input('n_formato')], 
                ['nombres'=> $request->input('nombres')],  
                ['apellidos'=> $request->input('apellidos')],  
                ['direccion'=> $request->input('direccion')],  
                ['telefono'=> $request->input('telefono')], 
                ['email'=> $request->input('email')],  
                ['identificacion'=> $request->input('identificacion')],  
                ['n_identificacion'=> $request->input('n_identificacion')],  
                ['departamento'=> $request->input('departamento')],  
                ['municipio'=> $request->input('municipio')],  
                ['barrio'=> $request->input('barrio')],  
                ['cobrador'=> $request->input('cobrador')],  
                ['referencia'=> $request->input('referencia')],  
                ['observacion'=> $request->input('observacion')],  
                ['estado'=> $request->input('estado')]
            ]);

            $clientes->save();
            
            return response()->json('model_clientes actualizada!', 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo actualizar model_clientes '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function destroy($id)
    {
        //
        try{
            $clientes = model_clientes::find($id);
            
            if(!$clientes){
                return response()->json(['Este Id no existe.'], 404);
            }
            
            $clientes->delete();
            
            return response()->json('model_clientes eliminado.', 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo eliminar model_clientes '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }
}