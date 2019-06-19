<?php

namespace SacaPichangas;

use Illuminate\Database\Eloquent\Model;

class Locales extends Model
{
    protected $table = 'locales';

	protected $fillable = ['id', 'id_usuario', 'nombre_local', 'ubicacion_local', 'direccion_maps', 
		'estado', 'ruta_imagen_local', 'id_distrito', 'descripcion_local', 'telefono', 'dia_inicio', 'dia_fin',
		'horario_apertura', 'hora_cierre', 'nro_cuenta', 'id_tipo_local'];

    public function canchas(){
		return $this->hasMany('SacaPichangas\Canchas');
	}

	public function usuarios(){
		return $this->belongsTo('SacaPichangas\User');
	}

	protected $hidden = ['password', 'remember_token'];

	// Filtros o busquedas con scope
	public function scopeNombreLocal($query, $nombre_local)
	{
		if ($nombre_local){

			return $query->where('nombre_local', 'LIKE', "%$nombre_local%");		
		}
	}

	public function scopeDistrito($query, $id_distrito)
	{
		if ($id_distrito){
			return $query->where('id_distrito', 'LIKE', "%$id_distrito%");		
		}
	}
}
