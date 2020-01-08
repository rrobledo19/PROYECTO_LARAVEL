<?php

namespace App\Http\Controllers;

use  App\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use JasperPHP\JasperPHP as JasperPHP; 

class controller_clientes extends Controller
{
    public function index(){ //select de todos
        $cliente = Cliente::all()->toArray(); 
        return response()->json($cliente);
    }

    public function buscar_x_cedula($cedula){

        $cliente = Cliente::where('n_identificacion', $cedula)->get();

        return response()->json($cliente);
    }

    public function store(Request $request)
    {
        //
        try{
            
            /*
                Equivalente a:
                    INSERT INTO cr_df_clientes(...)
                    VALUES(...)
            */
            $clientes = new Cliente([

                'id_clientes'       => $request->input('id_clientes'),  
                'n_formato'         => $request->input('n_formato'), 
                'nombres'           => $request->input('nombres'),  
                'apellidos'         => $request->input('apellidos'),  
                'direccion'         => $request->input('direccion'),  
                'telefono'          => $request->input('telefono'), 
                'email'             => $request->input('email'),  
                'identificacion'    => $request->input('identificacion'),  
                'n_identificacion'  => $request->input('n_identificacion'),  
                'departamento'      => $request->input('departamento'),  
                'municipio'         => $request->input('municipio'),  
                'barrio'            => $request->input('barrio'),   
                'observacion'       => $request->input('observacion'),  
                'estado'            => $request->input('estado'),
                  
            ]);
            
            Log::info('Cliente  almacenada con existos!');
            
            $clientes->save();
            
            return response()->json(['status' => true, 'Genial!'], 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo almacenar modelo de clientes  '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }


    public function show($id)
    {
        /*
            Equivalente a:
                SELECT * 
                FROM cr_df_clientes 
                WHERE id_cliente = ?
        */
        try{
            $cliente = Cliente::find($id);
            
            if(!$cliente){
                return response()->json(['Este Id no existe.'], 404);
            }
            
            return response()->json($cliente, 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo mostrar Cliente '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function update(Request $request, $id)
    {
        /*
            Equivalente a:
                UPDATE cr_df_clientes 
                SET ...
                WHERE id_cliente = ?
        */
        try{
            
            Cliente::where('id_cliente', $id)
            ->update([                
                'n_formato'         => $request->n_formato, 
                'nombres'           => $request->nombres,  
                'apellidos'         => $request->apellidos,  
                'direccion'         => $request->direccion,  
                'telefono'          => $request->telefono, 
                'email'             => $request->email,  
                'identificacion'    => $request->identificacion,  
                'n_identificacion'  => $request->n_identificacion,  
                'departamento'      => $request->departamento,  
                'municipio'         => $request->municipio,  
                'barrio'            => $request->barrio,   
                'observacion'       => $request->observacion,  
                'estado'            => $request->estado
            ]);

            Log::info('res !'.$id);
            
            return response()->json('Cliente actualizada!', 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo actualizar Cliente '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function destroy($id)
    {
        /*
            Equivalente a:
                DELETE FROM cr_df_clientes WHERE id_cliente = ?
        */
        try{
            $clientes = Cliente::find($id);
            
            if(!$clientes){
                return response()->json(['Este Id no existe.'], 404);
            }
            
            $clientes->delete();
            
            return response()->json('Cliente eliminado.', 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo eliminar Cliente '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
            return response(' [x_x]: Oh Oh! Algo ha salido mal.', 500);
        }
    }

    public function Compilar()
    {
        $jasper = new JasperPHP;
        $jasper->compile(base_path('/vendor/cossou/jasperphp/examples/hello_world.jrxml'))->execute();
    }
   
   
   
    public function Reporte()
    {
      
   // Crear el objeto JasperPHP
   $jasper = new JasperPHP;
    
  $jasper->process(
        // Ruta y nombre de archivo de entrada del reporte
        base_path() . '/vendor/cossou/jasperphp/examples/hello_world.jasper', 
        false, // Ruta y nombre de archivo de salida del reporte (sin extensión)
        array('pdf', 'rtf'), // Formatos de salida del reporte
        array('php_version' => phpversion()) // Parámetros del reporte
        array(
            'driver' => 'mysql',
            'username' => 'root',
            'password' => '',
            'host' => '127.0.0.1',
            'database' => 'dbcreditos',
            'port' => '3306',
            'jdbc_dir' => base_path(). '/vendor/geekcom/phpjasper/bin/jasperstarter/jdbc'
           )
    )->execute();    

  }
}