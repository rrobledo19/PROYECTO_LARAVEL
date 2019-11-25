<?php

namespace App\Http\Controllers;

use  App\departamento;
use Illuminate\Support\Facades\Input; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class departamento_controller extends Controller
{
    //
    public function index(){
        $departamentos = departamento::all()->toArray(); 
        return response()->json($departamentos);
    }

    public function store(Request $request)
    {
        //
        try{
            
            $departamentos = new departamento([
                'id_departamento' => $request->input('id_departamento'), 
                'descrpcion' => $request->input('descrpcion')
            ]);
            
            Log::info('Departamento  almacenado con existos!');
            
            $departamentos->save();
            
            return response()->json(['status' => true, 'Genial!'], 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo almacenar departamento  '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function show($id)
    {
        //
        try{
            $departamentos = departamento::find($id);
            
            if(!$departamentos){
                return response()->json(['Este Id no existe.'], 404);
            }
            
            return response()->json($departamentos, 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo mostrar departamento '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function update(Request $request, $id)
    {
        //
        try{
            
            $departamento_query = DB::table('cr_df_departamentos')->where('id_departamento', $id);

            $departamento_query->update(['descrpcion' => $request('descrpcion')]);
            
            return response()->json('departamento actualizada!', 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo actualizar departamento '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function destroy($id)
    {
        //
        try{
            $departamentos = departamento::find($id);
            
            if(!$departamentos){
                return response()->json(['Este Id no existe.'], 404);
            }
            
            $departamentos->delete();
            
            return response()->json('departamento eliminado.', 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo eliminar departamento '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

}
