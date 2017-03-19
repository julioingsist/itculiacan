<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carrera;

class carrerasController extends Controller
{
    public function cargarCarreras()
    {
    	$carreras = Carrera::all();
    	return view('home',compact('carreras'));	
    }

    public function registrarCarrera()
    {
    	$carreras = Carrera::all();
    	return view('registrarCarrera',compact('carreras'));
    }

    public function guardarCarrera(Request $datos)
    {
    	$carrera = new Carrera();
    	$carrera->nombre = $datos->input('nombre');
    	$carrera->save();

    	return back();
    }
}
