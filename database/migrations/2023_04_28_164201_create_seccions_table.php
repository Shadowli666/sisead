<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seccions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo_seccion', 15)->unique();
            $table->bigInteger('num_trimestre')->unsigned();
            $table->bigInteger('carrera_id')->unsigned();
            /**
             * Relaciones foráneas
             */
            $table->foreign('carrera_id')->references('id')->on('carreras')->onDelete('cascade');
            
            /**
             * Fin de las relaciones foraneas
             */
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
        Schema::dropIfExists('seccions');
    }
}
