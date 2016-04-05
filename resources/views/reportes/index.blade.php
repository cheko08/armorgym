@extends('layouts.app')
@section('title', 'Reportes')
@section('content')
@include('messages.global')

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Reportes</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('reportes/generar') }}">
						{!! csrf_field() !!}

						<div class="form-group">
							<label class="col-md-4 control-label">ID Miembro</label>

							<div class="col-md-6">
								<input type="number" class="form-control"  name="id" value="">
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label">Fecha de Inicio</label>

							<div class="col-md-6">
								<input type="text" class="form-control" id="datepicker1" name="fecha_inicio" value="">
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label">Fecha de Término</label>

							<div class="col-md-6">
								<input type="text" class="form-control" id="datepicker2"  name="fecha_termino" value="">
							</div>
						</div>


						<div class="form-group">
							<label class="checkbox-inline col-md-4 control-label">
								<input type="radio" name="reporte" value="pagos" checked="checked"> Historial de Pagos
							</label>
							<label class="checkbox-inline">
								<input type="radio" name="reporte" value="asistencia"> Lista de Asistencia
							</label>
							<label class="checkbox-inline">
								<input type="radio" name="reporte" value="ventas"> Punto de Venta
							</label>

						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary" id="save">
									<i class="fa fa-btn fa-bar-chart" id="button"></i><span id="text">Generar Reporte</span>
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
	$( "#datepicker1" ).datepicker();
	$( "#datepicker2" ).datepicker();
</script>
@endsection

@endsection