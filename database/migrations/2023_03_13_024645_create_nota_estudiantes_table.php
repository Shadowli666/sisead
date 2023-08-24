<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotaEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota_estudiantes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_inscripcion');
            $table->float('nota1')->default(0.0);
            $table->float('nota2')->default(0.0);
            $table->float('nota3')->default(0.0);
            $table->float('nota_definitiva')->storedAs('nota1 * 0.2 + nota2 * 0.4 + nota3 * 0.4');
            /* Relaciones foraneas */
            $table->foreign('id_inscripcion')->references('id')->on('inscripcion_estudiantes')->onDelete('cascade');
            /* fin de relaciones foraneas*/
            $table->timestamps();
        });
    }

    /*
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nota_estudiantes');
    }
}
