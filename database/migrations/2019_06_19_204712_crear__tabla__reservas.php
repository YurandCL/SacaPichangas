<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaReservas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_usuario')->unsigned();
            $table->foreign('id_usuario')
                    ->references('id')
                    ->on('users');
            $table->integer('id_cancha')->unsigned();
            $table->foreign('id_cancha')
                    ->references('id_cancha')
                    ->on('canchas');
            $table->integer('id_precio_hora')->unsigned();
            $table->foreign('id_precio_hora')
                    ->references('id_precio_hora')
                    ->on('precio_hora');
            $table->integer('hora_inicio');
            $table->integer('hora_fin');
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
        Schema::dropIfExists('reservas');
    }
}
