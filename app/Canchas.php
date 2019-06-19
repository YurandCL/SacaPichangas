<?php

namespace SacaPichangas;

use Illuminate\Database\Eloquent\Model;

class Canchas extends Model
{
    protected $table = 'canchas';

    protected $fillable = ['id', 'id_local', 'id_tipo_cancha', 'descripcion_cancha', 'nro_cancha', 'ruta_imagen_cancha'];

    public function locales(){
		return $this->belongsTo('SacaPichangas\Local');
	}

    public function tipo_canchas(){
		return $this->hasMany('SacaPichangas\Tipo_Canchas');
	}

	public function reservas(){
		return $this->hasMany('SacaPichangas\Reservas');
	}

	protected $hidden = ['password', 'remember_token'];
}
