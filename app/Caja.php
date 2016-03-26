<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $fillable = [
    'user_id', 'sucursal_id', 'status',
     'monto_inicial','ingresos', 'egresos','fecha'];

         public function user()
    {
        return $this->belongsTo('App\User')->withTrashed();
    }

     public function sucursal()
   {
       return $this->belongsTo('App\Sucursal');
   }
}
