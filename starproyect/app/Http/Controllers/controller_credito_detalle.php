<?php

namespace App\Http\Controllers;

use  App\model_credito_detalle;
use Illuminate\Support\Facades\Input; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class controller_credito_detalle extends Controller
{
    //
    public function index(){
        $credito_detalle = model_credito_detalle::all()->toArray(); 
        return response()->json($credito_detalle);
    }

    public function store(Request $request)
    {
        //
        try{
            
            $credito_detalle = new model_credito_detalle([

                'id_credito' => $request->input('id_credito'), 
                'nro_coutas' => $request->input('nro_coutas'),
                'fecha_credito' => $request->input('fecha_credito'),
                'vlor_capital' => $request->input('vlor_capital'),
                'vlor_interes' => $request->input('vlor_interes'),
                'vlor_couta' => $request->input('vlor_couta'),
                'vlor_saldo' => $request->input('vlor_saldo')                
            ]);
            
            Log::info('model_credito_detalle  almacenada con existos!');
            
            $credito_detalle->save();
            
            return response()->json(['status' => true, 'Genial!'], 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo almacenar modelo de carteras  '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }


    public function buscar_x_credito($credito){

        $cred_det = DB::table('credito_detalle')
                            ->where('id_credito', $credito)
                            ->get();

        return response()->json($cred_det);
    }

    public function show($id)
    {
        //
        try{
            $credito_detalle = model_credito_detalle::find($id);
            
            if(!$credito_detalle){
                return response()->json(['Este Id no existe.'], 404);
            }
            
            return response()->json($credito_detalle, 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo mostrar model_credito_detalle '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function update(Request $request, $id)
    {
        //
        try{
            
            $credito_detalle = model_credito_detalle::find($id);
            
            if(!$credito_detalle){
                return response()->json(['Este Id no existe.'], 404);
            }
            
            $credito_detalle ->update($request->all());

            $credito_detalle->save();
            
            return response()->json('model_credito_detalle actualizada!', 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo actualizar model_credito_detalle '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function destroy($id)
    {
        //
        try{
            $credito_detalle = model_credito_detalle::find($id);
            
            if(!$credito_detalle){
                return response()->json(['Este Id no existe.'], 404);
            }
            
            $credito_detalle->delete();
            
            return response()->json('model_credito_detalle eliminado.', 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo eliminar model_credito_detalle '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }
}
