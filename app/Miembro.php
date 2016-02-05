<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Miembro extends Model
{
     protected $fillable = [
     'nombre',
     'apellidos',
     'email',
     'telefono',
     'status',
     'foto',
     'sucursal_id',
     'membresia_id',
     'comentarios', 
     'user_id',
     ];

     public function membresia()
     {
         return $this->belongsTo('App\Membresia');
    }

    public function sucursal()
    {
         return $this->belongsTo('App\Sucursal');
    }

    public function user()
    {
         return $this->belongsTo('App\User');
    }



}
