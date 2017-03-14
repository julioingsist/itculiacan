@extends('master')

@section('titulo')
	<h2 class="page-header">Bienvenido al Sistema de Materias del Instituto Tecnológico de Culiacán</h2>
@stop

@section('lista')
	<a href=""><i class="fa fa-bar-chart-o fa-fw"></i> Carreras
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
@stop




