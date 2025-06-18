<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PagoDescuento extends Model
{
    protected $table = 'pagos_descuentos';

    protected $fillable = [
        'id_matricula',
        'id_tipo_descuento',
    ];

    public function matricula(): BelongsTo
    {
        return $this->belongsTo(Matricula::class, 'id_matricula');
    }

    public function tipoDescuento(): BelongsTo
    {
        return $this->belongsTo(TipoDescuento::class, 'id_tipo_descuento');
    }
}
