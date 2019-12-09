<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagoDetalle extends Model
{
    public $timestamps = false;
    protected  $table = 'cr_gs_pagos_detalle';
 
    protected $fillable = [
        'id_pagos_detalle',
        'id_pagos', 
        'nro_coutas',
        'vlor_couta' , 
        'mnto_pagado', 
        'vlor_capital_pgdo',
        'vlor_interes_pgdo',  
        'id_credito_detalle' 

    ];
}
