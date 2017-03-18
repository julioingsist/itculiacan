<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materia;
use App\Carrera;
use App\ProgramaEstudio;
use Storage;

class programasController extends Controller
{
    public function registrarPrograma()
    {
    	$carreras = Carrera::all();
    	$materias = Materia::all(); 	
    	return view('registrarPrograma',compact('materias','carreras'));
    }

    public function editarPrograma($carrera_id, $id)
    {
        $carrera = Carrera::find($carrera_id); 
        $carreras = Carrera::all();
        $programa = ProgramaEstudio::where('materia_id','=',$id)
                    ->first();
                    
        $materias = Materia::all();
        return view('editarPrograma',compact('programa','materias','carreras','carrera'));
    }

    public function guardarPrograma(Request $datos)
    {
    	$file = $datos->file('archivo');
		$nombre = $file->getClientOriginalName();
		
		$programa = new ProgramaEstudio();
		$programa->clave=$datos->input('clave');
    	$programa->materia_id=$datos->input('materia');
     	$programa->archivo=$nombre;
     	$programa->save();

        $ruta=storage_path($nombre);
        file_put_contents($ruta, $file);
        
     }

    public function actualizarPrograma($id, Request $datos)
    {
        $programa = ProgramaEstudio::find($id);
        $programa->clave=$datos->input('clave');
        $programa->materia_id=$datos->input('materia');
        $programa->save();
   
    }
}
