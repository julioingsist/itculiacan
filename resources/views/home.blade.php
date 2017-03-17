@extends('master')

@section('titulo')
	<h2 class="page-header">Bienvenido al Sistema de Materias del Instituto Tecnológico de Culiacán</h2>
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
  <h1>Sistema Materias del IT Culiacán</h1>
  <p>Este es un sistema en el que se muestran algunas carreras que se ofrecen en el Instituto Tecnológico de Culiacán.
  	 Aquí puedes las materias que forman parte de la retícula de cada carrera que está disponible. </p>

@stop




