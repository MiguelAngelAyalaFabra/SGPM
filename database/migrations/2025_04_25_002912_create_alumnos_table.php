<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id(); // id_alumno
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->integer('edad');
            $table->string('colegio');
            $table->string('grado');
            $table->string('tipo_sangre', 5)->nullable();
            $table->text('alergias')->nullable();
            $table->string('contacto_emergencia', 100);
            
            
            $table->foreignId('acudiente_id')->constrained('acudientes')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
