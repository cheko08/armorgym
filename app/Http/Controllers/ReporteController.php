<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Asistencia;
use App\Pago;

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

	public function generar(Request $request)
	{
		$fecha_inicio = date('Y-m-d', strtotime($request->input('fecha_inicio')));
		$fecha_termino = date('Y-m-d', strtotime($request->input('fecha_termino')));
		$reporte = $request->input('reporte');

		if($reporte === 'pagos'){
			$pagos = Pago::where('fecha_pago','>=',$fecha_inicio)->where('fecha_pago','<=',$fecha_termino)->get();

		     return view('reportes.reporte-pagos', compact('pagos'));

		}elseif($reporte === 'asistencia'){

			$asistencias = Asistencia::where('fecha_asistencia','>=',$fecha_inicio)->where('fecha_asistencia','<=',$fecha_termino)->get();

		     return view('reportes.reporte-asistencias', compact('asistencias'));

		}else{
			return "no hay reporte seleccionado";
		}


	}
}
