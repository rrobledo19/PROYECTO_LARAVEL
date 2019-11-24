<?php

namespace App\Http\Controllers;
use  App\model_pagosmaestro;
use Illuminate\Http\Request;

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
                'id_departamento' => $request->input('id_departamento'), 
                'descrpcion' => $request->input('descrpcion')
            ]);
            
            Log::info('Departamento  almacenado con existos!');
            
            $pagosmaestro ->save();
            
            return response()->json(['status' => true, 'Genial!'], 200);
            
        }catch(\Exception $e){
            Log::critical('No se pudo almacenar departamento  '.$e->getCode().', '.$e->getLine().', '.$e->getMessage());
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
            
            $departamento_query = DB::table('departamento')->where('id_departamento', $id);

            $departamento_query->update(['descrpcion' => $request('descrpcion')]);
            
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
}
