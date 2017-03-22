<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\DB;
use App\Carrera;
use App\Materia;
use App\ProgramaEstudio;
use App\MateriaCarrera;

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
        $archivo = "";                
        $programa = ProgramaEstudio::where('materia_id','=',$id)->first();
            
        if ($programa != NULL)
            $archivo = $programa->archivo;
         
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

    public function editarMateria($carrera_id,$id)
    {
        $carreras = Carrera::all();
        $carrera = Carrera::find($carrera_id);
        
        $materia = Materia::find($id);
        $carrerasIn = DB::table('carreras')
                          ->join('materias_carreras','materias_carreras.carrera_id','carreras.id')
                          ->where('materias_carreras.materia_id','=',$id)
                          ->select('carreras.*')
                          ->get();
        $carrerasNotIn = DB::table('carreras')
                         ->whereNotIn('id', function($query) use ($id)
                            {
                                $query->select(DB::raw('carrera_id'))
                                      ->from('materias_carreras')
                                      ->where('materias_carreras.materia_id','=',$id);
                            })
                        ->get();      
                                
        $programa = ProgramaEstudio::where('materia_id','=',$id)->first();
        if ($programa != NULL)
            $archivo = $programa->archivo;
        else
            $archivo = "";                        
        
        return view('editarMateria',compact('carrerasIn','carrerasNotIn','materia','archivo','carrera','carreras')); 
    }

    public function guardarMateria(Request $datos)
    {
        $archivo = $datos->file('archivo');
        if ($archivo != NULL){
            $nombre = $archivo->getClientOriginalName();
            $nombre = $this->quitarAcentos($nombre);
        }
        else{
            $nombre = "";
        }
        
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
                $materiasCarreras = new MateriaCarrera();
                $materiasCarreras->materia_id = $idMateria;
                $materiasCarreras->carrera_id = $c->id;
                $materiasCarreras->save();
            }    
        }
        if ($archivo != NULL)    
            $this->guardarArchivo($archivo,$nombre);
        return back();
    }

    public function actualizarMateria($id, Request $datos)
    {
        $archivo = $datos->file('archivo');
        if ($archivo != NULL){
            $nombre = $archivo->getClientOriginalName();
            $nombre = $this->quitarAcentos($nombre);
        }
        else{
            $nombre = "";
        }

        $materia = Materia::find($id);
        $materia->clave = $datos->input('clave');
        $materia->nombre = $datos->input('nombre');
        $materia->save();
        
        $programa = ProgramaEstudio::where('materia_id','=',$id)->first();
        if ($programa == NULL)
            $programa = new ProgramaEstudio();
        $programa->materia_id = $id;
        $programa->archivo = $nombre;
        $programa->save();
        
        $rs = MateriaCarrera::where('materia_id','=',$id)->delete();

        $carreras = Carrera::all();
        foreach($carreras as $c)
        {
            if (($datos->input($c->id))=='on')
            {
                $materiasCarreras = new MateriaCarrera();
                $materiasCarreras->materia_id = $id;
                $materiasCarreras->carrera_id = $c->id;
                $materiasCarreras->save();
            }    
        }
        if ($archivo != NULL)    
            $this->guardarArchivo($archivo,$nombre);
        return back();   
    }

    public function guardarArchivo($archivo,$nombre)
    {
        $ruta=storage_path();
        $archivo->move($ruta, $nombre);
    }

    public function quitarAcentos($string)
    {
        return strtr($string,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ',
                     'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
    }

    public function eliminarMateria($carrera,$id)
    {
        $filasEliminadas = DB::table('materias_carreras')
                           ->whereCarreraIdAndMateriaId($carrera,$id)
                           ->delete();
        return back();
    }
}
