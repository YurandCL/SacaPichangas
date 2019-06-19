<?php

namespace SacaPichangas\Http\Controllers;

use Illuminate\Http\Request;
use SacaPichangas\Locales;
use SacaPichangas\Distritos;
use SacaPichangas\Tipo_Locales;
use SacaPichangas\User;
use SacaPichangas\Canchas;

use Carbon\Carbon;

class LocalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getCrearLocal()
    {
    	//Con esto crearemos nuevos locales
        $distritos = Distritos::all();
        $tipo_locales = Tipo_Locales::all();

        return view('locales.crear_local', compact('distritos', 'tipo_locales'));

    }

    public function postCrearLocal(Request $request)
    {
    	$id_usuario = $request->id_usuario;

        $usuario = User::find($id_usuario);
        $usuario->tipo_usuario = 'A';
        $usuario->save();

        $nombre_local = $request->nombre_local;
        $ubicacion_local = $request->ubicacion_local;

        //extraemos la imagen que el usuario quiere ponerle a su cancha recien creada.
        $imagen=$request->file('imagen');

        //asignamos la ruta en la que se guardaran las imagenes al momento de su creación
        $ruta='/images/locales/';
        //cambiamos el nombre de la imagen para que no exista ningun archivo con el mismo nombre y genere
        //problemas mas adelante
        $nombre=sha1(Carbon::now()).".".$imagen->guessExtension();
        // Guardamos el archivo
        $imagen->move(getcwd().$ruta,$nombre);

        $descripcion_local = $request->descripcion_local;
        $telefono_local = $request->telefono_local;
        $id_distrito = $request->id_distrito;
        $id_tipo_local = $request->id_tipo_local;
        $nro_cuenta = $request->nro_cuenta;

        Locales::create(
            [
                'id_usuario'=>$id_usuario,
                'nombre_local'=>$nombre_local,
                'ubicacion_local'=>$ubicacion_local,
                'direccion_maps'=>'https://goo.gl/maps/XHV2bJXxoN4ZTezs6',
                'estado'=>1,
                'ruta_imagen_local'=>$ruta.$nombre,
                'id_distrito'=>$id_distrito,
                'descripcion_local'=>$descripcion_local,
                'telefono'=>$telefono_local,
                'dia_inicio'=>'Lunes',
                'dia_fin'=>'Domingo',
                'horario_apertura'=>'00:00',
                'hora_cierre'=>'00:00',
                'nro_cuenta'=>$nro_cuenta,
                'id_tipo_local'=>$id_tipo_local,
                
            ]
        );
        return redirect('/canchas')->with('new_admin','binvenido');
    }

    public function getEditarLocal(Request $request)
    {
    	$id_local = $request->id_local;
        $usuarios = Locales::SELECT('id_usuario')
            ->where('id', '=', $id_local)
            ->get('id');

        foreach ($usuarios as $usuario) {
            $id_usuario = $usuario->id_usuario;
        }

        if ($id_usuario == auth()->user()->id){
            //Con esto editaremos locales existentes
        	$usuario = auth()->user()->name.' '.auth()->user()->apellido;
        	
        	$id_local = $request->id_local;
        	$locales = Locales::all()->where('id', '=', $id_local);
        	
        	$distritos = Distritos::all();
        	$tipo_locales = Tipo_Locales::all();

        	return view('locales.editar_local', compact('locales', 'distritos', 'tipo_locales', 'usuario'));
        }else{
            return redirect('/canchas')->with('no_permitido','el usuario no tiene permisos');
        }
    }

    public function postEditarLocal(Request $request)
    {
    	//Con esto editaremos locales existentes
    	$local = Locales::find($request->id_local);
    	$local->nombre_local = $request->nombre_local;
    	$local->ubicacion_local = $request->ubicacion_local;

    	if ($request->hasFile('imagen')) {
            
            //extraemos la imagen nueva si esque ubiese
            $imagen = $request->file('imagen');

            //asignamos la ruta en la que se guardaran las imagenes al momento de su creación
            $ruta='/images/locales/';
            
            //cambiamos el nombre de la imagen para que no exista ningun archivo con el mismo 
            //nombre y genere problemas mas adelante
            $nombre=sha1(Carbon::now()).".".$imagen->guessExtension();
            
            // Guardamos el archivo
            $imagen->move(getcwd().$ruta,$nombre);
            
            //obtenemos la ruta anterior de la imagen para eliminarla
            $rutaanterior=getcwd().$local->ruta_imagen_local;
            if (file_exists($rutaanterior)) {
                unlink(realpath($rutaanterior));
            }
            $local->ruta_imagen_local=$ruta.$nombre;
        }

        $local->descripcion_local = $request->descripcion_local;
        $local->telefono = $request->telefono_local;
        $local->id_distrito = $request->id_distrito;
        $local->id_tipo_local = $request->id_tipo_local;

        $local->save();

        return redirect('/canchas')->with('local_editado', 'El local fue editado');
    }

    public function postEliminarLocal()
    {
    	//Con esto eliminaremos locales en des-uso o descontinuados
        // return 'local eliminado';
        $id_usuario = auth()->user()->id;
        
        $locales = Locales::all()->where('id_usuario', '=', $id_usuario);
        
        foreach ($locales as $local) {
            
            $id_local = $local->id;
            $canchas = Canchas::all()->where('id_local', '=', $id_local);
            foreach ($canchas as $cancha) {
                $id_cancha = $cancha->id;
                $canchas = Canchas::find($id_cancha);
                $rutaanterior=getcwd().$canchas->ruta_imagen_cancha;
                    if (file_exists($rutaanterior)) {
                        unlink(realpath($rutaanterior));
                    }
                $canchas->delete();
            }

            $locales = Locales::find($id_local);
            $rutaanterior=getcwd().$locales->ruta_imagen_local;
            if (file_exists($rutaanterior)) {
                unlink(realpath($rutaanterior));
            }
            $locales->delete();

            $usuario = User::find($id_usuario);
            $usuario->tipo_usuario = 'N';
            $usuario->save();

            return redirect('/principal')->with('usu_normal','ahora eres normal');
        }
    }
}
