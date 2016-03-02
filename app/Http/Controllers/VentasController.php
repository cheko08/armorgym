<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class VentasController extends Controller
{
     public function __construct()
	{
		$this->middleware('auth');
	}

	public function puntoVenta()
	{
		return view('ventas.punto-venta');
	}


}
