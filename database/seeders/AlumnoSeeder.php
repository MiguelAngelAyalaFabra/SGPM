<?php

namespace Database\Seeders;

use App\Models\Alumno;
use Illuminate\Database\Seeder;

class AlumnoSeeder extends Seeder
{
    public function run(): void
    {
        Alumno::create([
            'nombres' => 'Lucía',
            'apellidos' => 'Pérez',
            'edad' => '5',
            'colegio' => 'Jardín Infantil ABC',
            'grado' => 'Preescolar',
            'tipo_sangre' => 'O+',
            'alergias' => 'No',
            'contacto_emergencia' => 'Juan Pérez: 3009876543',
            'acudiente_id' => 2
        ]);
    }
}
