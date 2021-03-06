@extends('layouts.app')
@section('title', 'Panel de control')
@section('content')
@include('messages.global')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Resultados de la búsqueda</div>

        <div class="panel-body">
         <i class="fa fa-btn fa-users"></i>
         Miembros Activos: <span class="badge">{{$miembros_activos}}</span> 
         <table class="table table-hover table-users">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Próxima fecha de pago</th>
              <th>Estatus</th>
              <th>Editar</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($miembros as $miembro)
            <tr>
              <td>{{$miembro->id}}</td>
              <td>{{ucwords($miembro->nombre)}} {{ucwords($miembro->apellidos)}}</td>
              <?php 
              $originalDatePago = $miembro->fecha_proximo_pago;
              $formatPago = date("d/m/Y", strtotime($originalDatePago));
              ?>
              <td>{{$formatPago}}</td>
              <td>{{$miembro->status}}</td>
              <td><a href="{{url('miembros/edit/'.$miembro->id)}}"><i class="fa fa-btn fa-edit"></i></a></td>
              <td><a href="{{url('miembros/pagar/'.$miembro->id)}}" class="btn btn-success" role="button"><i class="fa fa-btn fa-dollar"></i>Pagar</a></td>
            </tr>
            @endforeach

          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>
</div>
@endsection