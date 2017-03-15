<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materia;
use App\Carrera;

class programasController extends Controller
{
    public function registrarPrograma()
    {
    	$carreras = Carrera::all();
    	$materias = Materia::all(); 	
    	return view('registrarPrograma',compact('materias','carreras'));
    }
}
