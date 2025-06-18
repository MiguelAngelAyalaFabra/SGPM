<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tipo_planes', function (Blueprint $table) {
            $table->id(); // id_tipo_plan
            $table->string('tipo_plan', 50);
            $table->integer('dias_semana')->nullable();
            $table->decimal('costo', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipo_planes');
    }
};
