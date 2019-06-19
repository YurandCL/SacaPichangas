<?php

namespace SacaPichangas\Http\Controllers;

use Illuminate\Http\Request;
use SacaPichangas\Locales;
use SacaPichangas\Distritos;
use SacaPichangas\Canchas;
use SacaPichangas\Tipo_Canchas;
use SacaPichangas\User;

class InformacionController extends Controller
{
    public function postInformacionLocal(Request $request)
    {
        $id_local = $request->id_local;
        
        $locales = Locales::all()->where('id', $id_local);
        foreach ($locales as $local) {
            $distritos = Distritos::all()
                ->where('id', $local->id_distrito);

            $canchas = Canchas::all()
                ->where('id_local', $local->id)
                ;

            $usuarios = User::all()->where('id', $local->id_usuario);
        }

        $tipo_canchas = Tipo_Canchas::all();

        return view('locales.informacion_local', compact('locales', 'usuarios', 'distritos', 'canchas', 'tipo_canchas', 'id_local'));
    }
}
