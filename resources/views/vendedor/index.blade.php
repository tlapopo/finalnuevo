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










<a href="{{url('vendedor/create')}}" class="btn btn-success">Crear Usuario</a>
<br>
<br>
<table class="table table-light">
<thead class="thead-light">
<tr>
    <th>#</th>
    <th>Fotografia</th>
    <th>Nombre</th>
    <th>Apellido Paterno</th>
    <th>Apellido Materno</th>
    <th>Acciones</th>
    
</tr>
</thead>

<tbody>
@foreach($vendedor as $vendedores)
<tr>
    <td>{{$vendedores->id}}</td>
    <td>
    <img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$vendedores->foto}}" width="100" alt="">
    </td>
    <td>{{$vendedores->Nombre}}</td>
    <td>{{$vendedores->primer_apellido}}</td>
    <td>{{$vendedores->segundo_apellido}}</td>
    <td>

    <a href="{{url('/vendedor/'.$vendedores->id.'/edit')}}" class="btn btn-warning">
    Editar
    </a>

    <form action="{{url('/vendedor/'.$vendedores->id)}}" class="d-inline" method="post">
    @csrf
    {{method_field('DELETE')}}
    <input class="btn btn-danger" type="submit" onclick="return confirm('¿Seguro que quieres elimar este dato')"
    value="Borar">
    </form>
    </td>

</tr>
@endforeach
</tbody>
</table>
{!! $vendedor->links() !!}
</div>
@endsection
