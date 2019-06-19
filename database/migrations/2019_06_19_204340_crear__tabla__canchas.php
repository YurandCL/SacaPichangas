<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCanchas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canchas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_local')->unsigned();
            $table->foreign('id_local')
                    ->references('id_local')
                    ->on('locales');
            $table->integer('id_tipo_cancha')->unsigned();
            $table->foreign('id_tipo_cancha')
                    ->references('id_tipo_cancha')
                    ->on('tipo_canchas');
            $table->string('descripcion_cancha');
            $table->integer('nro_cancha');
            $table->string('ruta_imagen_cancha');
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
        Schema::dropIfExists('canchas');
    }
}
