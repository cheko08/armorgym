@extends('layouts.app')
@section('title', 'Agregar Inventario')
@section('content')
@include('messages.global')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Agregar Inventario</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="post" action="{{url('inventarios/store')}}">
						{!! csrf_field() !!}

						<div class="form-group{{ $errors->has('producto_id') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">producto</label>

							<div class="col-md-6">
								<select class="form-control" name="producto_id">
									@foreach($productos as $producto)
									<option value="{{ $producto->id }}">{{ $producto->descripcion }}</option>
									@endforeach
								</select>

								@if ($errors->has('producto_id'))
								<span class="help-block">
									<strong>{{ $errors->first('producto_id') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('sucursal_id') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Sucursal</label>

							<div class="col-md-6">
								<select class="form-control" name="sucursal_id">
									@foreach($sucursales as $sucursal)
									<option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
									@endforeach
								</select>

								@if ($errors->has('sucursal_id'))
								<span class="help-block">
									<strong>{{ $errors->first('sucursal_id') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('cantidad') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Cantidad</label>

							<div class="col-md-6">
								<input type="number" class="form-control" name="cantidad" value="{{ old('cantidad') }}">

								@if ($errors->has('cantidad'))
								<span class="help-block">
									<strong>{{ $errors->first('cantidad') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary" id="register">
									<i class="fa fa-btn fa-save" id="button"></i><span id="text">Registrar Inventario</span>
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