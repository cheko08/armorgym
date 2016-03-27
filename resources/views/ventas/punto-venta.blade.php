@extends('layouts.app')
	@section('title', 'Punto de Venta')
	@section('content')
	@include('messages.global')
	<div class="container">
		<div class="row">
			<div id="ticket">

				<h1><i class="fa fa-cart-arrow-down"></i> Caja Registradora</h1>
				<a href="{{url('reportes/detalle')}}" class="btn btn-warning">Detalle Ventas</a>

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
						<table class="table">
							<thead class="table-bordered">
								<tr class="info">
									<th>Descripción</th>
									<th>Cantidad</th>
									<th>Precio</th>
								</tr>
							</thead>
							<tbody id="productos" class="productos">
							</tbody>
						</table>
						<div class="row">
							<div class="col-md-4">
								
							</div>
							<div class="col-md-4">
								<h1>Total</h1>
							</div>
							<div class="col-md-4">
								<div class="input-group">

									<div class="input-group-addon total">$</div>
									<input type="text" name="total" id="total" class="form-control total" readonly="readonly" autocomplete="off">

								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4">
								
							</div>
							<div class="col-md-4">
								<h1>Pago</h1>
							</div>
							<div class="col-md-4">
								<div class="input-group">

									<div class="input-group-addon total">$</div>
									<input type="number" name="pago" id="pago" class="form-control total" autocomplete="off">

								</div>

							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								
							</div>
							<div class="col-md-4">
								<h1>Cambio</h1>
							</div>
							<div class="col-md-4">
								<div class="input-group">

									<div class="input-group-addon total">$</div>
									<input type="number" name="cambio" id="cambio" class="form-control total" readonly autocomplete="off">

								</div>

							</div>
						</div>
						
						<div class="row">
							<div class="col-md-4"></div>
							<div class="col-md-4"></div>
							<div class="col-md-4">
								<div class="form-group">

									<button type="submit" class="btn btn-lg btn-primary" disabled id="cobrar">
										<i class="fa fa-btn fa-money" id="button"></i><span id="text">Cobrar</span>
									</button>

								</div>		
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
	
	@section('scripts')
	<script>
		var total = 0;
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
					$("#productos").append("<tr id='row'></td><td><input type='hidden' value='"+result[0].id+"' name='id[]'>"+result[0].descripcion+"</td><td>1</td><td>"+result[0].precio+"</td></tr>");
					$("#codigo").val("");
					total =parseFloat(result[0].precio) + parseFloat(total);
					$("#total").val(total);
				}});
		});

		$("#pago").keyup(function(){
			var cambio = $("#pago").val() - $("#total").val();
			$("#cambio").val(cambio);
			if (cambio >= 0){
				$( "#cobrar" ).prop( "disabled", false );
			}else{
				$( "#cobrar" ).prop( "disabled", true );
			}
		});

		
	</script>
	@endsection
	@endsection</div>