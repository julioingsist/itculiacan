@extends('master')

@section('titulo')
	<h2 class="page-header">Programas de estudio de la carrera: {{$carrera->nombre}}</h2>	
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
<ul>
	@foreach($materias as $m)
	<li>
		<a href="{{url('abrirPDF')}}/{{$m->id}}" target="_blank">{{$m->nombre}}</a>
	</li>
	@endforeach
</ul>	
@stop
