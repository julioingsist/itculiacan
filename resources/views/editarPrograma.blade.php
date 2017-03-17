@extends('master')

@section('titulo')
	<h2>Modificación de Programa de la Materia: {{$programa->clave}}</h2>
	<hr>
@stop

@section('lista')
	<a href=""><i class="fa fa-edit fa-fw"></i> Carreras
			<span class="fa arrow"></span>
	</a>
	<ul class="nav nav-second-level">
	    @foreach($carreras as $c)
		<li>
		    <a href="{{url('consultaMaterias')}}/{{$c->id}}">{{$c->nombre}}</a>
		</li>        
		@endforeach
    </ul>
@stop

@section('contenido')
<div class="col-xs-12">
	<form action="{{url('/actualizarPrograma')}}/{{$programa->id}}" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form-group">
			<label for="clave">Clave:</label>
			<input value="{{$programa->clave}}" name="nombre" type="text" placeholder="Teclea la clave" class="form-control" required>
		</div>
		<div class="form-group">
			<label for="materia">Materia:</label>
			<select name="materia" class="form-control" required>
			@foreach($materias as $m)
				<option value="{{$m->id}}"@if ($m->id==$programa->materia_id) selected="selected" @endif >{{$m->nombre}}</option>
			@endforeach	
			</select>
		</div>
		<div class="form-group">
			<label for="archivo">Archivo:</label>
			<input value="{{$programa->archivo}}" name="archivo" type="file"> 
		</div>
		<button type="submit" class="btn btn-primary">Guardar</button>
		<a href="{{url('consultaMaterias')}}/{{$carrera->id}}" class="btn btn-danger">Cancelar</a>
	</form>
</div>
@stop




