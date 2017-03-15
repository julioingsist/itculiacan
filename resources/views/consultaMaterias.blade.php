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
<div class="col-xs-12">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Clave</th>
				<th>Materia</th>
				<th>Archivo</th>
			</tr>
		</thead>
		<tbody>
		@foreach($programas as $p)
			<tr>
				<td>{{$p->clave}}</td>
				<td>{{$p->nombre}}</td>
				<td><a href="{{url('abrirPDF')}}/{{$p->id}}" target="_blank">{{$p->archivo}}</a></td>
				<td>
					<a href="{{url('editarPrograma')}}/{{$carrera->id}}/{{$p->id}}" class="btn btn-xs btn-primary">
						<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
					</a>
					<a href="{{url('eliminarPrograma')}}/{{$p->id}}" type="button" class="btn btn-danger btn-xs" >
					  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</button>
				</td>
			</tr>
		@endforeach

		</tbody>
	</table>
	<div class="text-center">
		{{$programas->links()}}	
	</div>
</div>
	
@stop
