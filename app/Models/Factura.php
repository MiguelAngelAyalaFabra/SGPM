<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Factura extends Model
{
    use HasFactory;

    protected $table = 'facturas';

    protected $fillable = [
        'id_pago',
        'fecha_emision',
        'total_facturado',
        'monto_mora',
        'observaciones',
    ];

    // 🔁 Relación: Una factura pertenece a un pago
    public function pago()
    {
        return $this->belongsTo(Pago::class, 'id_pago');
    }
}

