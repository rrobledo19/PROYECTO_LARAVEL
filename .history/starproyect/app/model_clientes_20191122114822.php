<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

 

class model_clientes extends Model
{
   public $timestamps = false;
   protected  $table = 'cr_df_cliente';

   protected $fillable = [
    'id_cliente', 
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
    'observacion', 
    'estado'
   ];
}
