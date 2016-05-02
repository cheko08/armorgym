@extends('layouts.app')
@section('title', 'Salida de Efectivo')
@section('content')
@include('messages.global')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Realizar Pago</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="">
						{!! csrf_field() !!}
						<div class="form-group{{ $errors->has('cantidad') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Cantidad</label>

							<div class="col-md-6">
								<input type="number" class="form-control" name="cantidad">

								@if ($errors->has('cantidad'))
								<span class="help-block">
									<strong>{{ $errors->first('cantidad') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('concepto') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Concepto</label>

							<div class="col-md-6">
								<textarea name="concepto" class="form-control" rows="4"></textarea>
								
								</select>

								@if ($errors->has('concepto'))
								<span class="help-block">
									<strong>{{ $errors->first('concepto') }}</strong>
								</span>
								@endif
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