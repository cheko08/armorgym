@extends('layouts.app')
@section('title', 'Miembros')
@section('content')
@include('messages.global')
<div class="container">
	<div class="row">
		<div class="col-md-2 edit-miembro">
			<img src="{{url('fotos/'.$miembro->foto)}}" alt="Foto" class="img-thumbnail foto-perfil">
		</div>

		<div class="col-md-10 edit-miembro">
			<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('miembros/update/'.$miembro->id) }}">
						{!! csrf_field() !!}

						<div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Nombre</label>

							<div class="col-md-6">
								<input type="text" class="form-control" name="nombre" value="{{ $miembro->nombre }}">

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
								<input type="text" class="form-control" name="apellidos" value="{{ $miembro->apellidos }}">

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
								<input type="email" class="form-control" name="email" value="{{ $miembro->email }}">

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
								<input type="number" class="form-control" name="telefono" value="{{ $miembro->telefono }}">

								@if ($errors->has('telefono'))
								<span class="help-block">
									<strong>{{ $errors->first('telefono') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('sucursal') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Sucursal</label>

							<div class="col-md-6">
								<select class="form-control" name="sucursal">
								<option value="{{ $miembro->sucursal->id }}" selected="selected">{{ $miembro->sucursal->nombre }}</option>
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
								<option value="{{ $miembro->membresia->id }}" selected="selected">{{ $miembro->membresia->nombre }} - ${{ $miembro->membresia->precio_mensual }}</option>
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
								<textarea name="comentarios" class="form-control">{{ $miembro->comentarios }}</textarea>
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
								<button type="submit" class="btn btn-primary" id="update">
									<i class="fa fa-btn fa-edit" id="button"></i>Actualizar Miembro
								</button>
							</div>
						</div>
					</form>
		</div>
	</div>
</div>

@endsection