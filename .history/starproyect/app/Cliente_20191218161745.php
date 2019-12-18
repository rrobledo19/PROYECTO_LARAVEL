<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

 

class Cliente extends Model
{
   public $timestamps = false;
   protected  $table = 'cr_df_clientes';

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
