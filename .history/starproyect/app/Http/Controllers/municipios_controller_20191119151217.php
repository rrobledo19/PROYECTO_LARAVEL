<?php

namespace App\Http\Controllers;

use  App\model_municipios;
use Illuminate\Support\Facades\Input; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class municipios_controller extends Controller
{
    //
    public function index(){
        $municipios = model_municipios::all()->toArray(); 
        return response()->json($municipios);
    }

    public function store(Request $request)
    {
        //
        try{
            
            $municipios = new model_municipios([
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
            $municipios = DB::table('municipio')->where('id_municipio', $id)->get();

            return response()->json($municipios, 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo mostrar model_municipios '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function municipios_departamento($id_depto)
    {
        //
        try{
            // $municipios = DB::table('municipio')                            
            //                 ->where('id_departamento', $id_depto)
            //                 ->whereIn('tipo',['CM','C'])
            //                 ->get();

            $municipios = DB::raw('select m.id_municipio, m.id_departamento, m.descripcion,m.tipo from municipio m 
            where  m.id_departamento = \'08\'
             and  m.tipo in (\'CM\',\'C\')  and m.id_municipio in(select max(x.id_municipio) from municipio x 
             where x.id_departamento = m.id_departamento and  x.descripcion = m.descripcion )
             group by m.id_departamento, m.descripcion,m.tipo');

            return response()->json($municipios, 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo mostrar model_municipios '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function update(Request $request, $id)
    {
        //
        try{
            
            $departamento_query = DB::table('departamento')->where('id_departamento', $id);

            $departamento_query->update(['descrpcion' => $request('descrpcion')]);
            
            return response()->json('model_municipios actualizada!', 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo actualizar model_municipios '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function destroy($id)
    {
        //
        try{
            $municipios = model_municipios::find($id);
            
            if(!$municipios){
                return response()->json(['Este Id no existe.'], 404);
            }
            
            $municipios->delete();
            
            return response()->json('model_municipios eliminado.', 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo eliminar model_municipios '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

}
