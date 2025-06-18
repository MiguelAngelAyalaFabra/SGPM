<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            TipoPlanSeeder::class,
            TipoJornadaSeeder::class,
            TipoDescuentoSeeder::class,
            AcudienteSeeder::class,
            AlumnoSeeder::class,
            MatriculaSeeder::class,
            MatriculaDiaSeeder::class,
        ]);
    }
}
