<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membresia extends Model
{
	protected $table = 'membresias';
	
	public function miembro()
	{
		return $this->hasOne('App\Miembro');
	}
}
