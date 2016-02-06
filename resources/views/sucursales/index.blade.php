@extends('layouts.app')
@section('title', 'Sucursales')
@section('content')
@include('messages.global')
<div class="row">
	<div class="col-sm-3 col-md-2 sidebar">
		<a href="{{url('sucursales/create')}}" class="btn btn-menu btn-primary">
		<i class="fa fa-btn fa-plus-circle"></i>Crear Sucursal</a>
	</div><!-- end side bar -->
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
 <table class="table table-hover table-users">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>Nombre</th>
                              <th>Dirección</th>
                              <th>Teléfono</th>
                              <th></th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($sucursales as $sucursal)
                          <tr>
                              <td>{{$sucursal->id}}</td>
                              <td>{{$sucursal->nombre}}</td>
                              <td>{{$sucursal->direccion}}</td>
                              <td>{{$sucursal->telefono}}</td>
                            
                              <td><a href="{{url('sucursales/edit/'.$sucursal->id)}}"><i class="fa fa-btn fa-edit"></i></a></td>
                          </tr>
                        @endforeach

                      </tbody>
                  </table>
                   {!! $sucursales->links() !!}

</div><!-- end center screen -->

</div><!-- end Row -->

@endsection