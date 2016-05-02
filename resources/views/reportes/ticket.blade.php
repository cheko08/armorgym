@extends('layouts.app')
@section('title', 'Ticket')
@section('content')
@include('messages.global')

<div class="container">
	<div class="row">
		<div id="print">
		<h2 class="ticket-title">Armor Gym - Ticket de Venta</h2>
		<div class="header">
			<p>Tel. 9-20-01-49</p>
			<p>Dir. Calle 36 x 11 y 113 Fco. Villa Poniente</p>
			<?php

				$originalDate = $ticket->created_at;
				$formatDate = date("d/m/Y - h:i A", strtotime($originalDate));
				?>
		<p>{{$formatDate}}</p>
		</div>
		
			<table class="table borderless">
				<thead>
					<tr>
						<th>Descripcion</th>
						<th>CTD</th>
						<th>Precio</th>

					</tr>
				</thead>
				<tbody>
					@foreach($detalleVentas  as $venta)
					<tr>
						<td>{{$venta->concepto}}</td>
						<td>{{$venta->cantidad}}</td>
						<td align="right">{{$venta->precio}}</td>
						
					</tr>
					@endforeach

					<tr>
						<td></td>
						<td></td>
						<td align="right"><strong>Subtotal: {{$total}}</strong></td>
					</tr>

					<tr>
						<td></td>
						<td></td>
						<td align="right"><strong>Total: {{$total}}</strong></td>
					</tr>

					<tr>
						<td></td>
						<td>Efectivo</td>
						<td align="right"><strong>{{$ticket->pagado}}</strong></td>
					</tr>

					<tr>
						<td></td>
						<td>Cambio:</td>
						<td align="right"><strong>{{abs($ticket->cambio)}}</strong></td>
					</tr>

					
				</tbody>
			</table>
			<p align="center">Gracias por su compra</p>
		</div>
		<a href="{{url('reportes/detalle')}}" class="btn btn-lg btn-success"><i class="fa fa-btn fa-reply"></i>Regresar</a>
	</div>
</div>
@endsection
