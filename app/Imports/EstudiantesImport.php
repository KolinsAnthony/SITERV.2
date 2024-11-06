<?php 
namespace App\Imports; 
 
use App\Models\Estudiante; 
use Maatwebsite\Excel\Concerns\ToModel; 
 
class EstudiantesImport implements ToModel 
{ 
    public function model(array $row) 
    { 
        return new Estudiante([ 
            'dni'        => $row[0],  // Primera columna del archivo 
            'nombre'     => $row[1],  // Segunda columna del archivo 
            'apellido'   => $row[2],  // Tercera columna del archivo 
            'id_programa' => $row[3],  // Cuarta columna del archivo 
        ]); 
    } 
}