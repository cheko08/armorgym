<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Miembro;
use App\Pago;
use DateTime;
use Auth;
use App\Caja;
use App\Sucursal;
use App\Reporte_Gym;
use App\Ticket;
use App\DetalleVentas;

class PagoController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function pagar($id)
	{
		if(Caja::where('user_id', Auth::user()->id )->where('status','abierta')->count() > 0)
		{
			$miembro = Miembro::findOrFail($id);
			return view('pagos.pagar', compact('miembro'));
		}
		else
		{
			$sucursales = Sucursal::all();
			return view('ventas.abrir-caja', compact('sucursales'));
		}
		
	}

	public function realizarPago(Request $request, $id)
	{
		$miembro_id = $id;
		$concepto = $request->input('concepto');
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



			//Reportes
			$caja =Caja::where('user_id', Auth::user()->id )->where('status','abierta')->first();

			$ticket = Ticket::create([
				'pagado' => $cantidad,
				'status' => 'Pagado',
				'cambio' => 0,
				'caja_id' => $caja->id,
				'user_id' => $user_id
				]);

			$ventas = DetalleVentas::create([
				'concepto' => $concepto,
				'precio' => $cantidad,
				'cantidad' => 1,
				'ticket_id' => $ticket->id,
				'user_id' => Auth::user()->id ]);

			$caja->ingresos = $caja->ingresos + $request->input('pago');
			$caja->save();



			$reporte = Reporte_Gym::create([
				'miembro_id' => $miembro_id,
				'concepto'  => $concepto,
				'costo'    =>$cantidad,
				'caja' => $caja->id,
				'fecha' => $caja->fecha,
				'user_id' => $user_id,
				'sucursal_id' => $caja->sucursal_id
				]);


			return redirect('home')->with('global', 'El pago se ha registrado!');
		}

		return redirect('home')->with('global', 'Hubo un problema con el pago!');

	}
}
