<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoDescuentoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tipo_descuentos')->insert([
            [
                'tipo_descuento' => 'Dos o más hijos',
                'porcentaje' => 10.00,
            ],
            [
                'tipo_descuento' => 'Antigüedad',
                'porcentaje' => 15.00,
            ],
            [
                'tipo_descuento' => 'Familiar de empleado',
                'porcentaje' => 20.00,
            ],
        ]);
    }
}
