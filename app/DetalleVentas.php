<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVentas extends Model
{
    protected $fillable =[	'concepto', 'precio',
 'user_id', 'cantidad', 'ticket_id'];

  public function producto()
    {
        return $this->belongsTo('App\Producto');
    }
}
