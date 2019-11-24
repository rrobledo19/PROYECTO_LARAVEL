<?php

namespace App\Http\Controllers;
use  App\model_pagosmaestro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class controller_pagosmaestro extends Controller
{
   
    public function index(){
        $pagosmaestro = model_pagosmaestro::all()->toArray(); 
        return response()->json($pagosmaestro);
    }

    public function store(Request $request)
    {
        //
        try{
            
            $pagosmaestro  = new model_pagosmaestro([
                'id_pagos' => $request->input('id_pago'),
                'id_credito' => $request->input('id_credito'),
                'fecha_pago' => $request->input('fecha_pago'),
                'estado' => $request->input('estado'),
                'saldo_capital' => $request->input('saldo_capital'), 
                'saldo_interes' => $request->input('saldo_interes')
               
            ]);
            
            Log::info('pagos maestros  almacenado con existos!');
            
            $pagosmaestro ->save();
            
            return response()->json(['status' => true, 'Genial!'], 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo almacenar pagos maestros  '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function show($id)
    {
        //
        try{
            $pagosmaestro  = model_pagosmaestro::find($id);
            
            if(!$pagosmaestro ){
                return response()->json(['Este Id no existe.'], 404);
            }
            
            return response()->json($pagosmaestro , 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo mostrar model_pagosmaestro '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function update(Request $request, $id)
    {
        //
        try{
            
            $pagos_query = DB::table('pagos_maestro')->where('id_pagos', $id);

            $pagos_query->update(['descrpcion' => $request('descrpcion')]);
            
            return response()->json('model_pagosmaestro actualizada!', 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo actualizar model_pagosmaestro '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function destroy($id)
    {
        //
        try{
            $pagosmaestro  = model_pagosmaestro::find($id);
            
            if(!$pagosmaestro ){
                return response()->json(['Este Id no existe.'], 404);
            }
            
            $pagosmaestro ->delete();
            
            return response()->json('model_pagosmaestro eliminado.', 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo eliminar model_pagosmaestro '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }


    public function mincouta(){
      /* $price = DB::table('credito_detalle')
                ->select(DB::raw('*'))
                ->where('nro_coutas','>',0)
                ->;
                
                  return response()->json($price);*/


                  $price = DB::table('credito_detalle')
                     ->select('id_credito','fecha_credito',DB::raw('count(*) as contar'))
                     ->groupBy('id_credito')
                     ->get();

                     return response()->json($price);
                

    }
}
