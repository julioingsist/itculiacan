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
}
