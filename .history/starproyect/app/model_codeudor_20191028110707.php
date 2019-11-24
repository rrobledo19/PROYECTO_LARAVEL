<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class model_codeudor extends Model
{
    //
    public $timestamps = false;
   protected  $table = 'codeudor';

   protected $fillable = [
    'id_codeudor', 
    'id_cliente', 
    'id_credito', 
    'vlor_facturado', 
    'vlor_pagado', 
    'vlor_saldo'
   ];
}
