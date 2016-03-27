<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
	protected $fillable = ['producto_id', 'sucursal_id', 'cantidad'];

	public function sucursal()
	{
		return $this->belongsTo('App\Sucursal');
	}

	public function producto()
	{
		return $this->belongsTo('App\Producto');
	}
}
