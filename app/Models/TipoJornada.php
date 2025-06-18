<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoJornada extends Model
{
    use HasFactory;

    protected $table = 'tipo_jornadas';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'tipo_jornada',
        'hora_inicio',
        'hora_fin',
    ];

    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'id_tipo_jornada');
    }
}
