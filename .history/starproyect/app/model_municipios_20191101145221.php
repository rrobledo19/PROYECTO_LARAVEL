<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class model_municipios extends Model
{
    //

    public $timestamps = false;
	
	protected $table = 'municipio';
	
	protected $fillable = [
		'id_municipio',
		'id_departamento',
		'descripcion',
		'tipo',
	];
}
