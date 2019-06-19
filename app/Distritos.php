<?php

namespace SacaPichangas;

use Illuminate\Database\Eloquent\Model;

class Distritos extends Model
{
    protected $table = 'distritos';

    protected $fillable = ['id', 'nombre_distrito'];
}
