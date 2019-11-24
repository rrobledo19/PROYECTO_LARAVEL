<?php

namespace App\Http\Controllers;
use  App\model_pagosmaestro;
use  App\model_pagosdetalles;
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
            
            $id = DB::table('pagos_maestro')->insertGetId([
                //'id_pagos' => $request->input('id_pago'),
                'id_credito' => $request->input('id_credito'),
                'fecha_pago' => $request->input('fecha_pago'),
                'estado' => $request->input('estado'),
                'saldo_capital' => $request->input('saldo_capital'), 
                'saldo_interes' => $request->input('saldo_interes')               
            ]);
            
            Log::info('pagos maestros  almacenado con existos!');
                                
            return response()->json(['status' => true, 'id_inserted' => $id, 'Genial!'], 200);
            
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


   /* public function mincouta($id_credito){
                  $query = DB::table('V_CREDITOS')
                     ->where ('id_credito',$id_credito)
                     ->get();

                     return response()->json($query);


                

    }*/

    public function mincouta(){
    $query = DB::table('credito_detalle')->select('credito_detalle.id_credito', 
    'credito_detalle.nro_coutas',
    'credito_detalle.fecha_credito',
    'credito_detalle.vlor_capital', 
    'credito_detalle.vlor_interes', 
    'credito_detalle.vlor_couta',
    'credito_detalle.vlor_saldo', 
    'credito_detalle.id_credito_detalle',
    'credito_detalle.estado',
    'credito_maestro.id_credito',
    'credito_maestro.id_cliente',
    'credito_maestro.fecha_credito',
    'credito_maestro.fecha_vencimiento',
    'credito_maestro.vlor_capital' ,
    'credito_maestro.vlor_interes',  
    'credito_maestro.vlor_estudios', 
    'credito_maestro.nro_coutas', 
    'credito_maestro.tasa' ,
    'credito_maestro.periodo', 
    'credito_maestro.estado', 
    'credito_maestro.vlor_couta', 
    'credito_maestro.vlor_saldo' 
    
    )
            ->join('credito_maestro', 'credito_detalle.id_credito', '=', 'credito_maestro.id_credito')
            ->join('clientes', 'clientes.id_clientes', '=', 'credito_maestro.id_cliente')
            ->where([
                ['credito_detalle.estado', '=', 'P'],
                ['credito_detalle.nro_coutas', '>', 0]
            
                
            ])->orderBy('id_credito', 'desc')
            ->get();

            return response()->json($query); 
    }

    public function storeDetallePago(Request $request, $id_pago){
        try{

            $detalle = new model_pagosdetalles([					
                'id_pagos' => $id_pago,
                'nro_coutas' => $request->input('nro_coutas'),
                'vlor_couta' => $request->input('vlor_couta'),
                'mnto_pagado' => $request->input('mnto_pagado')
            ]);
            
            //Log::info('inv_entradas_detalle almacenada!');
        
            $detalle->save();
                        
        }catch(\Exception $e){
            Log::critical('No se pudo almacenar Credito_detalle  '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }
}
