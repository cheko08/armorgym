@extends('layouts.app')
@section('title', 'Agregar Producto')
@section('content')
@include('messages.global')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Agregar Producto</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="post" action="{{url('productos/store')}}">
						{!! csrf_field() !!}

						<input type="hidden" name="codigo" value="{{$producto}}">

						<div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Descripcion</label>

							<div class="col-md-6">
								<input type="text" class="form-control" autofocus name="descripcion" value="{{ old('descripcion') }}">

								@if ($errors->has('descripcion'))
								<span class="help-block">
									<strong>{{ $errors->first('descripcion') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('precio') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Precio</label>

							<div class="col-md-6">
								<input type="number" step=".5" class="form-control" name="precio" value="{{ old('precio') }}">

								@if ($errors->has('precio'))
								<span class="help-block">
									<strong>{{ $errors->first('precio') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('costo') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Costo</label>

							<div class="col-md-6">
								<input type="number" step=".5" class="form-control" name="costo" value="{{ old('costo') }}">

								@if ($errors->has('costo'))
								<span class="help-block">
									<strong>{{ $errors->first('costo') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('cantidad') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Cantidad</label>

							<div class="col-md-6">
								<input type="number" class="form-control" name="cantidad" value="{{ old('cantidad') }}">

								@if ($errors->has('cantidad'))
								<span class="help-block">
									<strong>{{ $errors->first('cantidad') }}</strong>
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
									<i class="fa fa-btn fa-coffee" id="button"></i><span id="text">Registrar Producto</span>
								</button>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>


@endsection