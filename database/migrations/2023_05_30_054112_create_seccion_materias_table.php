<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeccionMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SeccionMaterias', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('seccion_id')->unsigned();
            $table->bigInteger('periodo_id')->unsigned();
            $table->bigInteger('materia_id')->unsigned();
            $table->bigInteger('profesor_id')->unsigned();
            $table->integer('cantidad')->unsigned()->default(30);
            $table->timestamps();


            $table->foreign('periodo_id')->references('id')->on('periodos')->onDelete('cascade');
            $table->foreign('seccion_id')->references('id')->on('seccions')->onDelete('cascade');
            $table->foreign('materia_id')->references('id')->on('materias')->onDelete('cascade');
            $table->foreign('profesor_id')->references('id')->on('profesors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('SeccionMaterias');
    }
}
