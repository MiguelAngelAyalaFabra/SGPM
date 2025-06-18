<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id(); // id_factura
            $table->foreignId('pago_id')->constrained('pagos')->onDelete('cascade');
            $table->date('fecha_emision');
            $table->decimal('total_facturado', 10, 2);
            $table->decimal('monto_mora', 10, 2);
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
