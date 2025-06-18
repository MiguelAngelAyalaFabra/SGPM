<?php

namespace Database\Seeders;

use App\Models\Matricula;
use Illuminate\Database\Seeder;

class MatriculaSeeder extends Seeder
{
    public function run(): void
    {
        Matricula::create([
            'alumno_id' => 2,
            'tipo_plan_id' => 2,
            'tipo_jornada_id' => 2,
            'fecha_matricula' => now(),
            'costo_total' => 280000,
            'tipo_descuento_id' => null
        ]);
    }
}
