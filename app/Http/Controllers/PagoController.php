<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Miembro;
use App\Pago;
use DateTime;
use Auth;

class PagoController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}

	public function pagar($id)
	{
		$miembro = Miembro::findOrFail($id);
		return view('pagos.pagar', compact('miembro'));
	}

	public function realizarPago(Request $request, $id)
	{
		$miembro_id = $id;
		$miembro = Miembro::findOrFail($id);

		$cantidad = $miembro->membresia->precio_mensual;
		$fecha_pago =  Date('Y-m-d');
		$user_id = Auth::user()->id;

		$pago = Pago::create([
			'miembro_id' => $miembro_id,
			'cantidad' => $cantidad,
			'fecha_pago' => $fecha_pago,
			'user_id' => $user_id,
			]);

		if($pago)
		{
			$monthToAdd = 1;

			if($miembro->fecha_proximo_pago >= $fecha_pago)
			{
				$d1 = DateTime::createFromFormat('Y-m-d', $miembro->fecha_proximo_pago);
			}
			else
			{
				$d1 = DateTime::createFromFormat('Y-m-d', $fecha_pago);
			}

		

		$year = $d1->format('Y');
		$month = $d1->format('n');
		$day = $d1->format('d');

		$year += floor($monthToAdd/12);
		$monthToAdd = $monthToAdd%12;
		$month += $monthToAdd;
		if($month > 12) {
			$year ++;
			$month = $month % 12;
			if($month === 0)
				$month = 12;
		}

		if(!checkdate($month, $day, $year)) {
			$d2 = DateTime::createFromFormat('Y-n-j', $year.'-'.$month.'-1');
			$d2->modify('last day of');
		}else {
			$d2 = DateTime::createFromFormat('Y-n-d', $year.'-'.$month.'-'.$day);
		}
		
		$fecha_proximo_pago = $d2->format('Y-m-d');
			
			$miembro->fecha_proximo_pago = $fecha_proximo_pago;
			$miembro->status = 'A';
			$miembro->save();

			return redirect('home')->with('global', 'El pago se ha registrado!');
		}

		return redirect('home')->with('global', 'Hubo un problema con el pago!');

	}
}
