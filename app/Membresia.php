<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Membresia extends Model
{
	use SoftDeletes;
    
    protected $dates = ['deleted_at'];

	protected $table = 'membresias';
	protected $fillable = [
    'nombre', 'precio_mensual', 'inscripcion','descripcion','status'
    ];
	
	public function miembro()
	{
		return $this->hasOne('App\Miembro');
	}
}
