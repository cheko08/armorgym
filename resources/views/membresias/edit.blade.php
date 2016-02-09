@extends('layouts.app')
@section('title', 'Membresias')
@section('content')
@include('messages.global')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Actualizar Membresía</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('membresias/update/'.$membresia->id) }}">
						{!! csrf_field() !!}

						<div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Nombre</label>

							<div class="col-md-6">
								<input type="text" class="form-control" name="nombre" value="{{ $membresia->nombre }}">

								@if ($errors->has('nombre'))
								<span class="help-block">
									<strong>{{ $errors->first('nombre') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('precio_mensual') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Precio Mensual</label>

							<div class="col-md-6">
								<input type="number" class="form-control" name="precio_mensual" value="{{ $membresia->precio_mensual }}">

								@if ($errors->has('precio_mensual'))
								<span class="help-block">
									<strong>{{ $errors->first('precio_mensual') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('inscripcion') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Inscripción</label>

							<div class="col-md-6">
								<input type="number" class="form-control" name="inscripcion" value="{{$membresia->inscripcion }}">

								@if ($errors->has('inscripcion'))
								<span class="help-block">
									<strong>{{ $errors->first('inscripcion') }}</strong>
								</span>
								@endif
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label">Descripción</label>

							<div class="col-md-6">
								<textarea name="descripcion" class="form-control">{{$membresia->descripcion}}</textarea>
							</div>
						</div>


						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary" id="save">
									<i class="fa fa-btn fa-save" id="button"></i><span id="text">Guardar</span>
								</button>
								<a href="#" id="eliminar_membresia" class="btn btn-menu btn-danger" role="button">
									<i class="fa fa-btn fa-trash"></i>Eliminar
								</a>
								<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" > 
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
	$('#eliminar_membresia').click(function () {
		var token = $('#token').val();
		swal({
			title: "¿Desea borrar esta Membresía?",   
			text: "Una vez borrado no habrá manera de recuperar su información",   
			type: "warning",   
			showCancelButton: true,   
			confirmButtonColor: "#DD6B55",   
			confirmButtonText: "Si, Estoy seguro!",   
			cancelButtonText: "Cancelar",   
			closeOnConfirm: false,   
			closeOnCancel: true 
		}, 
		function(isConfirm){   
			if (isConfirm) {     
				$.ajax({
					url: '{!! url("membresias/destroy/".$membresia->id) !!}',
					headers: {'X-CSRF-TOKEN': token},
					type: 'post'
					 }).then(function () {

					window.location.replace('{!! url("membresias") !!}');
				});
			} 

		});

	});
</script>
@endsection
@endsection