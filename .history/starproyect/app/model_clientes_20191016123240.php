<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

 

class model_clientes extends Model
{
   public $timestamps = false;
   protected  $table = 'clientes';

   protected $fillable = [
    'consecutivo', 
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
