<?php

namespace SacaPichangas\Http\Controllers;

use Illuminate\Http\Request;
use SacaPichangas\Canchas;
use SacaPichangas\Locales;
use SacaPichangas\Precio_Hora;
use SacaPichangas\Reservas;

use Carbon\Carbon;

class ReservasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request){
    	$canchas = Canchas::all()
            ->where('id', $request->id_cancha);

        $locales = Locales::all()->where('id', $request->id_local);

        $precio_horas_temprano = \DB::SELECT('
            SELECT hora_inicio, hora_fin, precio, id
                FROM precio_hora
                    WHERE id_local = ?
                        AND turno = ?
            ',[$request->id_local, 'temprano']
        );

        $precio_horas_tarde = \DB::SELECT('
            SELECT hora_inicio, hora_fin, id, precio
                FROM precio_hora
                    WHERE id_local = ?
                        AND turno = ?
            ',[$request->id_local, 'tarde']
        );

    	return view('canchas.reservar_cancha',compact('canchas', 'locales', 'precio_horas_temprano', 'precio_horas_tarde'));
    }

    public function postReservarCancha(Request $request)
    {
        $id_usuario = Auth()->user()->id;
        $id_cancha = $request->id_cancha;
        $id_precio_hora = $request->id_precio_hora;
        $hora_inicio = $request->hora_inicio;
        $hora_fin = $request->hora_fin;
        $fecha_reserva = $request->fecha_reserva;

        //extraemos la imagen que el usuario quiere ponerle a su cancha recien creada.
        $imagen=$request->file('imagen');
        
        //asignamos la ruta en la que se guardaran las imagenes al momento de su creación
        $ruta='/images/reserva/';
        //cambiamos el nombre de la imagen para que no exista ningun archivo con el mismo nombre y genere
        //problemas mas adelante
        $nombre=sha1(Carbon::now()).".".$imagen->guessExtension();
        // Guardamos el archivo
        $imagen->move(getcwd().$ruta,$nombre);

        Reservas::create(
            [
                'id_usuario'        =>$id_usuario,
                'id_cancha'         =>$id_cancha,
                'id_precio_hora'    =>$id_precio_hora,
                'hora_inicio'       =>$hora_inicio,
                'hora_fin'          =>$hora_fin,
                'fecha_reserva'     =>$fecha_reserva,
                'ruta_imagen_reserva'=>$nombre,
            ]
        );

        return redirect('/')->with('reserva_hecha', 'la reserva fue exitosa');
    }

    //obtener todas las reservas por cada cancha del usuario que lo reservó
    public function getVerReservasCanchas()
    {
        $id_usuario = Auth()->user()->id;

        $reservas = \DB::Select('
            SELECT r.hora_inicio, r.hora_fin, r.fecha_reserva, r.ruta_imagen_reserva, c.nro_cancha, c.descripcion_cancha, l.nombre_local
                FROM reservas as r
                    INNER JOIN canchas as c
                        ON c.id = r.id_cancha
                    INNER JOIN locales as l
                        ON l.id = c.id_local
                        WHERE r.id_usuario = ?
        ', [$id_usuario]);
        
        return view('canchas.ver_reservas_canchas', compact('reservas'));
    }
}
