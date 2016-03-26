@extends('layouts.app')
@section('title', 'Reportes Pagos')
@section('content')
@include('messages.global')

<div class="container">
	<table class="table table-hover table-users">
		<thead>
			<th>Miembro</th>
			<th>Fecha de Pago</th>
			<th>Cantidad</th>
			<th>Usuario</th>
		</thead>
		<tbody>
			@foreach($pagos as $pago)
			<?php

			$originalDatePago = $pago->fecha_pago;
			$formatPago = date("d/m/Y", strtotime($originalDatePago));

			?>
			<tr>
				<td>{{ucwords($pago->miembro->nombre)}} {{ucwords($pago->miembro->apellidos)}}</td>
				<td>{{$formatPago}}</td>
				<td>{{$pago->cantidad}}</td>
				<td>{{$pago->user->name}}</td>
			</tr>
			@endforeach
			<tr>
			<td></td>
			<td><strong>Total:</strong></td>
			<td><strong>{{$total}}</strong></td>
			<td></td>
			</tr>
		</tbody>
	</table>
</div>

@endsection