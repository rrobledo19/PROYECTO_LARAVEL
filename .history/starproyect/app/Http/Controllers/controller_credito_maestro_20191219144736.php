<?php

namespace App\Http\Controllers;

use  App\credito_maestro;
use  App\credito_detalle;

use Illuminate\Support\Facades\Input; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class controller_credito_maestro extends Controller
{
    //
    public function index(){
        $credito_maestro = credito_maestro::all()->toArray(); 
        return response()->json($credito_maestro);
    }

    public function store(Request $request)
    {
        //
        try{
            
            $id = credito_maestro::insertGetId([
                'id_credito' => $request->input('id_credito'), 
                'id_cliente' => $request->input('id_cliente'),
                'fecha_credito' => $request->input('fecha_credito'),
                'fecha_vencimiento' => $request->input('fecha_vencimiento'),
                'vlor_capital' => $request->input('vlor_capital'),
                'vlor_interes' => $request->input('vlor_interes'),
                'vlor_estudios' => $request->input('vlor_estudios'),
                'nro_coutas' => $request->input('nro_coutas'),
                'tasa' => $request->input('tasa'),
                'periodo' => $request->input('periodo'),
                'estado' => $request->input('estado'),
                'vlor_couta' => $request->input('vlor_couta'),
                'vlor_saldo' => $request->input('vlor_saldo')
            ]);
           
            /*$credito_maestro = new credito_maestro([

                'id_credito' => $request->input('id_credito'), 
                'id_cliente' => $request->input('id_cliente'),
                'fecha_credito' => $request->input('fecha_credito'),
                'fecha_vencimiento' => $request->input('fecha_vencimiento'),
                'vlor_capital' => $request->input('vlor_capital'),
                'vlor_interes' => $request->input('vlor_interes'),
                'vlor_estudios' => $request->input('vlor_estudios'),
                'nro_coutas' => $request->input('nro_coutas'),
                'tasa' => $request->input('tasa'),
                'periodo' => $request->input('periodo'),
                'estado' => $request->input('estado'),
                'vlor_couta' => $request->input('vlor_couta'),
                'vlor_saldo' => $request->input('vlor_saldo')
                  
            ]);
            
            Log::info('credito_maestro  almacenada con existos!');
            
            $credito_maestro->save();*/
            
            return response()->json(['status' => true, 'id_inserted' => $id, 'Genial!'], 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo almacenar credito_maestro  '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function storeDetalleCredito(Request $request){
        try{
            
            $datos_detalle = json_decode($request->getContent());

            //Log::info($datos_detalle);

            foreach($datos_detalle as $d){

                //Log::info('id_credito: '.$d->id_credito);
                
                $detalle = new  credito_detalle([
					'id_credito' => $d->id_credito,
                    'nro_coutas' => $d->nro_coutas,
                    'fecha_credito' => $d->fecha_credito,
                    'vlor_capital' => $d->vlor_capital,
                    'vlor_interes' => $d->vlor_interes,
                    'vlor_couta' => $d->vlor_couta,
                    'vlor_saldo' => $d->vlor_saldo,
                    'estado' => $d->nro_coutas == 1 ? 'P':'N'
				]);
				
				//Log::info('inv_entradas_detalle almacenada!');
			
				$detalle->save();
            }
            
        }catch(\Exception $e){
            Log::critical('No se pudo almacenar Credito_detalle  '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }


    public function show($id)
    {
        //
        try{
            $credito_maestro = credito_maestro::find($id);
            
            if(!$credito_maestro){
                return response()->json(['Este Id no existe.'], 404);
            }
            
            return response()->json($credito_maestro, 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo mostrar credito_maestro '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function show_x_cliente($id_cliente)
    {
        //
        try{
            //Colocar los campos que se visualizarán del maestro creditos.
            $credito_maestro = credito_maestro::select(DB::raw('id_credito,fecha_credito as Fecha Credito,fecha_vencimiento as Fecha Vencimiento'))->where('id_cliente', '=', $id_cliente)->get();
            
            if(!$credito_maestro){
                return response()->json(['Este Id_cliente no existe.'], 404);
            }
            
            return response()->json($credito_maestro, 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo mostrar credito_maestro '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function show_detalle_credito($id_credito) {
        try{
            //Colocar los campos que se visualizarán del maestro detalle.
            $credito_detalle = credito_detalle::select(DB::raw('*'))
                                ->where('id_credito', '=', $id_credito)
                                ->get();
            
            if(!$credito_detalle){
                return response()->json(['Este Id no existe.'], 404);
            }
            
            return response()->json($credito_detalle, 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo mostrar credito_detalle '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function update(Request $request, $id)
    {
        //
        try{
            
            $credito_maestro = credito_maestro::find($id);
            
            if(!$credito_maestro){
                return response()->json(['Este Id no existe.'], 404);
            }
            
            $credito_maestro ->update($request->all());

            $credito_maestro->save();
            
            return response()->json('credito_maestro actualizada!', 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo actualizar credito_maestro '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function destroy($id)
    {
        //
        try{
            $credito_maestro = credito_maestro::find($id);
            
            if(!$credito_maestro){
                return response()->json(['Este Id no existe.'], 404);
            }
            
            $credito_maestro->delete();
            
            return response()->json('credito_maestro eliminado.', 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo eliminar credito_maestro '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }
}
