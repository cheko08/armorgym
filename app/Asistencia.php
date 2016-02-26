<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
   protected $fillable = [
    'miembro_id', 'fecha_asistencia'
    ];

      public function miembro()
    {
        return $this->belongsTo('App\Miembro')->withTrashed();;
    }
}
