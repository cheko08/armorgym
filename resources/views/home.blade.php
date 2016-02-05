@extends('layouts.app')
@section('title', 'Panel de control')
@section('content')
@include('messages.global')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Panel de administración</div>

                <div class="panel-body">
                 <i class="fa fa-btn fa-users"></i>
                  Miembros Activos: <span class="badge">{{$miembros_activos}}</span> 
                  <table class="table table-hover table-users">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>Nombre</th>
                              <th>Membresía</th>
                              <th>Sucursal</th>
                              <th>Estatus</th>
                              <th></th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($miembros as $miembro)
                          <tr>
                              <td>{{$miembro->id}}</td>
                              <td>{{$miembro->nombre}} {{$miembro->apellidos}}</td>
                              <td>{{$miembro->membresia->nombre}}</td>
                              <td>{{$miembro->sucursal->nombre}}</td>
                              <td>{{$miembro->status}}</td>
                              <td><a href="{{url('miembros/edit/'.$miembro->id)}}"><i class="fa fa-btn fa-edit"></i></a></td>
                          </tr>
                        @endforeach

                      </tbody>
                  </table>
                   {!! $miembros->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
