@extends('layouts.app')

@section('content')
<div class="container">


<h1>Agregar Productos</h1>
<form action="{{url('/productos')}}" method="post" enctype="multipart/form-data">
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
<label for="Descripcion"> Descripcion: </label>
<input type="text" class="form-control" name="Descripcion">
</div>

<div class="form-group">
<label for="Precio"> Precio: </label>
<input type="text" class="form-control" name="Precio">
</div>

<div class="form-group">
<label for="Contenido"> Contenido: </label>
<input type="text" class="form-control" name="Contenido">
</div>

<div class="form-group">
<label for="foto"> Coloca tu fotografia: </label>
<input type="file" class="form-control" name="foto">
</div>

<input class="btn btn-success" type="submit" value="Agregar Producto">
<a class="btn btn-primary" href="{{url('/productos')}}">Regresar</a>
</form>
</div>
@endsection