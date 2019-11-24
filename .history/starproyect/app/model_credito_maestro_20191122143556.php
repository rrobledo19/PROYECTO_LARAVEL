<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class model_credito_maestro extends Model
{
    //
    public $timestamps = false;
   protected  $table = 'cr_gs_credito_maestro';

   protected $fillable = [
    'id_credito', 
    'id_cliente',
    'fecha_credito' ,
    'fecha_vencimiento',
    'vlor_capital',
    'vlor_interes',
    'vlor_estudios',
    'nro_coutas',
    'tasa',
    'periodo',
    'estado',
    'vlor_couta',
    'vlor_saldo'
   ];
}