<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('primer_nombre', 30)->nullable();
            $table->string('segundo_nombre', 30)->nullable();
            $table->string('primer_apellido', 30)->nullable();
            $table->string('segundo_apellido', 30)->nullable();
            $table->integer('cedula');
            $table->bigInteger('procedencia_id')->unsigned();
            $table->bigInteger('carrera_id')->unsigned();
            $table->bigInteger('periodo_inscripcion_id')->unsigned();
            $table->string('pais', 50);
            $table->string('telefono1', 25);
            $table->string('telefono2', 25)->nullable();
            $table->string('correo', 50);
            $table->string('nom_representante', 30)->nullable();
            $table->string('tel_representante', 25)->nullable();
            $table->string('correo_representante', 50)->nullable();
            $table->string('estatus', 10)->default('Activo');
            /* Relaciones foraneas */
            $table->foreign('procedencia_id')->references('id')->on('procedencias')->onDelete('cascade');
            $table->foreign('carrera_id')->references('id')->on('carreras')->onDelete('cascade');
            $table->foreign('periodo_inscripcion_id')->references('id')->on('periodos')->onDelete('cascade');
            /* fin de relaciones foraneas*/

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
}
