<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class model_credito_detalle extends Model
{
    //
    public $timestamps = false;
   protected  $table = 'credito_detalle';

   protected $fillable = [
    'id_credito',
    'nro_coutas',
    'fecha_credito',
    'vlor_capital',
    'vlor_interes',
    'vlor_couta',
    'vlor_saldo'
   ];
}
