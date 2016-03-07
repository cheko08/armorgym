@extends('layouts.app')
@section('title', 'Punto de Venta')
@section('content')
@include('messages.global')
<div class="container">
	<div class="row">
		<div id="ticket">

			<form  id="scan">
				<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" > 
				<div class="form-group">
					<label for="Codigo">
						Código:
					</label>
					<input autofocus type="text" name="codigo" id="codigo" class="form-control" autocomplete="off">
				</div>
			</form>
			<div id="nota">
				<form method="post" action="{{url('ventas/cobrar')}}">
				<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" > 
					<table class="table table-striped">
						<thead>
							<th>Descripción</th>
							<th>Cantidad</th>
							<th>Precio</th>
						</thead>
						<tbody id="productos">
						</tbody>
					</table>
					<div class="form-group">
							
								<button type="submit" class="btn btn-lg btn-primary" id="cobrar">
									<i class="fa fa-btn fa-money" id="button"></i><span id="text">Cobrar</span>
								</button>
							
						</div>				
				</form>
			</div>
		</div>
	</div>
</div>

@section('scripts')
<script>
	$("#scan").submit(function(e){
		e.preventDefault();
		var codigo = $("#codigo").val();
		codigo = $(this).serialize()
		var token = $('#token').val();
		$.ajax({
			url: '{!! url("api/addProducto") !!}',
			type: "POST",
			headers: {'X-CSRF-TOKEN': token},
			data : codigo,
			success: function(result){
				$("#productos").append("<tr><td><input type='hidden' value='"+result[0].id+"' name='id[]'>"+result[0].descripcion+"</td><td>1</td><td>"+result[0].precio+"</td></tr>");
				$("#codigo").val("");
			}});

	});
	</script>
	@endsection
	@endsection