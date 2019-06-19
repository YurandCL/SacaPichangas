<?php

namespace SacaPichangas\Http\Controllers;

use Illuminate\Http\Request;
use SacaPichangas\User;

use Carbon\Carbon;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getEditarPerfil(Request $request)
    {
    	$usuario_id = auth()->user()->id;
        $id_usuario = $request->id_usuario;
    	
        if ($usuario_id == $id_usuario) {
    		$usuarios = User::all()->where('id',$usuario_id);
    		return view('usuario.editar_perfil', compact('usuarios'));
        }else{
            if (auth()->user()->tipo_usuario == 'A'){
                return redirect('/canchas')->with('no_permitido','el usuario no tiene permisos');
            }else{
                return redirect('/')->with('no_permitido','el usuario no tiene permisos');
            }
        }
    }

    public function postEditarPerfil(Request $request)
    {
        $usuario = User::find($request->id_usuario);

        if ($request->hasFile('imagen')) {
            
            //extraemos la imagen nueva si esque ubiese
            $imagen = $request->file('imagen');

            //asignamos la ruta en la que se guardaran las imagenes al momento de su creación
            $ruta='/images/usuarios/';
            
            //cambiamos el nombre de la imagen para que no exista ningun archivo con el mismo 
            //nombre y genere problemas mas adelante
            $nombre=sha1(Carbon::now()).".".$imagen->guessExtension();
            
            // Guardamos el archivo
            $imagen->move(getcwd().$ruta,$nombre);
            
            //obtenemos la ruta anterior de la imagen para eliminarla
            $rutaanterior=getcwd().$usuario->ruta_imagen_usuario;
            
            if (file_exists($rutaanterior)) {
                if ($rutaanterior != 'C:\xampp\htdocs\SacaPichangas\public/images/usuarios/usuario.png') {
                    
                    unlink(realpath($ruta.$rutaanterior));
                }
            }
            $usuario->ruta_imagen_usuario=$nombre;
        }

    	$usuario->name = $request->nombre_usuario;
    	$usuario->apellido = $request->apellido_usuario;
    	$usuario->email = $request->email;
    	$usuario->celular = $request->celular;
    	$usuario->usuario = $request->usuario;
    	$usuario->save();

    	return redirect('/principal')->with('perfil_editado','perfil editado');
    }
}
