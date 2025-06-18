<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoPlanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tipo_planes')->insert([
            ['tipo_plan' => 'Plan A (Lunes a Viernes)', 'dias_semana' => 5, 'costo' => 280000],
            ['tipo_plan' => 'Plan B (3 días a la semana)', 'dias_semana' => 3, 'costo' => 180000],
            ['tipo_plan' => 'Plan C (2 días a la semana)', 'dias_semana' => 2, 'costo' => 130000],
            ['tipo_plan' => 'Por sesión', 'dias_semana' => 1, 'costo' => 30000],
        ]);
    }
}
