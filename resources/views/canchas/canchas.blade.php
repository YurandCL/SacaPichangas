@extends('layouts.app')

@section('content')

@if(Session::has('creada'))
    <div class="alert alert-success">
        <p>La cancha fué creada correctamente</p>
    </div>
@endif

@if(Session::has('cancha_editada'))
    <div class="alert alert-success">
        <p>La cancha fué Editada Correctamente</p>
    </div>
@endif

@if(Session::has('perfil_editado'))
    <div class="alert alert-success">
        <p>El Perfil fué editado correctamente</p>
    </div>
@endif

@if(Session::has('eliminada'))
    <div class="alert alert-danger">
        <p>La cancha fué Eliminada Correctamente</p>
    </div>
@endif

@if(Session::has('local_editado'))
    <div class="alert alert-success">
        <p>El local fué Editado Correctamente</p>
    </div>
@endif

@if(Session::has('new_admin'))
    <div class="alert alert-success">
        <p>Bienvenido a la vsita de su local</p>
    </div>
@endif

@if(Session::has('no_permitido'))
    <div class="alert alert-danger">
        <p>Usted no tiene permisos para continuar</p>
    </div>
@endif

<div class="container">
    <div class="card bg-success">
        <div class="card-header text-white">
            <h3 class="card-title">
                Bienvenido {{ auth()->user()->usuario }}
            </h3>
        </div>

        <div class="card-body bg-light">
            Aqui abajo se mostrarán todas tus Canchas
        </div>  
        <div class="card-body bg-light row ml-0 mr-0">
            <?php $i=0; ?>
            @foreach ($locales as $local)
                @if ($i < 1)
                    <form action="/crear-cancha" method="GET" role="form">
                        <input type="hidden" name="_token" value="{{ csrf_token()}}" required>
                        <input type="hidden" name="id_local" value="{{ $local->id }}" required>
                        <input class="btn btn-success" role="button" type="submit" value="Crear Cancha" />
                    </form>

                    <a class="btn-sm"></a>

                    <form action="/editar-local" method="GET" role="form">
                        <input type="hidden" name="_token" value="{{ csrf_token()}}" required>
                        <input type="hidden" name="id_local" value="{{ $local->id }}" required>
                        <input class="btn btn-success" role="button" type="submit" value="Editar Local" />
                    </form>
                @else
                    @break
                @endif
                <?php $i+=1; ?>
            @endforeach
        </div>
    </div>
</div>

<?php 
    $i = 0;
?>
<br>

<div class="container">
    <div class="row">
        @foreach ($canchas as $cancha)
            <?php 
                $i += 1;
             ?>
            <div class="col-md-4 mb-5">
                <div class="card h-100">
                    <div class="card-header bg-success">
                        <h3 class="card-title text-white">Cancha nro: {{ $cancha->nro_cancha }}</h3>
                        
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $cancha->descripcion_cancha }}</p>
                        <img class="img-fluid rounded mb-4 mb-lg-0" src="{{ $cancha->ruta_imagen_cancha }}" alt="cancha">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <form class="btn-sm" action="/informacion-cancha" method="GET" role="form">
                                <input type="hidden" name="_token" value="{{ csrf_token()}}" required>
                                <input type="hidden" name="id_cancha" value="{{ $cancha->id }}" required>
                                <input type="hidden" name="id_local" value="{{ $cancha->id_local }}" required>
                                <input class="btn btn-success" role="button" type="submit" value="Información" />
                            </form>

                            <form class="btn-sm" action="/editar-cancha" method="GET" role="form">
                                <input type="hidden" name="_token" value="{{ csrf_token()}}" required>
                                <input type="hidden" name="id_cancha" value="{{ $cancha->id }}" required>
                                <input type="hidden" name="id_local" value="{{ $cancha->id_local }}" required>
                                <input class="btn btn-success" role="button" type="submit" value="Editar" />
                            </form>
                            
                            <a class="btn-sm"></a>

                            <form class="btn-sm" action="/eliminar-cancha" method="POST" role="form" onclick="return confirm('¿Está seguro de eliminar esta cancha?')">
                                <input type="hidden" name="_token" value="{{ csrf_token()}}" required>
                                <input type="hidden" name="id_cancha" value="{{ $cancha->id }}" required>
                                <input type="hidden" name="id_local" value="{{ $cancha->id_local }}" required>
                                <input class="btn btn-danger" role="button" type="submit" value="Eliminar" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
    </div>
</div>

<?php if ($i == 0) { ?>

<div class="container">
    <div class="card card-body bg-danger text-center text-white">
        No tiene ninguna cancha creada, cree una para empezar a alquilarla
    </div>
</div>
<?php } ?>

@endsection
