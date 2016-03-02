@extends('layouts.app')
@section('title', 'Agregar Producto')
@section('content')
@include('messages.global')
<div class="container">
	<div class="scan-container">
		<form action="{{url('productos/store-codigo')}}" method="post">
			   {!! csrf_field() !!}
			<div class="form-group{{ $errors->has('codigo') ? ' has-error' : '' }}">

				<input type="text" name="codigo" class="form-control" placeholder="Escanea" value="{{ old('codigo') }}" autofocus autocomplete="off">
				<i class="fa barcode fa-barcode"></i>
				@if ($errors->has('codigo'))
				<span class="help-block">
					<strong>{{ $errors->first('codigo') }}</strong>
				</span>
				@endif
			</div>
		</form>

	</div>	
</div>


@endsection