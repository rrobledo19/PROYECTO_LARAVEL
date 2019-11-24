<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class model_pagosdetalles extends Model
{
    public $timestamps = false;
    protected  $table = 'pagos_detalles';
 
    protected $fillable = [
        'id',
        'id_pagos',  
        'fecha_pago', 
        'nro_coutas', 
        'vlor_couta'
    ];
}
