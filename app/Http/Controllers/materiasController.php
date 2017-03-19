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
            ->leftJoin('programas_estudio','programas_estudio.materia_id','=','materias.id')
            ->select('materias.id','materias.clave','materias.nombre','programas_estudio.id as programa_id',
                     'programas_estudio.archivo','materias_carreras.carrera_id')
            ->where('materias_carreras.carrera_id', '=', $id)
            ->paginate(10);
        return view('consultaMaterias', compact('materias','carrera','carreras'));
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

    public function editarMateria($id)
    {
        $carreras = Carrera::all();
        $materia = Materia::find($id);
        $materiaCarrera = DB::table('materias_carreras')
                          ->join('carreras','materias_carreras.carrera_id','carreras.id')
                          ->where('materias_carreras.materia_id','=',$id)
                          ->select('materias_carreras.*','carreras.nombre as carrera')
                          ->get();  
        $programa = DB::table('programas_estudio')
                    ->where('programas_estudio.materia_id','=',$id)
                    ->select('programas_estudio.*')
                    ->take(1);

        return view('editarMateria',compact('carreras','materia','materiaCarrera','programa')); 
    }

    public function guardarMateria(Request $datos)
    {
        $archivo = $datos->file('archivo');
        $nombre = $archivo->getClientOriginalName();
        $nombre = quitarAcentos($nombre);
        
        $materia = new Materia();
        $materia->clave = $datos->input('clave');
        $materia->nombre = $datos->input('nombre');
        $materia->save();
        
        $idMateria = $materia->id;

        $programa = new ProgramaEstudio();
        $programa->materia_id = $materia->id;
        $programa->archivo = $nombre;
        $programa->save();
        
        $carreras = Carrera::all();
        foreach($carreras as $c)
        {
            if (($datos->input($c->id))=='on')
            {
                $materiasCarreras = new CarrerasMaterias();
                $materiasCarreras->materia_id = $idMateria;
                $materiasCarreras->carrera_id = $c->id;
                $materiasCarreras->save();
            }    
        }    
        guardarArchivo($archivo,$nombre);
    }

    public function guardarArchivo($archivo,$nombre)
    {
        $ruta=storage_path($nombre);
        file_put_contents($ruta, $archivo);
    }

    function quitarAcentos($string)
    {
        return strtr($string,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ',
                     'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
    }
}
