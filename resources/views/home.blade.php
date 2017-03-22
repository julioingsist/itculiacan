@extends('master')

@section('titulo')
	<h2 class="page-header">Sistema de Materias del IT Culiacán</h2>
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
  <img src="{{asset('images/tec.png') }}" with="200" height="200" align="right">
  <p>Este es un sistema en el que se muestran algunas carreras que se ofrecen en el Instituto Tecnológico de Culiacán.
  	 Aquí puedes consultar las materias que forman parte de la retícula de cada carrera que está disponible. 
  	 Además puedes realizar las siguientes acciones:
  	 <ul>
  	 	<li>Registrar Materias</li>
  	 	<li>Registrar Carreras</li>
  	 	<li>Consultar los programas de estudio de las materias</li>
  	 </ul>
  	 </p>

@stop




