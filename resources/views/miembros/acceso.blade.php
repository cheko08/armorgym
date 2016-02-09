@extends('layouts.app')
@section('title', 'Miembros')
@section('content')

<div class="container">
	<div class="acceso-container">
		<form action="{{url('miembros/validar-acceso')}}" method="post">
			   {!! csrf_field() !!}
			<div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">

				<input type="text" name="id" class="form-control" placeholder="Número de Acceso" value="{{ old('id') }}">
				@if ($errors->has('id'))
				<span class="help-block">
					<strong>{{ $errors->first('id') }}</strong>
				</span>
				@endif
			</div>

			<button type="submit" class="btn btn-lg btn-primary" id="acceso">
				<i class="fa fa-btn fa-sign-in" id="button"></i><span id="text">Acceder</span>
			</button>

		</form>

	</div>	
</div>

@endsection