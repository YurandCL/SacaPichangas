<?php

namespace SacaPichangas;

use Illuminate\Database\Eloquent\Model;

class Tipo_Locales extends Model
{
    protected $table = 'tipo_locales';

    protected $fillable = ['id', 'nombre_tipo_local', 'descripcion_tipo_local'];

    public function locales(){
		  return $this->belongsTo('SacaPichangas\Locales');
	}
}
