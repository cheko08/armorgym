<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Asistencia;
use App\Pago;
use App\Caja;
use App\Ticket;
use App\DetalleVentas;
use Auth;
use App\Reporte_Gym;
use App\Reporte_Venta;

class ReporteController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		return view('reportes.index');
	}

	public function detalleVentas()
	{
		$caja = Caja::where('user_id', Auth::user()->id )->where('status','abierta')->first();
		$tickets = Ticket::where('caja_id',$caja->id)->get();
		$monto_inicial = $caja->monto_inicial;

		return view('reportes.detalles', compact('tickets','monto_inicial','caja'));
	}

	public function ticket($id)
	{
		$ticket = Ticket::findOrFail($id);
		$detalleVentas = DetalleVentas::where('ticket_id','=',$id)->get();
		$total = 0;

		foreach($detalleVentas as $ventas)
		{
			$total += $ventas->precio;
		}
		return view('reportes.ticket', compact('ticket', 'detalleVentas', 'total'));
	}

	public function generar(Request $request)
	{
		$fecha_inicio = date('Y-m-d', strtotime($request->input('fecha_inicio')));
		$fecha_termino = date('Y-m-d', strtotime($request->input('fecha_termino')));
		$reporte = $request->input('reporte');
		$id = $request->input('id');

		
		if($reporte === 'pagos')
		{
			if($id === '')
			{
				$pagos = Pago::where('fecha_pago','>=',$fecha_inicio)->where('fecha_pago','<=',$fecha_termino)->get();
				$total = Pago::where('fecha_pago','>=',$fecha_inicio)->where('fecha_pago','<=',$fecha_termino)->sum('cantidad');
			}
			else
			{
				$pagos = Pago::where('fecha_pago','>=',$fecha_inicio)->where('fecha_pago','<=',$fecha_termino)->where('miembro_id',$id)->get();
				$total = Pago::where('fecha_pago','>=',$fecha_inicio)->where('fecha_pago','<=',$fecha_termino)->where('miembro_id',$id)->sum('cantidad');
			}
			return view('reportes.reporte-pagos', compact('pagos','total'));

		}
		elseif($reporte === 'asistencia')
		{
			if($id === '')
			{
				$asistencias = Asistencia::where('fecha_asistencia','>=',$fecha_inicio)->where('fecha_asistencia','<=',$fecha_termino)->get();
			}
			else
			{
				$asistencias = Asistencia::where('fecha_asistencia','>=',$fecha_inicio)->where('fecha_asistencia','<=',$fecha_termino)->where('miembro_id',$id)->get();
			}
			return view('reportes.reporte-asistencias', compact('asistencias'));
		}
		elseif($reporte === 'ventas')
		{

			$ventas = Caja::where('fecha','>=',$fecha_inicio)->where('fecha','<=',$fecha_termino)->get();
			$total_ingresos = Caja::where('fecha','>=',$fecha_inicio)->where('fecha','<=',$fecha_termino)->sum('ingresos');
			$total_egresos = Caja::where('fecha','>=',$fecha_inicio)->where('fecha','<=',$fecha_termino)->sum('egresos');
			$inicial_total = Caja::where('fecha','>=',$fecha_inicio)->where('fecha','<=',$fecha_termino)->sum('monto_inicial');
			$ventas_total = $total_ingresos + $total_egresos;

			return view('reportes.reporte-ventas', compact('ventas','ventas_total','inicial_total'));
		}
		else
		{
			return "no hay reporte seleccionado";
		}


	}

	public function reporteCorte($id)
	{
		$reportes = Reporte_Gym::where('caja',$id)->get();
		$total_gym = Reporte_Gym::where('caja',$id)->sum('costo');
		$total_gym = number_format($total_gym);

		$productos = Reporte_Venta::where('caja',$id)->get();
		$total_producto = Reporte_Venta::where('caja',$id)->sum('total');
		$total_producto = number_format($total_producto);

		return view('reportes.reporte-gym',compact('reportes','total_gym','productos','total_producto'));
	}
}
