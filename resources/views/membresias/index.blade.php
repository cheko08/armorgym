@extends('layouts.app')
@section('title', 'Membresias')
@section('content')
@include('messages.global')
<div class="row">
	<div class="col-sm-3 col-md-2 sidebar">
		<a href="{{url('membresias/create')}}" class="btn btn-menu btn-primary">
		<i class="fa fa-btn fa-plus-circle"></i>Crear Membresía</a>
	</div><!-- end side bar -->
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
 <table class="table table-hover table-users">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>Nombre</th>
                              <th>Precio/Mes</th>
                              <th>Inscripción</th>
                              <th>Descripción</th>
                              <th>Estatus</th>
                              <th></th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($membresias as $membresia)
                          <tr>
                              <td>{{$membresia->id}}</td>
                              <td>{{$membresia->nombre}}</td>
                              <td>{{$membresia->precio_mensual}}</td>
                              <td>{{$membresia->inscripcion}}</td>
                              <td>{{$membresia->descripcion}}</td>
                              <td>{{$membresia->status}}</td>
                              <td><a href="{{url('membresias/edit/'.$membresia->id)}}"><i class="fa fa-btn fa-edit"></i></a></td>
                          </tr>
                        @endforeach

                      </tbody>
                  </table>
                   {!! $membresias->links() !!}

</div><!-- end center screen -->

</div><!-- end Row -->

@endsection