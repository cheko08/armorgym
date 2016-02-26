@extends('layouts.app')
@section('title', 'Miembros')
@section('content')
@include('messages.global')
<div class="container">
	<div class="row">
		<div class="col-md-2 edit-miembro">
			<img src="{{url('fotos/'.$miembro->foto)}}" alt="Foto" class="img-thumbnail foto-perfil">

			
			<div class="camcontent">
				<video id="video" autoplay width="250" height="250"></video>
				<canvas id="canvas" width="250" height="250"></canvas>
			</div>

			<div class="cambuttons">
				<div class="row">
					<div class="col-xs-6">
						<button id="snap" class="btn" style="display:none;"><i class="fa fa-btn fa-camera"></i>Tomar Foto</button> 
						<button id="upload" class="btn" style="display:none;"><i class="fa fa-btn fa-save"></i>Guardar</button> 
					</div>
					<div class="col-xs-6">
						<button id="reset" class="btn" style="display:none;"><i class="fa fa-btn fa-reply"></i>Reset</button>    
					</div>
				</div>
				
				<span id=uploading style="display:none;"><i class="fa fa-spinner fa-spin"></i>Guardando Foto . . .  </span> 

			</div>



			<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" > 

		</div>

		<div class="col-md-10 edit-miembro">
			<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('miembros/update/'.$miembro->id) }}">
				{!! csrf_field() !!}

				<div class="form-group">
					<label class="col-md-4 control-label">ID</label>

					<div class="col-md-6">
						<input type="text" class="form-control" disabled="disabled" name="id" value="{{ $miembro->id }}">

					</div>
				</div>


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
				
				<div class="form-group">

					<label class="col-md-4 control-label">Fecha de Inscripción</label>
					<?php 
					$originalDatePago = $miembro->fecha_inscripcion;
					$formatInscripcion = date("d/m/Y", strtotime($originalDatePago));


					$originalDatePago = $miembro->fecha_proximo_pago;
					$formatPago = date("d/m/Y", strtotime($originalDatePago));

					?>

					<div class="col-md-6">
						<input type="text" id="datepicker" class="form-control" name="fecha_inscripcion" value="{{ $miembro->fecha_inscripcion }}">

					</div>
				</div>

				<div class="form-group">

					<label class="col-md-4 control-label">Próxima Fecha de Pago</label>

					<div class="col-md-6">
						<input type="text" class="form-control" name="fecha_proximo_pago" disabled="disabled" value="{{ $miembro->fecha_proximo_pago }}">

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
							<i class="fa fa-btn fa-edit" id="button"></i><span id="text">Actualizar Miembro</span>
						</button>
						<a href="#" id="eliminar_miembro" class="btn btn-menu btn-danger" role="button">
							<i class="fa fa-btn fa-trash"></i>Eliminar Miembro
						</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@section('scripts')

<script>
	$('#eliminar_miembro').click(function () {
		var token = $('#token').val();
		swal({
			title: "¿Desea borrar este miembro?",   
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
					url: '{!! url("miembros/destroy/".$miembro->id) !!}',
					headers: {'X-CSRF-TOKEN': token},
					type: 'post'
				}).then(function () {

					window.location.replace('{!! url("home") !!}');
				});
			} 

		});

	});
</script>
<script>
	$( "#datepicker" ).datepicker();
</script>

<script>
        // Put event listeners into place
        window.addEventListener("DOMContentLoaded", function() {
            // Grab elements, create settings, etc.
            var canvas = document.getElementById("canvas"),
            context = canvas.getContext("2d"),
            video = document.getElementById("video"),
            videoObj = { "video": true },
            image_format= "jpeg",
            jpeg_quality= 85,
            errBack = function(error) {
            	console.log("Video capture error: ", error.code); 
            };


            // Put video listeners into place
            if(navigator.getUserMedia) { // Standard
            	navigator.getUserMedia(videoObj, function(stream) {
            		video.src = stream;
            		video.play();
            		$("#snap").show();
            	}, errBack);
            } else if(navigator.webkitGetUserMedia) { // WebKit-prefixed
            	navigator.webkitGetUserMedia(videoObj, function(stream){
            		video.src = window.webkitURL.createObjectURL(stream);
            		video.play();
            		$("#snap").show();
            	}, errBack);
            } else if(navigator.mozGetUserMedia) { // moz-prefixed
            	navigator.mozGetUserMedia(videoObj, function(stream){
            		video.src = window.URL.createObjectURL(stream);
            		video.play();
            		$("#snap").show();
            	}, errBack);
            }
                  // video.play();       these 2 lines must be repeated above 3 times
                  // $("#snap").show();  rather than here once, to keep "capture" hidden
                  //                     until after the webcam has been activated.  

            // Get-Save Snapshot - image 
            document.getElementById("snap").addEventListener("click", function() {
            	context.drawImage(video, 0, 0, 250, 250);
                // the fade only works on firefox?
                $("#video").fadeOut("slow");
                $("#canvas").fadeIn("slow");
                $("#snap").hide();
                $("#reset").show();
                $("#upload").show();
            });
            // reset - clear - to Capture New Photo
            document.getElementById("reset").addEventListener("click", function() {
            	$("#video").fadeIn("slow");
            	$("#canvas").fadeOut("slow");
            	$("#snap").show();
            	$("#reset").hide();
            	$("#upload").hide();
            });
            // Upload image to sever 
            document.getElementById("upload").addEventListener("click", function(){
            	var dataUrl = canvas.toDataURL("image/jpeg", 0.85);
            	$("#uploading").show();
            	$.ajax({
            		url: '{!! url("miembros/updateFoto/".$miembro->id) !!}',
            		type: 'post',
            		data: { 
            			foto: dataUrl,

            		}
            	}).done(function(msg) {
            		console.log("saved");
            		$("#uploading").hide();
            		window.location.replace('{!! url("miembros/edit/".$miembro->id) !!}');
            	});
            });
        }, false);

</script>

@endsection
@endsection