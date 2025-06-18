<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos';

    protected $fillable = [
        'matricula_id',
        'fecha_pago',
        'monto_pagado',
    ];

    // 🔁 Relación: Un pago pertenece a una matrícula
    public function matricula()
    {
        return $this->belongsTo(Matricula::class);
    }

    // 🔁 Relación: Un pago tiene una factura
    public function factura()
    {
        return $this->hasOne(Factura::class, 'id_pago');
    }
}
