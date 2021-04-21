@extends('layouts.app')

@section('content')
<div class="container">

<h1>Editar Cliente</h1>

@if(count($errors)>0)

   <div class="alert  alert-danger" role="alert">
   <ul>
   @foreach($errors->all() as $error)
      <li> {{$error}} </li>
   @endforeach
   </ul>
   </div>

@endif

<div class="form-group">
<label for="Nombre"> Nombre: </label>
<input type="text" class="form-control" name="Nombre" value="{{$clientes->Nombre}}">
</div>

<div class="form-group">
<label for="primer_apellido"> Primer Apellido: </label>
<input type="text" class="form-control" name="primer_apellido" value="{{$clientes->primer_apellido}}">
</div>

<div class="form-group">
<label for="segundo_apellido">Segundo Apellido: </label>
<input type="text" class="form-control" name="segundo_apellido" value="{{$clientes->segundo_apellido}}">
</div>

<div class="form-group">
<img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$clientes->foto}}" width="100" alt="">
<input type="file" class="form-control" name="foto" value="">
</div>


<input class="btn btn-success" type="submit" value="Editar Datos">

<a class="btn btn-primary" href="{{url('/clientes')}}">Regresar</a>

</div>
@endsection