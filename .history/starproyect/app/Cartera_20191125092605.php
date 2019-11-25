<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartera  extends Model
{
    //
    public $timestamps = false;
   protected  $table = 'cr_gs_carteras';

   protected $fillable = [
    'id_cartera', 
    'id_cliente', 
    'id_credito', 
    'vlor_facturado', 
    'vlor_pagado', 
    'vlor_saldo'
   ];
}
