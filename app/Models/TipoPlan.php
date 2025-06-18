<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPlan extends Model
{
    use HasFactory;

    protected $table = 'tipo_planes';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'tipo_plan',
        'dias_semana',
        'costo',
    ];

    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'id_tipo_plan');
    }
}
