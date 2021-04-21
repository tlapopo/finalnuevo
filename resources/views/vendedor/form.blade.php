
@extends('layouts.app')

@section('content')
<div class="container">

<h1>Editar Vendedor</h1>

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
<input type="text" class="form-control" name="Nombre" value="{{$vendedor->Nombre}}">
</div>

<div class="form-group">
<label for="primer_apellido"> Primer Apellido: </label>
<input type="text" class="form-control" name="primer_apellido" value="{{$vendedor->primer_apellido}}">
</div>

<div class="form-group">
<label for="segundo_apellido">Segundo Apellido: </label>
<input type="text" class="form-control" name="segundo_apellido" value="{{$vendedor->segundo_apellido}}">
</div>

<div class="form-group">
<img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$vendedor->foto}}" width="100" alt="">
<input type="file" class="form-control" name="foto" value="">
</div>


<input class="btn btn-success" type="submit" value="Editar Datos">

<a class="btn btn-primary" href="{{url('/vendedor')}}">Regresar</a>

</div>
@endsection