@extends('master')

@section('titulo')
	<h2>Registro de Programas de Estudio</h2>
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
	<form action="{{url('/guardarPrograma')}}" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form-group">
			<label for="clave">Clave:</label>
			<input name="clave" type="text" placeholder="Teclea la clave" class="form-control" required>
		</div>
		<div class="form-group">
			<label for="materia">Materia:</label>
			<select name="materia" class="form-control" required>
				<option value="" selected="">Seleccione una materia</option>
				@foreach($materias as $m)
					<option value="{{$m->id}}">{{$m->nombre}}</option>
				@endforeach	
			</select>
		</div>
		<div class="form-group">
			<label for="archivo">Archivo:</label>
			<input value="" name="archivo" type="file"> 
		</div>
		<button type="submit" class="btn btn-primary">Guardar</button>
		<a href="{{url('/')}}" class="btn btn-danger">Cancelar</a>
	</form>
</div>
@stop
