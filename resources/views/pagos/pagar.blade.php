@extends('layouts.app')
@section('title', 'Pagos')
@section('content')
@include('messages.global')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Realizar Pago</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('pagos/pagar/'.$miembro->id) }}">
						{!! csrf_field() !!}


						<div class="form-group">
							<label class="col-md-4 control-label">ID</label>

							<div class="col-md-6">
								<input type="text" class="form-control" disabled="disabled" name="miembro_id" value="{{ $miembro->id }}">
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label">Nombre</label>

							<div class="col-md-6">
								<input type="text" class="form-control" disabled="disabled" name="nombre" value="{{$miembro->nombre.' '.$miembro->apellidos}} ">
							</div>
						</div>

						<div class="form-group{{ $errors->has('cantidad') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Cantidad</label>

							<div class="col-md-6">
								<input type="number" class="form-control" name="cantidad" disabled="disabled" value="{{ $miembro->membresia->precio_mensual }}">

								@if ($errors->has('cantidad'))
								<span class="help-block">
									<strong>{{ $errors->first('cantidad') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Próxima fecha de pago</label>
							<?php

							$originalDatePago = $miembro->fecha_proximo_pago;
							$formatPago = date("d-m-Y", strtotime($originalDatePago));

							?>

							<div class="col-md-6">
								<input type="text" class="form-control" disabled="disabled" name="prox_fecha_pago" value="{{$formatPago}} ">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-success" id="save">
									<i class="fa fa-btn fa-money" id="button"></i><span id="text">Pagar</span>
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