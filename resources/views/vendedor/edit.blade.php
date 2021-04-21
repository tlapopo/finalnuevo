<form action="{{url('/vendedor/'.$vendedor->id)}}" method='post' enctype="multipart/form-data">
@csrf
{{method_field('PATCH')}}
@include('vendedor.form')
</form>

