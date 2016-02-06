<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
	protected $table = 'sucursales';
	protected $fillable = [
	'nombre',
	'direccion',
	'telefono',
	];

	public function miembro()
	{
		return $this->hasOne('App\Miembro');
	}
}
