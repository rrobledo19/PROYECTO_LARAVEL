<?php

namespace App\Http\Controllers;

use  App\municipios;
use Illuminate\Support\Facades\Input; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class municipios_controller extends Controller
{
    //
    public function index(){
        $municipios = municipios::all()->toArray(); 
        return response()->json($municipios);
    }

    public function store(Request $request)
    {
        //
        try{
            
            $municipios = new municipios([
                'id_municipio' => $request->input('id_municipio'), 
                'id_departamento' => $request->input('id_departamento'), 
                'descripcion' => $request->input('descripcion'),
                'tipo' => $request->input('tipo'),
            ]);
            
            Log::info('Municipio  almacenado con existos!');
            
            $municipios->save();
            
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
            $municipios = municipios::where('id_municipio', $id)->get();

            return response()->json($municipios, 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo mostrar municipios '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function municipios_departamento($id_depto)
    {
        //
        try{
            $municipios = municipios::where([
                                ['id_departamento', $id_depto],
                                ['tipo','CM']
            ])->get();

            return response()->json($municipios, 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo mostrar municipios '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function update(Request $request, $id)
    {
        //
        try{
            
            $departamento_query = DB::table('departamento')->where('id_departamento', $id);

            $departamento_query->update(['descrpcion' => $request('descrpcion')]);
            
            return response()->json('municipios actualizada!', 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo actualizar municipios '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function destroy($id)
    {
        //
        try{
            $municipios = municipios::find($id);
            
            if(!$municipios){
                return response()->json(['Este Id no existe.'], 404);
            }
            
            $municipios->delete();
            
            return response()->json('municipios eliminado.', 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo eliminar municipios '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

}
