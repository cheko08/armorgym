@extends('layouts.app')
@section('title', 'Miembros')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Formulario de Registro</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('miembros/store') }}">
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

						<div class="form-group{{ $errors->has('apellidos') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Apellidos</label>

							<div class="col-md-6">
								<input type="text" class="form-control" name="apellidos" value="{{ old('apellidos') }}">

								@if ($errors->has('apellidos'))
								<span class="help-block">
									<strong>{{ $errors->first('apellidos') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">E-Mail</label>

							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">

								@if ($errors->has('email'))
								<span class="help-block">
									<strong>{{ $errors->first('email') }}</strong>
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

						<div class="form-group{{ $errors->has('fecha_inscripcion') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Fecha de Inscripción</label>

							<div class="col-md-6">
								<input type="text" class="form-control" id="datepicker" name="fecha_inscripcion" value="{{ old('fecha_inscripcion') }}">

								@if ($errors->has('fecha_inscripcion'))
								<span class="help-block">
									<strong>{{ $errors->first('fecha_inscripcion') }}</strong>
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

						<div class="form-group{{ $errors->has('membresia') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Membresía</label>

							<div class="col-md-6">
								<select class="form-control" name="membresia">
									@foreach($membresias as $membresia)
									<option value="{{ $membresia->id }}">{{ $membresia->nombre }} - ${{ $membresia->precio_mensual }}</option>
									@endforeach
								</select>

								@if ($errors->has('membresia'))
								<span class="help-block">
									<strong>{{ $errors->first('membresia') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Notas</label>

							<div class="col-md-6">
								<textarea name="comentarios" class="form-control"></textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Foto</label>

							<div class="col-md-6">
								<input type="file" class="form-control" name="foto" accept="image/*;capture=camera">

							</div>
							
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary" id="register">
									<i class="fa fa-btn fa-user-plus" id="button"></i><span id="text">Registrar Miembro</span>
								</button>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>
@section('scripts')
<script>
$( "#datepicker" ).datepicker();
</script>
@endsection
@endsection
