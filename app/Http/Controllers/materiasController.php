<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\DB;
use App\Carrera;
use App\Materia;
use App\ProgramaEstudio;

class materiasController extends Controller
{

    public function cargarMaterias($id)
    {
    	$carreras = Carrera::all();
    	$carrera = Carrera::find($id);	
    	$programas = DB::table('materias_carreras')
            ->join('materias', 'materias_carreras.materia_id', '=', 'materias.id')
            ->join('programas_estudio','programas_estudio.materia_id','=','materias.id')
            ->select('programas_estudio.id','programas_estudio.clave','materias.id as materia_id','materias.nombre','programas_estudio.archivo','materias_carreras.carrera_id')
            ->where('materias_carreras.carrera_id','=',$id)
            ->paginate(10);
        return view('consultaMaterias', compact('programas','carrera','carreras'));
    }

    public function abrirPDF($id)
    {
        $programas = DB::table('programas_estudio')->where('materia_id','=',$id)
                    ->take(1)
                    ->get();
        $archivo = '';                
        foreach ($programas as $p) {
            $archivo = $p->archivo;         
        }            
        
        if ($archivo!=''){
            $path = storage_path($archivo);
            return Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$archivo.'"'
            ]);
        }
        else{
           $carreras = Carrera::all();
           return ('Archivo No Encontrado');     
        }
    }

    public function registrarMateria()
    {
        $carreras = Carrera::all();
        return view('registrarMateria',compact('carreras')); 
    }

}
