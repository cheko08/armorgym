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
				<td>{{$pago->miembro->nombre}} {{$pago->miembro->apellidos}}</td>
				<td>{{$formatPago}}</td>
				<td>{{$pago->cantidad}}</td>
				<td>{{$pago->user->name}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

@endsection