<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('documento');
            $table->string('tipo_documento');
            $table->string('nombres');
            $table->string('telefono',20);
            $table->string('email', 50)->unique();
            $table->string('direccion');
            $table->string('ciudad');
            $table->integer('semestre');
            $table->json('materia_id')->default('[0]');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estudiantes');
    }
};