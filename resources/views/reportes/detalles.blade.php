@extends('layouts.app')
@section('title', 'Reportes Ventas')
@section('content')
@include('messages.global')
<div class="container">
	<div class="row">
		<a href="{{url('reportes/reportes-corte/'.$caja->id)}}" class="btn btn-success">Imprimir Reportes</a>
		<a href="{{url('ventas/punto-venta')}}" class="btn btn-primary">Regresar</a>
		<a href="{{url('caja/cerrar')}}" class="btn btn-danger">Cerrar Caja</a>
		<table class="table">
			<thead>
				<th>Ticket ID</th>
				<th>Fecha</th>
				<th>Pagado</th>
				<th>Cambio</th>
				<th>Total</th>
			</thead>
			<tbody>
			<tr class="warning">
				<td>Monto Inicial</td>
				<td></td>
				<td>{{$monto_inicial}}</td>
				<td>0</td>
				<td>{{$monto_inicial}}</td>
			</tr>
			<?php $total = 0; ?>

				@foreach($tickets as $ticket)
				<?php

				$originalDate = $ticket->created_at;
				$formatDate = date("d/m/Y - h:i A", strtotime($originalDate));
				$subtotal = $ticket->pagado + $ticket->cambio;
				$total += $subtotal;

				?>
				<tr>
					<td><a href="{{url('reportes/ticket/'.$ticket->id)}}">{{$ticket->id}}</a></td>
					<td>{{$formatDate}}</td>
					<td>{{$ticket->pagado}}</td>
					<td>{{$ticket->cambio}}</td>
					<td>{{$subtotal}}</td>
				</tr>

				@endforeach	
				<tr>
					<td></td>
					<td><strong></strong></td>
					<td><strong></strong> </td>
					<td><strong>Total:</strong></td>
					<td><strong>{{$total + $monto_inicial}}</strong></td>
				</tr>	
			</tbody>
		</table>
		
	</div>
</div>


@endsection