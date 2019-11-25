<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class departamento extends Model
{
    //
    public $timestamps = false;
	
	protected $table = 'cr_df_departamentos';
	
	protected $fillable = [
		'id_departamento',
		'descrpcion',
	];
}
