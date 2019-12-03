<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credito_detalle extends Model
{
    //
   public $timestamps = false;

   protected  $table = 'cr_gs_creditos_detalle';
   
   protected $primaryKey = 'id_credito_detalle';

   protected $fillable = [
    'id_credito_detalle',
    'id_credito',
    'nro_coutas',
    'fecha_credito',
    'vlor_capital',
    'vlor_interes',
    'vlor_couta',
    'vlor_saldo',
    'estado'
   ];
}
