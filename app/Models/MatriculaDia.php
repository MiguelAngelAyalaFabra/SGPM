<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatriculaDia extends Model
{
    use HasFactory;

    protected $table = 'matricula_dias';

    public $timestamps = false;

    protected $fillable = [
        'matricula_id',
        'dia',
    ];

    // 🔁 Relación: Un día pertenece a una matrícula
    public function matricula()
    {
        return $this->belongsTo(Matricula::class, 'id_matricula');
    }
}
