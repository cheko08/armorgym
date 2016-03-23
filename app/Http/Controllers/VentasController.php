<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CobrarRequest;
use App\Http\Requests\PagoRequest;
use App\Producto;
use App\Sucursal;
use App\Ticket;
use App\DetalleVentas;
use Auth;
use App\Caja;

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
		$caja = Caja::create([
			'user_id' =>  Auth::user()->id,
			'sucursal_id' => $request->input('sucursal'),
			'monto_inicial' => $request->input('monto_inicial'),
			'status' =>  'abierta'
			]);
		if($caja)
		{
			return redirect('ventas/punto-venta');
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
			$venta = DetalleVentas::create([
				'producto_id' => $producto->id,
				'cantidad' => 1,
				'ticket_id' => $ticket->id,
				'user_id' => Auth::user()->id ]);
		}

		$cambio =$request->input('total') - $request->input('pago');

		$ticket = Ticket::findOrFail($ticket->id);
		$ticket->pagado = $request->input('pago');
		$ticket->cambio = $cambio;
		$ticket->status = 'Pagado';
		$ticket->save();

		$caja->ingresos = $caja->ingresos + $request->input('pago');
		$caja->egresos = $caja->egresos + $cambio;
		$caja->save();

		$detalleVentas = DetalleVentas::where('ticket_id','=',$ticket->id)->get();
		foreach($detalleVentas as $ventas)
		{
			$producto = Producto::where('id',$ventas->producto_id)->where('sucursal_id', $caja->sucursal_id)->first();

			$producto->cantidad = $producto->cantidad - 1;
			$producto->save();

		}

		return redirect('ventas/ticket/'.$ticket->id);

		
	}

	


	public function ticket($id)
	{
		$ticket = Ticket::findOrFail($id);
		$detalleVentas = DetalleVentas::where('ticket_id','=',$id)->get();
		$total = 0;

		foreach($detalleVentas as $ventas)
		{
			$total += $ventas->producto->precio;
		}
		return view('ventas.ticket', compact('ticket', 'detalleVentas', 'total'));
	}

}
