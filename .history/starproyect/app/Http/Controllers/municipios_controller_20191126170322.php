<?php

namespace App\Http\Controllers;

use  App\municipio;
use Illuminate\Support\Facades\Input; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class municipio_controller extends Controller
{
    //
    public function index(){
        $municipio = municipio::all()->toArray(); 
        return response()->json($municipio);
    }

    public function store(Request $request)
    {
        //
        try{
            
            $municipio = new municipio([
                'id_municipio' => $request->input('id_municipio'), 
                'id_departamento' => $request->input('id_departamento'), 
                'descripcion' => $request->input('descripcion'),
                'tipo' => $request->input('tipo'),
            ]);
            
            Log::info('Municipio  almacenado con existos!');
            
            $municipio->save();
            
            return response()->json(['status' => true, 'Genial!'], 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo almacenar Municipio  '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function show($id)
    {
        //
        try{
            $municipio = municipio::where('id_municipio', $id)->get();

            return response()->json($municipio, 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo mostrar municipio '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function municipio_departamento($id_depto)
    {
        //
        try{
            $municipio = municipio::where([
                                ['id_departamento', $id_depto],
                                ['tipo','CM']
            ])->get();

            return response()->json($municipio, 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo mostrar municipio '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function update(Request $request, $id)
    {
        //
        try{
            
            $departamento_query = DB::table('departamento')->where('id_departamento', $id);

            $departamento_query->update(['descrpcion' => $request('descrpcion')]);
            
            return response()->json('municipio actualizada!', 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo actualizar municipio '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function destroy($id)
    {
        //
        try{
            $municipio = municipio::find($id);
            
            if(!$municipio){
                return response()->json(['Este Id no existe.'], 404);
            }
            
            $municipio->delete();
            
            return response()->json('municipio eliminado.', 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo eliminar municipio '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

}
