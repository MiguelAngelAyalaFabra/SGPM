<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoJornadaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tipo_jornadas')->insert([
            [
                'tipo_jornada' => 'Mañana',
                'hora_inicio' => '08:00:00',
                'hora_fin' => '12:00:00',
            ],
            [
                'tipo_jornada' => 'Tarde (3 PM - 5 PM)',
                'hora_inicio' => '15:00:00',
                'hora_fin' => '17:00:00',
            ],
            [
                'tipo_jornada' => 'Tarde (4 PM - 6 PM)',
                'hora_inicio' => '16:00:00',
                'hora_fin' => '18:00:00',
            ],
        ]);
    }
}
