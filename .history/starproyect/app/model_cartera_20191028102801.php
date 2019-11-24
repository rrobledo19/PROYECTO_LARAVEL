<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class model_cartera extends Model
{
    //
    public $timestamps = false;
   protected  $table = 'clientes';

   protected $fillable = [
    'id_cartera', 
    'id_cliente', 
    'id_credito', 
    'vlor_facturado', 
    'vlor_pagado', 
    'vlor_saldo'
   ];
}