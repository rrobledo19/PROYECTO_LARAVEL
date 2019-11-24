<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class model_departamento extends Model
{
    //
    public $timestamps = false;
	
	protected $table = 'departamento';
	
	protected $fillable = [
		'id_departamento',
		'descrpcion',
	];
}
