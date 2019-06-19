<?php

namespace SacaPichangas;

use Illuminate\Database\Eloquent\Model;

class Precios_Horas extends Model
{
    protected $table = 'precio_hora';

    protected $fillable = ['id', 'dia', 'hora_inicio', 'hora_fin', 'turno', 'precio'];
}
