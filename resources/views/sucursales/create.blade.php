@extends('layouts.app')
@section('title', 'Sucursales')
@section('content')
@include('messages.global')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Crear Sucursal</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('sucursales/store') }}">
						{!! csrf_field() !!}

						<div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Nombre</label>

							<div class="col-md-6">
								<input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}">

								@if ($errors->has('nombre'))
								<span class="help-block">
									<strong>{{ $errors->first('nombre') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Direccion</label>

							<div class="col-md-6">
								<input type="text" class="form-control" name="direccion" value="{{ old('direccion') }}">

								@if ($errors->has('direccion'))
								<span class="help-block">
									<strong>{{ $errors->first('direccion') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Teléfono</label>

							<div class="col-md-6">
								<input type="number" class="form-control" name="telefono" value="{{ old('telefono') }}">

								@if ($errors->has('telefono'))
								<span class="help-block">
									<strong>{{ $errors->first('telefono') }}</strong>
								</span>
								@endif
							</div>
						</div>


						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary" id="save">
									<i class="fa fa-btn fa-save" id="button"></i><span id="text">Guardar</span>
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