<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
   protected $table = 'sucursales';

   
       public function miembro()
    {
        return $this->hasOne('App\Miembro');
    }
}
