<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaLocales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_usuario')->unsigned();
            $table->foreign('id_usuario')
                    ->references('id')
                    ->on('users');
            $table->string('nombre_local');
            $table->longText('ubicacion_local');
            $table->string('latitud');
            $table->string('longitud');
            $table->integer('estado');
            $table->string('ruta_imagen_local');
            $table->integer('id_distrito')->unsigned();
            $table->foreign('id_distrito')
                    ->references('id_distrito')
                    ->on('distritos');
            $table->String('descripcion_local');
            $table->Integer('telefono');
            $table->String('horario_apertura');
            $table->String('hora_cierre');
            $table->integer('id_tipo_local')->unsigned();
            $table->foreign('id_tipo_local')
                    ->references('id_tipo_local')
                    ->on('tipo_locales');
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
        Schema::dropIfExists('locales');
    }
}
