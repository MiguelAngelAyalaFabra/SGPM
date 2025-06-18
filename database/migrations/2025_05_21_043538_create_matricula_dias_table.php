<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatriculaDiasTable extends Migration
{
    public function up()
    {
        Schema::create('matricula_dias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matricula_id')->constrained()->onDelete('cascade');
            $table->string('dia', 15); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('matricula_dias');
    }
}
