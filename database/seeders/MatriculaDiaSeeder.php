<?php

namespace Database\Seeders;

use App\Models\MatriculaDia;
use Illuminate\Database\Seeder;

class MatriculaDiaSeeder extends Seeder
{
    public function run(): void
    {
        $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];

        foreach (['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'] as $dia) {
            MatriculaDia::create([
                'matricula_id' => 1,
                'dia' => $dia
            ]);
        }
    }
}
