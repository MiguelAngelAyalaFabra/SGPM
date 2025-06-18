<?php

namespace Database\Seeders;

use App\Models\Acudiente;
use Illuminate\Database\Seeder;

class AcudienteSeeder extends Seeder
{
    public function run(): void
    {
        Acudiente::create([
            'nombres' => 'Carlos',
            'apellidos' => 'Pérez',
            'telefono' => '3001234567',
            'direccion' => 'Calle 123 #45-67'
        ]);
    }
}
