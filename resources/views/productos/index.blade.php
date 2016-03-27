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
				<th>Precio</th>
				<th>Costo</th>
				<th></th>
			</thead>
			<tbody>
				@foreach($productos as $producto)
				<tr>
					<td>{{$producto->codigo}}</td>
					<td>{{$producto->descripcion}}</td>
					<td>{{$producto->precio}}</td>
					<td>{{$producto->costo}}</td>
					<td><a href="{{url('productos/edit/'.$producto->id)}}"><i class="fa fa-btn fa-edit"></i></a></td>
				</tr>


				@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection