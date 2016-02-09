@extends('layouts.app')
@section('title', 'Miembros')
@section('content')

<div class="alert alert-{{$color}} alert-dismissible" role="alert">
	<h1><strong> Acceso {{$acceso}} </strong></h1>	
</div>    
<?php
$originalDateInscripcion = $miembro->fecha_inscripcion;
$formatInscripcion = date("d-m-Y", strtotime($originalDateInscripcion));

$originalDatePago = $miembro->fecha_proximo_pago;
$formatPago = date("d-m-Y", strtotime($originalDatePago));

?>
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<img src="{{url('fotos/'.$miembro->foto)}}" alt="Foto" class="img-thumbnail foto-perfil">
		</div>
		<div class="col-md-8 perfil">
		    <p><label for="Nombre">ID:</label> {{$miembro->id}}</p>
			<p><label for="Nombre">Nombre:</label> {{$miembro->nombre}} {{$miembro->apellidos}}</p>
			<p><label for="Plan">Membresía:</label> {{$miembro->membresia->nombre}}</p>
			<p><label for="Precio">Pago Mensual:</label> ${{$miembro->membresia->precio_mensual}}</p>
			<p><label for="Plan">Fecha de Inscripción:</label> {{$formatInscripcion}}</p>
			<p><label for="Plan">Próximo Pago:</label> {{$formatPago}}</p>
			<p><a href="{{url('miembros/acceso')}}" class="btn btn-lg btn-menu btn-primary" role="button">
							<i class="fa fa-btn fa-reply"></i>Regresar
						</a></p>
		</div>
	</div>
</div>

@endsection