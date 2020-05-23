@extends('layouts.app')
@section('content')
<div class="container">

	@if(count($errors)>0)
		<div class="alert alert-danger" role="alert" >
			<ul>
			 	@foreach($errors->all() as $error)
			 		<li> {{$error}} </li>
			 	@endforeach
			 </ul>
		</div>
	@endif

	<h2 class="text-center">Agregar empleado</h2>
	<form action="{{ url('/empleados') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}

		<div class="form-group">
			<label class="control-label" for="nombre">{{'Nombre'}}</label>
			<input class="form-control" type="text" name="nombre" id="nombre" value="">
		</div>

		<div class="form-group">
			<label class="control-label" for="apellido">{{'Apellido'}}</label>
			<input class="form-control" type="text" name="apellido" id="apellido" value="">
		</div>

		<div class="form-group">
			<label class="control-label" for="correo">{{'Correo'}}</label>
			<input class="form-control" type="email" name="correo" id="correo" value="">
		</div>

		<div class="form-group">
			<label class="control-label" for="foto">{{'Foto'}}</label>
			<input class="" type="file" name="foto" id="foto" value="">
		</div>
		<input class="btn btn-success" type="submit" value="Guardar">
		<a class="btn btn-primary" href="{{ url('empleados') }}">Regresar</a>
	</form>
</div>
@endsection

