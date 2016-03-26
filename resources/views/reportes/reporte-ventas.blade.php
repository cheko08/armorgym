@extends('layouts.app')
@section('title', 'Reportes Ventas')
@section('content')
@include('messages.global')

<div class="container">
	<table class="table table-hover table-users">
		<thead>
			<th>Usuario</th>
			<th>Sucursal</th>
			<th>Estatus</th>
			<th>Monto Inicial</th>
			<th>Ventas</th>
			<th>Total</th>
		</thead>
		<tbody>
			@foreach($ventas as $venta)
			<?php

			$originalDatePago = $venta->created_at;
			$formatventa = date("d/m/Y", strtotime($originalDatePago));

			?>
			<tr>
				<td>{{$venta->user->name}}</td>
				<td>{{$venta->sucursal->nombre}}</td>
				<td>{{$venta->status}}</td>
				<td>{{$venta->monto_inicial}}</td>
				<td>{{$venta->ingresos + $venta->egresos}}</td>
				<td>{{$venta->monto_inicial + $venta->ingresos + $venta->egresos}}</td>
			</tr>
			@endforeach
			<tr>
			<td></td>
			<td></td>
			<td><strong>Totales:</strong></td>
			<td><strong>{{$inicial_total}}</strong></td>
			<td><strong>{{$ventas_total}}</strong></td>
			<td><strong>{{$inicial_total + $ventas_total}}</strong></td>
			</tr>
		</tbody>
	</table>
</div>

@endsection