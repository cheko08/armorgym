<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CobrarRequest;
use App\Http\Requests\PagoRequest;
use App\Producto;
use App\Ticket;
use App\DetalleVentas;
use Auth;

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

	public function scan(Request $request)
	{
		$producto = Producto::where('codigo',$request->input('codigo'))->get();

		return $producto;
	}

	public function cobrar(CobrarRequest $request)
	{
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

		return redirect('ventas/pagar/'.$ticket->id);
	}

	public function pagar($id)
	{
		$ticket = Ticket::findOrFail($id);
		$detalleVentas = DetalleVentas::where('ticket_id','=',$id)->get();
		$total = 0;

		foreach($detalleVentas as $ventas)
		{
			$total += $ventas->producto->precio;
		}

		
		return view('ventas.pagar', compact('detalleVentas', 'total', 'ticket'));

	}

	public function registrarPago($id, PagoRequest $request)
	{
		if($request->input('pago') < $request->input('total') )
		{
			return back();
		}

		$cambio =$request->input('total') - $request->input('pago');

		$ticket = Ticket::findOrFail($id);
		$ticket->pagado = $request->input('pago');
		$ticket->cambio = $cambio;
		$ticket->status = 'Pagado';
		$ticket->save();

		$detalleVentas = DetalleVentas::where('ticket_id','=',$id)->get();
		foreach($detalleVentas as $ventas)
		{
			$producto = Producto::findOrFail($ventas->producto_id);

			$producto->cantidad = $producto->cantidad - 1;
			$producto->save();

		}

		return redirect('ventas/ticket/'.$ticket->id);
		
	}

	public function cancelar($id)
	{
		$detalleVentas = DetalleVentas::where('ticket_id', $id)->delete();
		$ticket = Ticket::where('id', $id)->delete();

		return redirect('ventas/punto-venta');
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
