<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Matricula extends Model
{
    use HasFactory;

    protected $fillable = [
        'alumno_id',
        'tipo_plan_id',
        'tipo_jornada_id',
        'fecha_matricula',
        'costo_total',
        'tipo_descuento_id',    
    ];

    protected $casts = [
        'fecha_matricula' => 'date',
    ];

    // Relaciones
    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }

    public function tipoPlan()
    {
        return $this->belongsTo(TipoPlan::class);
    }

    public function tipoJornada()
    {
        return $this->belongsTo(TipoJornada::class);
    }

    public function tipoDescuento()
    {
        return $this->belongsTo(TipoDescuento::class);
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }

    public function dias()
    {
        return $this->hasMany(MatriculaDia::class);
    }

    // Método para calcular saldo pendiente (lo que queda por pagar)
    public function saldoPendiente()
    {
        $totalPagado = $this->pagos()->sum('monto_pagado');
        return $this->costo_total - $totalPagado;
    }
}
