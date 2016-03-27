@extends('layouts.app')
@section('title', 'Productos')
@section('content')
@include('messages.global')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Editar Producto</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="post" action="{{url('productos/update/'.$producto->id)}}">
						{!! csrf_field() !!}

						<div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Descripcion</label>

							<div class="col-md-6">
								<input type="text" class="form-control" autofocus name="descripcion" value="{{ $producto->descripcion }}">

								@if ($errors->has('descripcion'))
								<span class="help-block">
									<strong>{{ $errors->first('descripcion') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('precio') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Precio</label>

							<div class="col-md-6">
								<input type="number" class="form-control" name="precio" value="{{  $producto->precio }}">

								@if ($errors->has('precio'))
								<span class="help-block">
									<strong>{{ $errors->first('precio') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('costo') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Costo</label>

							<div class="col-md-6">
								<input type="number" class="form-control" name="costo" value="{{  $producto->costo }}">

								@if ($errors->has('costo'))
								<span class="help-block">
									<strong>{{ $errors->first('costo') }}</strong>
								</span>
								@endif
							</div>
						</div>

					
						
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary" id="register">
									<i class="fa fa-btn fa-edit" id="button"></i><span id="text">Actualizar Producto</span>
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