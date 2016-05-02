<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CobrarRequest;
use App\Http\Requests\PagoRequest;
use App\Http\Requests\SalidasRequest;
use App\Producto;
use App\Sucursal;
use App\Ticket;
use App\DetalleVentas;
use Auth;
use App\Caja;
use App\Inventario;
use App\Reporte_Venta;

class VentasController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function puntoVenta()
	{
		if(Caja::where('user_id', Auth::user()->id )->where('status','abierta')->count() > 0)
		{
			return view('ventas.punto-venta');
		}
		$sucursales = Sucursal::all();
		return view('ventas.abrir-caja', compact('sucursales'));
	}

	public function abrirCaja(Request $request)
	{
		$today =Date('Y-m-d');
		$caja = Caja::create([
			'user_id' =>  Auth::user()->id,
			'sucursal_id' => $request->input('sucursal'),
			'monto_inicial' => $request->input('monto_inicial'),
			'fecha' => $today,
			'status' =>  'abierta'
			]);
		if($caja)
		{
			return back();
		}
		
	}

	public function cerrarCaja()
	{
		$caja = Caja::where('user_id', Auth::user()->id )->where('status','abierta')->first();
		$caja->status = 'cerrada';
		$caja->save();
		return redirect('ventas/punto-venta');
	}

	public function scan(Request $request)
	{
		$producto = Producto::where('codigo',$request->input('codigo'))->get();

		return $producto;
	}



	public function cobrar(CobrarRequest $request)
	{
		if($request->input('pago') < $request->input('total') )
		{
			return back();
		}

		$caja =Caja::where('user_id', Auth::user()->id )->where('status','abierta')->first();

		$ticket = Ticket::create();	
		foreach($request->input('id') as $producto)
		{
			$producto = Producto::findOrFail($producto);
			if(Inventario::where('producto_id',$producto->id)->where('sucursal_id', $caja->sucursal_id)->count() > 0)
			{
				$inventario = Inventario::where('producto_id',$producto->id)->where('sucursal_id', $caja->sucursal_id)->first();
				$inventario->cantidad = $inventario->cantidad - 1;
				$inventario->save();

			}

			if(Reporte_Venta::where('caja',$caja->id)->where('producto_id',$producto->id)->count() > 0)
			{
				$producto_reporte = Reporte_Venta::where('caja',$caja->id)->where('producto_id',$producto->id)->first();
				$producto_reporte->cantidad = $producto_reporte->cantidad + 1;
				$producto_reporte->total = $producto_reporte->total + $producto->precio;
				$producto_reporte->save();
			}
			else
			{
				$producto_reporte = Reporte_Venta::create([
					'caja' => $caja->id,
					'producto_id' => $producto->id,
					'cantidad' => 1,
					'total' => $producto->precio]);

			}


			$venta = DetalleVentas::create([
				'concepto' => $producto->descripcion,
				'precio' => $producto->precio,
				'cantidad' => 1,
				'ticket_id' => $ticket->id,
				'user_id' => Auth::user()->id ]);
		}

		$cambio =$request->input('total') - $request->input('pago');

		$ticket = Ticket::findOrFail($ticket->id);
		$ticket->pagado = $request->input('pago');
		$ticket->cambio = $cambio;
		$ticket->caja_id = $caja->id;
		$ticket->user_id = Auth::user()->id;
		$ticket->status = 'Pagado';
		$ticket->save();

		$caja->ingresos = $caja->ingresos + $request->input('pago');
		$caja->egresos = $caja->egresos + $cambio;
		$caja->save();

		$detalleVentas = DetalleVentas::where('ticket_id','=',$ticket->id)->get();

		return redirect('ventas/ticket/'.$ticket->id);

		
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
		return view('ventas.ticket', compact('ticket', 'detalleVentas', 'total'));
	}


	public function getSalidas()
	{
		return view('ventas.salidas');
	}

	public function postSalidas(SalidasRequest $request)
	{
		$caja =Caja::where('user_id', Auth::user()->id )->where('status','abierta')->first();
		$ticket = Ticket::create();

		$salida = DetalleVentas::create([
				'concepto' => $request->input('concepto'),
				'precio' => -$request->input('cantidad'),
				'cantidad' => 1,
				'ticket_id' => $ticket->id,
				'user_id' => Auth::user()->id ]);

		$ticket->pagado = -$request->input('cantidad');
		$ticket->cambio = 0;
		$ticket->caja_id = $caja->id;
		$ticket->user_id = Auth::user()->id;
		$ticket->status = 'Salida de Efectivo';
		$ticket->save();	
		return redirect('ventas/punto-venta');
	}

}
