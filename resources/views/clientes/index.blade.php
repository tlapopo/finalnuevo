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
    <th>Nombre</th>
    <th>Apellido Paterno</th>
    <th>Apellido Materno</th>
    <th>Acciones</th>
    
</tr>
</thead>

<tbody>
@foreach($clientes as $cliente)
<tr>
    <td>{{$cliente->id}}</td>
    <td>{{$cliente->Nombre}}</td>
    <td>{{$cliente->primer_apellido}}</td>
    <td>{{$cliente->segundo_apellido}}</td>
    <td>

    <a href="{{url('/clientes/'.$cliente->id.'/edit')}}" class="btn btn-warning">
    Editar
    </a>

    <form action="{{url('/clientes/'.$cliente->id)}}" class="d-inline" method="post">
    @csrf
    {{method_field('DELETE')}}
    <input class="btn btn-danger" type="submit" onclick="return confirm('¿Seguro que quieres elimar este dato')"
    value="Borar">
    <a href="{{url('clientes/create')}}" class="btn btn-success">Crear Cliente</a>
    </form>
    </td>

</tr>
@endforeach
</tbody>
</table>
{!! $clientes->links() !!}
</div>
@endsection
