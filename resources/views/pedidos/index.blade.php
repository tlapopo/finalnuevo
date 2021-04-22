@extends('layouts.app')

@section('content')
<div class="container">


@if(Session::has('mensaje'))
<div class="alert alert-success  alert-dismissible" role="alert">
{{Session::get('mensaje')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
@endif











<br>
<br>
<table class="table table-light">
<thead class="thead-light">
<tr>
    <th>#</th>
    <th>Fecha Pedido</th>
    <th>Estado Pedido</th>
    <th>fecha envio</th>
    <th>Cliente ID</th>
    <th>Vendedor ID</th>
    <th>Acciones</th>
    
</tr>
</thead>

<tbody>
@foreach($pedidos as $pedido)
<tr>
    <td>{{$pedido->id}}</td>
    <td>{{$pedido->fecha_pedido}}</td>
    <td>{{$pedido->estado_pedido}}</td>
    <td>{{$pedido->fecha_envio}}</td>
    <td>{{$pedido->cliente_id}}</td>
    <td>{{$pedido->vendedor_id}}</td>
    <td>
    

    <a href="{{url('/pedidos/'.$pedido->id.'/edit')}}" class="btn btn-warning">
    Editar
    </a>

    <form action="{{url('/pedidos/'.$pedido->id)}}" class="d-inline" method="post">
    @csrf
    {{method_field('DELETE')}}
    <input class="btn btn-danger" type="submit" onclick="return confirm('¿Seguro que quieres elimar este dato')"
    value="Borar">
    <a href="{{url('pedidos/create')}}" class="btn btn-success">Agregar Pedidos</a>
    </form>
    </td>

</tr>
@endforeach
</tbody>
</table>
{!! $pedidos->links() !!}
</div>
@endsection