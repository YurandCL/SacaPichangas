<?php

namespace SacaPichangas;

use Illuminate\Database\Eloquent\Model;

class Tipo_Canchas extends Model
{
    protected $table = 'tipo_canchas';

   	protected $fillable = ['id', 'nombre_tipo_cancha', 'descripcion_tipo_cancha'];

    public function canchas(){
		return $this->belongsTo('SacaPichangas\Canchas');
	}
}
