<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVentas extends Model
{
    protected $fillable =[
    'producto_id', 'user_id', 'cantidad', 'ticket_id'];

  public function producto()
    {
        return $this->belongsTo('App\Producto');
    }
}
