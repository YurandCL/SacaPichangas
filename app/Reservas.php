<?php

namespace SacaPichangas;

use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    protected $table = 'reservas';

    protected $fillable = ['id', 'id_usuario', 'id_cancha', 'id_precio_hora', 'hora_inicio', 'hora_fin', 'fecha_reserva', 'ruta_imagen_reserva'];
}
