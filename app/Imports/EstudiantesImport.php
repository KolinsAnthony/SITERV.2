<?php
namespace App\Imports;

use App\Models\Estudiante;
use Maatwebsite\Excel\Concerns\ToModel;

class EstudiantesImport implements ToModel
{
    private $programaMap = [
        'DESARROLLO DE SISTEMAS DE INFORMACIÓN' => 1,
        'PRODUCCIÓN AGROPECUARIA' => 2,
        'INDUSTRIAS ALIMENTARIAS' => 3,
        'CONTABILIDAD' => 4,
        'GUIA OFICIAL DE TURISMO' => 5,
        'ADMINISTRACIÓN DE SERVICIOS DE HOSTELERÍA Y RESTAURANTES' => 6,
        'EDUCACIÓN INICIAL' => 7,
        'EDUCACIÓN FÍSICA' => 8,
        'IDIOMAS - ESPECIALIDAD: INGLES' => 9,
        'EDUCACIÓN PRIMARIA EIB' => 10,
    ];

    public function model(array $row)
    {
        $idPrograma = $this->programaMap[$row[3]] ?? null;

        if ($idPrograma === null) {
            throw new \Exception("El programa '{$row[3]}' debe estar en mayúscula o no existe en la base de datos.");
        }

        // Verificar que nombre y apellido estén en mayúsculas
        if ($row[1] !== strtoupper($row[1]) || $row[2] !== strtoupper($row[2])) {
            // Puedes ajustar esta lógica para manejar cómo se muestra la advertencia
            throw new \Exception("El nombre y apellido deben estar en mayúsculas.");
        }

        return new Estudiante([
            'dni'        => $row[0],  // Mantener el DNI tal como está
            'nombre'     => strtoupper($row[1]),  // Convertir a mayúsculas
            'apellido'   => strtoupper($row[2]),  // Convertir a mayúsculas
            'id_programa' => $idPrograma,
        ]);
    }
}
