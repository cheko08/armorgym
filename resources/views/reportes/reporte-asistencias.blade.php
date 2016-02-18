@extends('layouts.app')
@section('title', 'Reportes Asistencias')
@section('content')
@include('messages.global')

<div class="container">
	<table class="table table-hover table-users">
		<thead>
			<th>Miembro</th>
			<th>Fecha de Asistencia</th>
			
		</thead>
		<tbody>
			@foreach($asistencias as $asistencia)
			<?php

			$originalDateasistencia = $asistencia->fecha_asistencia;
			$formatasistencia = date("d/m/Y", strtotime($originalDateasistencia));

			?>
			<tr>
				<td>{{$asistencia->miembro->nombre}} {{$asistencia->miembro->apellidos}}</td>
				<td>{{$formatasistencia}}</td>
				
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

@endsection