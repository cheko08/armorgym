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
        return $this->belongsTo('App\Miembro')->withTrashed();;
    }

       public function user()
    {
        return $this->belongsTo('App\User')->withTrashed();;
    }
}
