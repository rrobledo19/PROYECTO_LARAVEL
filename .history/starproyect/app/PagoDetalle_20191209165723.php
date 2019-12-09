<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagoDetalle extends Model
{
    public $timestamps = false;
    protected  $table = 'cr_gs_pagos_detalle';
 
    protected $fillable = [
        'id_credito', 
        'nro_coutas',
        'fecha_credito',
        'vlor_capital', 
        'vlor_interes', 
        'vlor_couta', 
        'vlor_saldo', 
        'id_credito_detalle', 
        'estado' 

    ];
}
