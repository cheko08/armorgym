@extends('layouts.app')
@section('title', 'Ticket')
@section('content')
@include('messages.global')

<div class="container">
	<div class="row">
		<form action="{{url('ventas/pagar/'.$ticket->id)}}" method="post">
			<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" > 
			<table class="table table-condensed borderless">
				<thead>
					<th>Descripcion</th>
					<th>CTD</th>
					<th>Precio</th>
					<th></th>
				</thead>
				<tbody>
					@foreach($detalleVentas  as $venta)
					<tr>
						<td>{{$venta->producto->descripcion}}</td>
						<td>{{$venta->cantidad}}</td>
						<td>{{$venta->producto->precio}}</td>
						<td></td>
					</tr>
					@endforeach
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td class="precio">Total: ${{$total}}</td>
					</tr>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<input type="number" class="form-control pago" name="pago" placeholder="0.00">
						<input type="hidden" name="total" value="{{$total}}">
					</td>
					<tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td><button type="submit" class="btn btn-lg btn-success">Pagar</button>
								<a href="{{url('ventas/cancelar/'.$ticket->id)}}" class="btn btn-lg btn-danger">Cancelar</a> 
							</td>
						</tr>

					</tr>
				</tbody>
			</table>
		</form>
	</div>
</div>

@endsection