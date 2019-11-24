<?php

namespace App\Http\Controllers;

use  App\model_departamento;
use Illuminate\Support\Facades\Input; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class departamento_controller extends Controller
{
    //
    public function index(){
        $departamentos = model_departamento::all()->toArray(); 
        return response()->json($departamentos);
    }

    public function store(Request $request)
    {
        //
        try{
            
            $departamentos = new model_departamento([

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
}
