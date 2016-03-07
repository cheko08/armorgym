@extends('layouts.app')
@section('title', 'Usuario')
@section('content')
@include('messages.global')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Cambiar Contraseña</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('user/changePassword/'.Auth::user()->id) }}">
						{!! csrf_field() !!}
								
								  <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Contraseña Actual</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="old_password">

                                @if ($errors->has('old_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

							  <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Nueva Contraseña</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="new_password">

                                @if ($errors->has('new_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Confirmar Contraseña</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
					


						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary" id="save">
									<i class="fa fa-btn fa-save" id="button"></i><span id="text">Cambiar</span>
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