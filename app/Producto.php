<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
    'codigo', 'descripcion', 'precio', 'costo', 'cantidad','sucursal_id'];

       public function sucursal()
   {
       return $this->belongsTo('App\Sucursal');
   }
}
