<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alumno extends Model
{
    use HasFactory;

    protected $table = 'alumnos';

    protected $fillable = [
        'nombres',
        'apellidos',
        'edad',
        'colegio',
        'grado',
        'tipo_sangre',
        'alergias',
        'contacto_emergencia',
        'acudiente_id',
    ];

    // 🔁 Relación: Un alumno pertenece a un acudiente
    public function acudiente()
    {
        return $this->belongsTo(Acudiente::class, 'acudiente_id');
    }
    // 🔁 Relación: Un alumno tiene muchas matrículas
public function matriculas()
{
    return $this->hasMany(Matricula::class, 'id_alumno');
}
}
