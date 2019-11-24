<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class model_codeudor extends Model
{
    //
    public $timestamps = false;
   protected  $table = 'cr_df_codeudores';

   protected $fillable = [
    'id_codeudor', 
    'id_cliente', 
    'nombre', 
    'apellido', 
    'direccion', 
    'telefono',
    'identificacion',
    'estado'
   ];
}
