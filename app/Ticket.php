<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
	protected $fillable = [
	'user_id', 'pagado', 'cambio',
	'caja_id', 'status'];
}
