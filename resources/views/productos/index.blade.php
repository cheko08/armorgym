@extends('layouts.app')
@section('title', 'Productos')
@section('content')
@include('messages.global')

<div class="container">
	<div class="row">
		<table class="table">
			<thead>
				<th>Codigo</th>
				<th>Descripcion</th>
				<th>Cantidad</th>
				<th>Precio</th>
				<th>Costo</th>
				<th>Sucursal</th>
			</thead>
			<tbody>
				@foreach($productos as $producto)
				<tr>
					<td>{{$producto->codigo}}</td>
					<td>{{$producto->descripcion}}</td>
					<td>{{$producto->cantidad}}</td>
					<td>{{$producto->precio}}</td>
					<td>{{$producto->costo}}</td>
					<td>{{$producto->sucursal->nombre}}</td>
				</tr>


				@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection