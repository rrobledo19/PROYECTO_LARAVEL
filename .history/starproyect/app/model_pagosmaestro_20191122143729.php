<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class model_pagosmaestro extends Model
{
    //
    public $timestamps = false;
    protected  $table = 'cr_gs_pagos_maestro';
 
    protected $fillable = [
     'id_cliente', 
     'id_pagos', 
     'id_credito', 
     'fecha_pago', 
     'estado', 
     'saldo_capital', 
     'saldo_interes' 
    ];
}
