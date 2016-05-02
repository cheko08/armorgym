@extends('layouts.app')
@section('title', 'Reporte')
@section('content')
@include('messages.global')

<div class="container">
	<div class="row">
		<a href="{{url('ventas/punto-venta')}}" class="btn btn-primary">Regresar</a>
	</div>

	<div id="print">
		<div class="row">
			<div style="float:left"><strong>Fecha: </strong>{{date('d/m/Y')}}</div>
			<div style="margin-left:400px" ><strong>Usuario: </strong>{{Auth::user()->name}}</div>
		</div>
		<div class="row">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombre Completo</th>
						<th>Concepto</th>
						<th>Costo</th>
					</tr>
				</thead>
				<tbody>
					@foreach($reportes as $reporte)
					<tr>
						<td>{{$reporte->miembro_id}}</td>
						<td>{{ucwords($reporte->miembro->nombre).' '.ucwords($reporte->miembro->apellidos)}}</td>
						<td>{{$reporte->concepto}}</td>
						<td>{{$reporte->costo}}</td>
					</tr>
					@endforeach
					<tr class="warning">
						<td></td>
						<td></td>
						<td></td>
						<td><strong>${{$total_gym}}</strong></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="row">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Producto</th>
						<th>Cantidad</th>
						<th>Venta Total</th>
					</tr>
				</thead>
				<tbody>
					@foreach($productos as $producto)
					<tr>
						<td>{{$producto->producto->descripcion}}</td>
						<td>{{$producto->cantidad}}</td>
						<td>{{$producto->total}}</td>
					</tr>
					@endforeach
					<tr class="warning">
						
						<td></td>
						<td></td>
						<td><strong>${{$total_producto}}</strong></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="row" style="text-align:center">
			________________________________
			<br>
			<strong>{{Auth::user()->name}}</strong>
		</div>

	</div>
</div>
@section('scripts')
<script>
	$("document").ready(function() {
		window.print();
	});
</script>
@endsection
@endsection