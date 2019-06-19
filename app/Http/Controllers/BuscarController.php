<?php

namespace SacaPichangas\Http\Controllers;

use Illuminate\Http\Request;
use SacaPichangas\Canchas;
use SacaPichangas\Locales;
use SacaPichangas\Distritos;

class BuscarController extends Controller
{
    public function index($id)
    { 
        $canchas = Canchas::where('id_local', '=', $id)
            ->orderBy('id')
            ->paginate(6);
        return view('buscar', compact('canchas'));
        
    }

    public function store(Request $request)
    {
        $nombre = $request->nombreLocal;
        $distritoSelect = $request->distrito;
        $locales = $request->locales;
        $distritos = $request->distritos;
        return $locales;
        $nombreLocal=array();
        $ubicacionLocal=array();
        
        foreach($locales as $local) {
            $ubicacion = $local->ubicacion_local;
            $nombre = strtolower($nombre);
            $nombreEnBD = strtolower($local->nombre_local);
            $comparacion = "";

            //empty verifica si una variable esta vacia o es false
            if(!empty($nombre)){
                //strpos verifica si un string contiene un sub_string
                $comparacion = strpos($nombreEnBD, $nombre);

                if($comparacion === false) {
                }else{
                    $id_distrito = $request->id_distrito;
                    
                    if($local->id_distrito == $id_distrito) {
                        $nombreLocal[$local->nombre_local]= $ubicacion;
                    }   
                }

            }else{
                $id_distrito = $request->id_distrito;
                
                if($local->id_distrito == $id_distrito) {
                    $nombreLocal[$local->nombre_local]= $ubicacion;
                }
                //return $idDistrito;  
            }        
        }
        return view('buscar', compact('nombre','nombreLocal','distritos'));
    }

}
