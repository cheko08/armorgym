<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
      protected $fillable = [
    'miembro_id',
    'cantidad',
    'fecha_pago',
    'user_id',
    ];


       public function miembro()
    {
        return $this->hasMany('App\Miembro');
    }
}
