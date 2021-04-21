@extends('layouts.app')

@section('content')
<div class="container">


<h1>Crear Vendedor</h1>
<form action="{{url('/vendedor')}}" method="post" enctype="multipart/form-data">
@csrf


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
<input type="text" class="form-control" name="Nombre">
</div>

<div class="form-group">
<label for="primer_apellido"> Primer Apellido: </label>
<input type="text" class="form-control" name="primer_apellido">
</div>

<div class="form-group">
<label for="segundo_apellido">Segundo Apellido: </label>
<input type="text" class="form-control" name="segundo_apellido">
</div>

<div class="form-group">
<label for="foto"> Coloca tu fotografia: </label>
<input type="file" class="form-control" name="foto">
</div>

<input class="btn btn-success" type="submit" value="Guardar Datos">
<a class="btn btn-primary" href="{{url('/vendedor')}}">Regresar</a>
</form>
</div>
@endsection