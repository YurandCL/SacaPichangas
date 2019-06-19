<?php

namespace SacaPichangas\Http\Controllers;

use Illuminate\Http\Request;
use SacaPichangas\Locales;
use SacaPichangas\Distritos;
use SacaPichangas\User;
use SacaPichangas\Canchas;
use SacaPichangas\Tipo_Canchas;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distritos = Distritos::select('id','nombre_distrito')->get();
        
        $locales = Locales::where('estado', '1')
            ->orderBy('id', 'ASC')
            ->paginate(6);

        return view('home', compact('locales','distritos'));
    }

    public function vistaUsuario(){
        //redireccionamiento para el usuario administrador de algun local
        if (auth()->user()->tipo_usuario == 'A') {
            $id_usuario = auth()->user()->id;
            $id_local = Locales::select('id')
                ->where('id_usuario', '=', $id_usuario);
            return redirect('/canchas');
        }
        //redireccionamiento a usuarios normales
        return redirect('/');
    }

    public function postBuscar(Request $request)
    {
        $nombre_local = $request->nombre_local;
        $id_distrito = $request->id_distrito;

        $distritos = Distritos::select('id','nombre_distrito')->get();

        $locales = Locales::where('estado', '=', '1')
            ->orderBy('id', 'ASC')
            ->NombreLocal($nombre_local)
            ->Distrito($id_distrito)
            ->paginate(6);

        return view('home', compact('locales','distritos'));
    
    }
}
