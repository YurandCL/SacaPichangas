<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCalificaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('estrellas');
            $table->integer('id_local')->unsigned();
            $table->foreign('id_local')
                    ->references('id')
                    ->on('locales');
            $table->integer('id_usuario')->unsigned();
            $table->foreign('id_usuario')
                    ->references('id')
                    ->on('users');
            $table->String('comentarios');
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
        Schema::dropIfExists('calificaciones');
    }
}
