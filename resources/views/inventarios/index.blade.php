@extends('layouts.app')
@section('title', 'Inventarios')
@section('content')
@include('messages.global')

<div class="container">
	<div class="row">
		<table class="table">
			<thead>
				<tr>
					<th>Sucursal</th>
					<th>Producto</th>
					<th>Cantidad</th>
				</tr>
			</thead>
			<tbody>
				@foreach($inventarios as $inventario)
				<tr>
					<td>{{$inventario->sucursal->nombre}}</td>
					<td>{{$inventario->producto->descripcion}}</td>
					<td>{{$inventario->cantidad}}</td>
				</tr>

				@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection