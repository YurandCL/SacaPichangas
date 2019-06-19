<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPreciosHoras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precio_hora', function (Blueprint $table) {
            $table->increments('id');
            $table->String('dia');
            $table->integer('hora_inicio');
            $table->integer('hora_fin');
            $table->integer('precio');
            $table->integer('id_cancha')->unsigned();
            $table->foreign('id_cancha')
                    ->references('id_cancha')
                    ->on('canchas');
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
        Schema::dropIfExists('precio_hora');
    }
}
