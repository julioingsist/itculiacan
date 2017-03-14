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
    	$materias = DB::table('materias_carreras')
            ->join('materias', 'materias_carreras.materia_id', '=', 'materias.id')
            ->select('materias_carreras.carrera_id','materias.id','materias.nombre')
            ->where('materias_carreras.carrera_id','=',$id)
            ->get();
        return view('consultaMaterias', compact('materias','carrera','carreras'));
    }

    public function abrirPDF($id)
    {
        $programas = DB::table('programas_estudio')->where('materia_id','=',$id)
                    ->take(1)
                    ->get();
        $archivo = '';                
        foreach ($programas as $p) {
            $archivo = $p->ruta_archivo;         
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
           return view('archivoNoEncontrado',compact('carreras'));     
        }
    }
}
