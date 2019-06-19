<?php

namespace SacaPichangas\Http\Controllers;

use Illuminate\Http\Request;
use SacaPichangas\Locales;
use SacaPichangas\Canchas;
use SacaPichangas\Tipo_Canchas;
use SacaPichangas\User;

use Carbon\Carbon;
use DB;

class CanchasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
    	if (auth()->user()->tipo_usuario == 'A') {
            
            $usuario_id = auth()->user()->id;
            
            $locales = Locales::select('id')
                ->where('id_usuario', '=', $usuario_id)
                ->get('id');
            
            foreach ($locales as $local) {
                $canchas = Canchas::where('id_local', '=', $local->id)
                    ->get();
                    
            }
            return view('canchas.canchas', compact('canchas','locales'));
    	}else{
    		return redirect('/')->with('canchas','no encuetras?');
    	}
    }

    //-------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------

    //Funciones para Crear canchas

    public function getCrearCancha(Request $request)
    {
        $id_local = $request->id_local;
        $usuarios = Locales::SELECT('id_usuario')
            ->where('id', '=', $id_local)
            ->get('id');

        foreach ($usuarios as $usuario) {
            $id_usuario = $usuario->id_usuario;
        }

        if ($id_usuario == auth()->user()->id){
            $tipo_canchas = Tipo_Canchas::all();

            $canchas = DB::select('SELECT COUNT(id) as count 
                FROM canchas 
                WHERE id_local = '.$id_local);
        
            return view('canchas.crear_cancha', compact('tipo_canchas', 'canchas', 'id_local'));
        }else{
            return redirect('/canchas')->with('no_permitido','el usuario no tiene permisos');
        }
    }
        

    public function postCrearCancha(Request $request)
    {
        $usuario_id = auth()->user()->id;
        $locales = Locales::select('id')
                ->where('id_usuario', '=', $usuario_id)
                ->get('id');

        foreach ($locales as $local) {
            $id_local = $local->id;
        }
        
        //sacamos la cantidad de canchas que tiene el local
        $canchas = DB::select('SELECT COUNT(id) as count FROM canchas WHERE id_local = '.$id_local);
        //obtenemos el valor que requerimos (el numero de canchas en total)
        foreach ($canchas as $cancha) {
            $nro_cancha = $cancha->count;
        }

        //extraemos la descripcion de la cancha que el dueño quiere mostrar
        $descripcion_cancha = $request->descripcion_cancha;
        
        //le asignamos un numero a la cancha (utilizamos esta manera porque cuando se le pide al request
        //este no nos reconoce el elemento y nos devuelve algo vacio)
        $numero_cancha = $nro_cancha + 1;
        
        //extraemos el id del tipo de cancha para poder enlazarlo en la BD
        $id_tipo_cancha = $request->id_tipo_cancha;

        //extraemos la imagen que el usuario quiere ponerle a su cancha recien creada.
        $imagen=$request->file('imagen');
        //asignamos la ruta en la que se guardaran las imagenes al momento de su creación
        $ruta='/images/canchas/';
        //cambiamos el nombre de la imagen para que no exista ningun archivo con el mismo nombre y genere
        //problemas mas adelante
        $nombre=sha1(Carbon::now()).".".$imagen->guessExtension();
        // Guardamos el archivo
        $imagen->move(getcwd().$ruta,$nombre);

        //Creamos o insertamos en la base de datos todo lo requrido
        Canchas::create(
            [
                'id_local'=>$id_local,
                'id_tipo_cancha'=>$id_tipo_cancha,
                'descripcion_cancha'=>$descripcion_cancha,
                'nro_cancha'=>$numero_cancha,
                'ruta_imagen_cancha'=>$ruta.$nombre,
            ]
        );

        //Redireccionamos a la vista de canchas para que pueda ver su nueva cancha creada y le enviamos un 
        // parámetro de sesion para que se muestre un mensaje sactisfactorio de su creación
        return redirect("/canchas")->with('creada','La cancha ha sido agregada');
    }

    //-------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------

    //Funciones para mostrar información las canchas

    public function getInformacionCancha(Request $request)
    {
        $id_local = $request->id_local;
        $usuarios = Locales::SELECT('id_usuario')
            ->where('id', '=', $id_local)
            ->get('id');

        foreach ($usuarios as $usuario) {
            $id_usuario = $usuario->id_usuario;
        }

        if ($id_usuario == auth()->user()->id){
            $id_cancha = $request->id_cancha;
            $canchas = Canchas::all()->where('id', '=', $id_cancha);
            $tipo_canchas = Tipo_Canchas::all();
            //return 'el usuario es correcto';
            $locales = Locales::select('id','nombre_local')
                    ->where('id_usuario', '=', $id_usuario)
                    ->get('id');

            foreach ($canchas as $cancha) {
                $cancha_local_id = $cancha->id_local;
            }

            $reservas = \DB::Select('
                SELECT r.hora_inicio, r.hora_fin, r.fecha_reserva, u.name, u.apellido, u.celular
                    FROM reservas as r
                        INNER JOIN canchas as c
                            ON c.id = r.id_cancha
                        INNER JOIN locales as l
                            ON l.id = c.id_local
                        INNER JOIN users as u
                            ON u.id = r.id_usuario
                            WHERE c.id = ?;
            ', [$id_cancha]);

            if ($cancha_local_id == $id_local) {
                return view('canchas.informacion_cancha', compact('canchas', 'tipo_canchas', 'locales', 'reservas'));
            }
            return redirect('/canchas')->with('no_permitido','el usuario no tiene permisos');
        }else{
            return redirect('/canchas')->with('no_permitido','el usuario no tiene permisos');
        }
    }

    //-------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------    

    //Funciones para editar las canchas

    public function getEditarCancha(Request $request)
    {
        $id_local = $request->id_local;
        $usuarios = Locales::SELECT('id_usuario')
            ->where('id', '=', $id_local)
            ->get('id');

        foreach ($usuarios as $usuario) {
            $id_usuario = $usuario->id_usuario;
        }

        if ($id_usuario == auth()->user()->id){

            $id_cancha = $request->id_cancha;
            $canchas = Canchas::all()
                ->where('id', '=', ''.$id_cancha);

            foreach ($canchas as $cancha) {
                $id_local_cancha = $cancha->id_local;
            }
            if ($id_local_cancha == $id_local) {
                $tipo_canchas = Tipo_Canchas::all();

                // foreach ($canchas as $cancha) {
                //     return $cancha->id_cancha;
                // }
                
                return view('canchas.editar_cancha', compact('canchas', 'tipo_canchas'));
            }
            return redirect('/canchas')->with('no_permitido','el usuario no tiene permisos');
        }else{
            return redirect('/canchas')->with('no_permitido','el usuario no tiene permisos');
        }
    }

    public function postEditarCancha(Request $request)
    {
        //obtenemos los datos de la cancha segun su id
        $id_cancha = $request->id_cancha;
        //$canchas = Canchas::all()->where('id_cancha', '=', ''.$id_cancha);
        $canchas = Canchas::find($id_cancha);
        //obtenemos el nuevo tipo de cancha
        $canchas->id_tipo_cancha = $request->id_tipo_cancha;

        //obtenemos la nueva descripción de cancha
        $canchas->descripcion_cancha = $request->descripcion_cancha;

        //obtenemos el nuevo numero de cancha
        $canchas->nro_cancha = $request->nro_cancha;

        // foreach ($canchas as $cancha) {
        //     $ruta_imagen_cancha = $cancha->ruta_imagen_cancha;
        // }
        
        if ($request->hasFile('imagen')) {
            
            //extraemos la imagen nueva si esque ubiese
            $imagen = $request->file('imagen');
            //asignamos la ruta en la que se guardaran las imagenes al momento de su creación
            $ruta='/images/canchas/';
            
            //cambiamos el nombre de la imagen para que no exista ningun archivo con el mismo 
            //nombre y genere problemas mas adelante
            $nombre=sha1(Carbon::now()).".".$imagen->guessExtension();
            
            // Guardamos el archivo
            $imagen->move(getcwd().$ruta,$nombre);
            
            //obtenemos la ruta anterior de la imagen para eliminarla
            $rutaanterior=getcwd().$canchas->ruta_imagen_cancha;
            if (file_exists($rutaanterior)) {
                unlink(realpath($rutaanterior));
            }
            $canchas->ruta_imagen_cancha=$ruta.$nombre;
        }

        $canchas->save();
        return redirect('/canchas')->with('cancha_editada', 'la cancha fue editada');
    }

    //-------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------

    //Funciones para eliminar la cancha selecionada

    public function postEliminarCancha(Request $request)
    {
        $id_local = $request->id_local;
        $usuarios = Locales::SELECT('id_usuario')
            ->where('id', '=', $id_local)
            ->get('id');

        foreach ($usuarios as $usuario) {
            $id_usuario = $usuario->id_usuario;
        }

        if ($id_usuario == auth()->user()->id){

            $id_cancha = $request->id_cancha;
            $canchas = Canchas::find($id_cancha);
            $rutaanterior=getcwd().$canchas->ruta_imagen_cancha;
                if (file_exists($rutaanterior)) {
                    unlink(realpath($rutaanterior));
                }
            $canchas->delete();
            return redirect('/canchas')->with('eliminada', 'La cancha fue eliminada');
            
        }else{
            return redirect('/canchas')->with('no_permitido','el usuario no tiene permisos');
        }
    }
}
