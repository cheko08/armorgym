@extends('layouts.app')
@section('title', 'Punto de Venta')
@section('content')
@include('messages.global')
<div class="container">
	<div class="row">
		<div class="caja">
			<h1>Abrir Caja</h1>
			<p>Ingrese el monto incial y la sucursal</p>
			<form class="form-horizontal" role="form" method="post" action="{{url('caja/abrir')}}">
				{!! csrf_field() !!}
				
				<div class="form-group{{ $errors->has('monto_inicial') ? ' has-error' : '' }}">
					<label class="col-md-4 control-label">Monto Inicial</label>
					<div class="col-md-6">
						<input type="number" step=".5" class="form-control" placeholder="MXN" name="monto_inicial" value="{{ old('monto_inicial') }}">
						@if ($errors->has('monto_inicial'))
						<span class="help-block">
							<strong>{{ $errors->first('monto_inicial') }}</strong>
						</span>
						@endif
					</div>
				</div>
				
				<div class="form-group{{ $errors->has('sucursal') ? ' has-error' : '' }}">
					<label class="col-md-4 control-label">Sucursal</label>
					<div class="col-md-6">
						<select class="form-control" name="sucursal">
							@foreach($sucursales as $sucursal)
							<option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
							@endforeach
						</select>
						@if ($errors->has('sucursal'))
						<span class="help-block">
							<strong>{{ $errors->first('sucursal') }}</strong>
						</span>
						@endif
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-md-6 col-md-offset-4">
						<button type="submit" class="btn btn-primary" id="register">
						<i class="fa fa-btn fa-cash" id="button"></i>Abrir Caja
						</button>
					</div>
				</div>
			</form>
			
		</div>
	</div>
</div>
@endsection