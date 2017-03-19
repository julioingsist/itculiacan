@extends('master')

@section('titulo')
	<h2 class="page-header">Programas de estudio de la carrera: {{$carrera->nombre}}</h2>	
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
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Clave</th>
				<th>Materia</th>
				<th>Archivo</th>
			</tr>
		</thead>
		<tbody>
		@foreach($materias as $m)
			<tr>
				<td>{{$m->clave}}</td>
				<td>{{$m->nombre}}</td>
				<td><a href="{{url('abrirPDF')}}/{{$m->programa_id}}" target="_blank">{{$m->archivo}}</a></td>
				<td>
					<a href="{{url('editarMateria')}}/{{$carrera->id}}/{{$m->id}}" class="btn btn-xs btn-primary">
						<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
					</a>
					<a href="{{url('eliminarMateria')}}/{{$m->id}}" type="button" class="btn btn-danger btn-xs" >
					  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</button>
				</td>
			</tr>
		@endforeach

		</tbody>
	</table>
	<div class="text-center">
		{{$materias->links()}}	
	</div>
</div>
@stop
