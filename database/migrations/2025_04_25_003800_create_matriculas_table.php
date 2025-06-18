<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatriculasTable extends Migration
{
    public function up()
    {
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alumno_id');
            $table->unsignedBigInteger('tipo_plan_id');
            $table->unsignedBigInteger('tipo_jornada_id');
            $table->date('fecha_matricula');
            $table->decimal('costo_total', 10, 2);
            $table->unsignedBigInteger('tipo_descuento_id')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();

            // Foreign keys
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete('cascade');
            $table->foreign('tipo_plan_id')->references('id')->on('tipo_planes')->onDelete('cascade');
            $table->foreign('tipo_jornada_id')->references('id')->on('tipo_jornadas')->onDelete('cascade');
            $table->foreign('tipo_descuento_id')->references('id')->on('tipo_descuentos')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('matriculas');
    }
}