<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class municipio extends Model
{
    //

    public $timestamps = false;
	
	protected $table = 'cr_df_municipios';
	
	protected $fillable = [
		'id_municipio',
		'id_departamento',
		'descripcion',
		'tipo',
	];
}
