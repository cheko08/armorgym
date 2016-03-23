<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $fillable = [
    'user_id', 'sucursal_id', 'status',
     'monto_inicial','ingresos', 'egresos'];
}
