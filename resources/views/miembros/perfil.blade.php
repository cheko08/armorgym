@extends('layouts.app')
@section('title', 'Acceso')
@section('content')
<div class="alert alert-{{$color}} alert-dismissible" role="alert">
	<h1><strong> Acceso {{$acceso}} </strong></h1>
</div>
<?php
$originalDateInscripcion = $miembro->fecha_inscripcion;
$formatInscripcion = date("d/m/Y", strtotime($originalDateInscripcion));
$originalDatePago = $miembro->fecha_proximo_pago;
$formatPago = date("d/m/Y", strtotime($originalDatePago));
?>
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<img src="{{url('fotos/'.$miembro->foto)}}" alt="Foto" class="img-thumbnail foto-perfil">
			<p><a href="{{url('miembros/acceso')}}" class="btn btn-lg btn-menu btn-primary" role="button">
				<i class="fa fa-btn fa-reply"></i>Regresar
			</a></p>
		</div>
		<div class="col-md-8 perfil">
			<p><label for="Nombre">ID:</label> {{$miembro->id}}</p>
			<p><label for="Nombre">Nombre:</label> {{ucwords($miembro->nombre)}} {{ucwords($miembro->apellidos)}}</p>
			<p><label for="Plan">Membresía:</label> {{$miembro->membresia->nombre}}</p>
			<p><label for="Precio">Pago Mensual:</label> ${{$miembro->membresia->precio_mensual}}</p>
			<p><label for="fecha">Fecha de Inscripción:</label> {{$formatInscripcion}}</p>
			<p><label for="fecha">Próximo Pago:</label> {{$formatPago}}</p>
			<?php
			$today = date('Y-m-d');
			$datetime1 = new DateTime($today);
			$datetime2 = new DateTime($miembro->fecha_proximo_pago);
			$interval = $datetime1->diff($datetime2);
			$dias_para_pago = $interval->format('%r%a%');
			if($dias_para_pago > 7)
			{
				$class ='success';
				$dias_para_pago2 ='Faltan '.$dias_para_pago.' días para el próximo pago';
			}
			elseif($dias_para_pago <= 0)
			{
				$class = 'danger';
				$dias_para_pago2 ='';
			}
			else
			{
				$class = 'warning';
				$dias_para_pago2 ='Faltan '.$dias_para_pago.' días para el próximo pago';
			}
			?>
			<div class="alert alert-{{$class}}" role="alert"> {!!$dias_para_pago2!!}<br> <a href="{{url('miembros/pagar/'.$miembro->id)}}" class="btn btn-success" role="button"><i class="fa fa-btn fa-dollar"></i>Realizar Pago</a> </div>
			
		</div>
	</div>
</div>
@endsection