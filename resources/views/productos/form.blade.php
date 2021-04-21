@extends('layouts.app')

@section('content')
<div class="container">

<h1>Editar Producto</h1>

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
<input type="text" class="form-control" name="Nombre" value="{{$productos->Nombre}}">
</div>

<div class="form-group">
<label for="Descripcion"> Descripcion: </label>
<input type="text" class="form-control" name="Descripcion" value="{{$productos->Descripcion}}">
</div>

<div class="form-group">
<label for="Precio">Precio: </label>
<input type="text" class="form-control" name="Precio" value="{{$productos->Precio}}">
</div>

<div class="form-group">
<label for="Contenido">Contenido: </label>
<input type="text" class="form-control" name="Contenido" value="{{$productos->Contenido}}">
</div>

<div class="form-group">
<img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$productos->foto}}" width="100" alt="">
<input type="file" class="form-control" name="foto" value="">
</div>


<input class="btn btn-success" type="submit" value="Editar Producto">

<a class="btn btn-primary" href="{{url('/productos')}}">Regresar</a>

</div>
@endsection