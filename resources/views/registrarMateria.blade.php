@extends('master')

@section('titulo')
	<h2>Registro de Materias</h2>
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
	<form action="{{url('/guardarMateria')}}" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form-group">
			<label for="nombre">Nombre:</label>
			<input name="nombre" type="text" placeholder="Teclea nombre" class="form-control" required>
		</div>
		<div class="form-group">
			<label for="carrera">Carrera:</label>
			<select name="carrera" class="form-control" required>
			<option value=""> Seleccione una carrera </option> 
			@foreach($carreras as $c) 
        		<option value="{{ $c->id}}"> {{ $c->nombre}} </option> 
        	@endforeach	
			</select>
		</div>
		
		<button type="submit" class="btn btn-primary">Registrar</button>
		<a href="{{url('/')}}" class="btn btn-danger">Cancelar</a>
	</form>
</div>
@stop
