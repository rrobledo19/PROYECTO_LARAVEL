<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class model_pagosmaestro extends Model
{
    //
    public $timestamps = false;
    protected  $table = 'pagos_maestro';
 
    protected $fillable = [
     'id_clientes', 
     'n_formato', 
     'nombres', 
     'apellidos', 
     'direccion', 
     'telefono',
     'email', 
     'identificacion', 
     'n_identificacion', 
     'departamento', 
     'municipio', 
     'barrio', 
     'cobrador', 
     'referencia', 
     'observacion', 
     'estado'
    ];
}
