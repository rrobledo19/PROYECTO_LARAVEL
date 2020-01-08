<?php

namespace App\Http\Controllers;
use  App\pagosmaestro;
use  App\PagoDetalle;
use  App\credito_detalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class controller_pagosmaestro extends Controller
{
   
    public function index(){
        $pagosmaestro = pagosmaestro::all()->toArray(); 
        return response()->json($pagosmaestro);
    }

    public function store(Request $request)
    {
        //
        try{
            
            $id = pagosmaestro::insertGetId([
                'id_pagos' => $request->input('id_pago'),
                'id_credito' => $request->input('id_credito'),
                'fecha_pago' => $request->input('fecha_pago'),
                'estado' => $request->input('estado'),  
                'vlor_pagado' => $request->input('valor_pagado'),  
                'cta_bncaria' => $request->input('cta_bncaria'),
                'frma_pago' => $request->input('frma_pago')
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
            $pagosmaestro  = pagosmaestro::find($id);
            
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
            
            $pagos_query = pagosmaestro::where('id_pagos', $id);

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
            $pagosmaestro  = pagosmaestro::find($id);
            
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
    $query = credito_detalle::select('cr_gs_creditos_detalle.id_credito', 
    'cr_gs_creditos_detalle.nro_coutas as numero_couta',
    'cr_gs_creditos_detalle.fecha_credito',
    'cr_gs_creditos_detalle.vlor_capital', 
    'cr_gs_creditos_detalle.vlor_interes', 
    'cr_gs_creditos_detalle.vlor_couta',
    'cr_gs_creditos_detalle.vlor_saldo', 
    'cr_gs_creditos_detalle.id_credito_detalle',
    'cr_gs_creditos_detalle.estado',
    'cr_gs_creditos_maestro.id_cliente',
    'cr_gs_creditos_maestro.fecha_credito',
    'cr_gs_creditos_maestro.fecha_vencimiento',
    'cr_gs_creditos_maestro.vlor_capital' ,
    'cr_gs_creditos_maestro.vlor_interes',  
    'cr_gs_creditos_maestro.vlor_estudios', 
    'cr_gs_creditos_maestro.nro_coutas', 
    'cr_gs_creditos_maestro.tasa' ,
    'cr_gs_creditos_maestro.periodo', 
    'cr_gs_creditos_maestro.estado', 
    'cr_gs_creditos_maestro.vlor_couta', 
    'cr_gs_creditos_maestro.vlor_saldo' 
    
    )
            ->join('cr_gs_creditos_maestro', 'cr_gs_creditos_detalle.id_credito', '=', 'cr_gs_creditos_maestro.id_credito')
            ->join('cr_df_clientes', 'cr_df_clientes.id_cliente', '=', 'cr_gs_creditos_maestro.id_cliente')
            ->where([
                ['cr_gs_creditos_detalle.estado', '=', 'P'],
                ['cr_gs_creditos_detalle.nro_coutas', '>', 0]
            
                
            ])->orderBy('id_credito', 'desc')
            ->get();

            return response()->json($query); 
    }    


   public function listado_pagos(){
    try{  
    $query = PagoDetalle::select('cr_gs_pagos_detalle.id_pagos', 
                                    'cr_gs_pagos_detalle.nro_coutas', 
                                    'cr_gs_pagos_detalle.vlor_capital_pgdo', 
                                    'cr_gs_pagos_detalle.vlor_interes_pgdo', 
                                    'cr_gs_pagos_detalle.mnto_pagado')
                                    -> join ('cr_gs_creditos_detalle','cr_gs_pagos_detalle.id_credito_detalle','=','cr_gs_creditos_detalle.id_credito_detalle')
                                    -> where(['cr_gs_creditos_detalle.id_credito','=','76']) ->get();
                               
                                    Log::info('consultasql: '.$query);
                               
                                    return response()->json($query); 
                                }catch(\Exception $e){
                                    Log::critical('No se pudo error en consulta  '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
                                    return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
                                }
   }

  
    public function storeDetallePago(Request $request, $id_pago){
        try{

            $cuotas_cr = credito_detalle::where([
                                ['id_credito', $request->input('id_credito')],
                                ['nro_coutas', '>', 0]
            ])->get();

            $data_detalle = json_decode($cuotas_cr);

            $monto_aplicar = $request->input('mnto_pagado');

            Log::info('Id Pago: '.$id_pago);

            //$detalle = new pagodetalle;

            foreach($data_detalle as $detalle) {

                Log::info('Cuota: '.$detalle->nro_coutas.', valor: '.$detalle->vlor_couta.', monto: '.$monto_aplicar);

                if ($monto_aplicar > 0) {
                    if ($detalle->vlor_couta == $monto_aplicar) {
                        //Si el monto a pagar es igual al total de una cuota, se aplica a esa cuota
                        $detalle = new PagoDetalle([					
                            'id_pagos' => $id_pago,
                            'nro_coutas' => $detalle->nro_coutas,
                            'vlor_couta' => $detalle->vlor_couta,
                            'mnto_pagado' => $monto_aplicar,
                            'vlor_capital_pgdo' => $detalle->vlor_capital,
                            'vlor_interes_pgdo' => $detalle->vlor_interes,
                            'id_credito_detalle' => $detalle->id_credito_detalle                            
                        ]);

                        $monto_aplicar = $monto_aplicar - $detalle->vlor_couta;

                        $detalle->save();                        

                        Log::info('inv_entradas_detalle almacenada! 1');

                    }elseif($detalle->vlor_couta < $monto_aplicar){
                        $detalle = new PagoDetalle([					
                            'id_pagos' => $id_pago,
                            'nro_coutas' => $detalle->nro_coutas,
                            'vlor_couta' => $detalle->vlor_couta,
                            'mnto_pagado' => $detalle->vlor_couta,
                            'vlor_capital_pgdo' => $detalle->vlor_capital,
                            'vlor_interes_pgdo' => $detalle->vlor_interes,
                            'id_credito_detalle' => $detalle->id_credito_detalle
                        ]);
                        
                        $monto_aplicar = $monto_aplicar - $detalle->vlor_couta;
                        
                        $detalle->save();

                        Log::info('inv_entradas_detalle almacenada! 2');

                    }elseif($detalle->vlor_couta > $monto_aplicar){
                        $detalle = new PagoDetalle([					
                            'id_pagos' => $id_pago,
                            'nro_coutas' => $detalle->nro_coutas,
                            'vlor_couta' => $detalle->vlor_couta,
                            'mnto_pagado' => $monto_aplicar,
                            'vlor_capital_pgdo' => $detalle->vlor_capital,
                            'vlor_interes_pgdo' => $detalle->vlor_interes,
                            'id_credito_detalle' => $detalle->id_credito_detalle
                        ]);

                        $monto_aplicar = 0;

                        $detalle->save();

                        Log::info('inv_entradas_detalle almacenada! 3');
                    }                    
                }
            }
            
            //Log::info('inv_entradas_detalle almacenada!');
                        
        }catch(\Exception $e){
            Log::critical('No se pudo almacenar Credito_detalle  '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }
}
