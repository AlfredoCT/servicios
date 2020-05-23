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

	<h2 class="text-center">Actualizar empleado</h2>
	<form action="{{ url('/empleados/' . $empleado->id) }}" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
		{{ method_field('PATCH') }}

		<div class="form-group">
			<label class="control-label" for="nombre">{{'Nombre'}}</label>
			<input class="form-control" type="text" name="nombre" id="nombre" value="{{ $empleado->nombre }}">
		</div>

		<div class="form-group">
			<label class="control-label" for="apellido">{{'Apellido'}}</label>
			<input class="form-control" type="text" name="apellido" id="apellido" value="{{ $empleado->apellido }}">
		</div>

		<div class="form-group">
			<label class="control-label" for="correo">{{'Correo'}}</label>
			<input class="form-control" type="email" name="correo" id="correo" value="{{ $empleado->correo }}">
		</div>

		<div class="form-group">
			<img src="{{ asset('storage').'/'.$empleado->foto}}" class="img-thumbnail img-fluid" alt="" width="150">
		</div>

		<div class="form-group">
			<label for="foto">{{'Foto'}}</label>
			<input type="file" name="foto" id="foto" value="">
		</div>

		<input class="btn btn-success" type="submit" value="Guardar">
		<a class="btn btn-primary" href="{{ url('empleados') }}">Regresar</a>
	</form>
</div>
@endsection
