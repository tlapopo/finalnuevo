@extends('layouts.app')

@section('content')
<div class="container">

<h1>Editar Pedidos</h1>

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
<label for="fecha_pedido"> Fecha Pedido: </label>
<input type="date" class="form-control" name="fecha_pedido" value="{{$pedidos->fecha_pedido}}">
</div>

<div class="form-group">
<label for="estado_pedido"> Estado Pedido: </label>
<input type="text" class="form-control" name="estado_pedido" value="{{$pedidos->estado_pedido}}">
</div>

<div class="form-group">
<label for="fecha_envio">Fecha envio: </label>
<input type="date" class="form-control" name="fecha_envio" value="{{$pedidos->fecha_envio}}">
</div>

<div class="form-group">
<label for="cliente_id">Cliente ID: </label>
<input type="text" class="form-control" name="cliente_id" value="{{$pedidos->cliente_id}}">
</div>

<div class="form-group">
<label for="vendedor_id">Vendedor ID: </label>
<input type="text" class="form-control" name="vendedor_id" value="{{$pedidos->vendedor_id}}">
</div>


<input class="btn btn-success" type="submit" value="Editar Pedido">

<a class="btn btn-primary" href="{{url('/pedidos')}}">Regresar</a>

</div>
@endsection