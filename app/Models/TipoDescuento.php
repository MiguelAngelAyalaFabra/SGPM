<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDescuento extends Model
{
    use HasFactory;

    protected $table = 'tipo_descuentos';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'tipo_descuento',
        'porcentaje',
    ];

    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'id_tipo_descuento');
    }
}
