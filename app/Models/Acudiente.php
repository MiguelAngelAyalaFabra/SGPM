<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Acudiente extends Model
{
    use HasFactory;

    protected $table = 'acudientes';

    protected $fillable = [
        'nombres',
        'apellidos',
        'telefono',
        'direccion',
    ];

    // 🔁 Relación: Un acudiente tiene muchos alumnos
    public function alumnos()
    {
        return $this->hasMany(Alumno::class, 'id_acudiente');
    }
}

