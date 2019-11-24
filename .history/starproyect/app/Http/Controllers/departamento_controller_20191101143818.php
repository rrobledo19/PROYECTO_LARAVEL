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
}
