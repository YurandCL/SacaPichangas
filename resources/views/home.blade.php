@extends('layouts.app')

@section('content')

@if(Session::has('perfil_editado'))
    <div class="alert alert-success">
        <p>El Perfil fué editado correctamente</p>
    </div>
@endif

@if(Session::has('no_permitido'))
    <div class="alert alert-danger">
        <p>No cuenta con los permisos necesarios</p>
    </div>
@endif

@if(Session::has('reserva_hecha'))
    <div class="alert alert-success">
        <p>La reserva se efectuó correctamente, Se verificarán los datos del Boucher y se le enviará un correo posterior a ello</p>
    </div>
@endif

<div class="container">
  <!-- Sign up form -->
      <!-- Sign up card -->
      <div class="card person-card">
        <div class="card-body" style="justify-content:center;">
          <!-- Sex image -->
          <img id="img_sex" class="person-img"
              src="/images/pagina/logo_sacapichangas.png">
          <h2 id="who_message" class="card-title">¿Qué cancha estás buscando?</h2>
          <!-- First row (on medium screen) -->
          <br>
          <form method="post" action="/">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row" style="justify-content:center;">
              <div class="form-group col-md-3">
                <select id="input_sex" class="form-control" name="id_distrito">
                  <option selected disabled>-- Seleccione un Distrito --</option>
                  @foreach ($distritos as $distrito)
                    <option value="{{ $distrito->id }}" name="{{ $distrito->nombre_distrito }}">{{ $distrito->nombre_distrito}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-5">
                <input id="first_name" type="text" class="form-control" placeholder="Nombre del local" name="nombre_local">
              </div>
              <div class="form-group col-md-2">
                <button class="btn btn-success" type="submit" style=" color:white; text-align: center">
                  Buscar
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <br>
      
      <div class="row">
        @foreach ($locales as $local)
          <div class="col-md-4 mb-5">
            <div class="card h-100">
              <div class="card-header bg-success">
                <h3 class="card-title text-white">{{ $local->nombre_local }}</h3>
              </div>
              <div class="card-body">
                <p class="card-text">{{ $local->ubicacion_local }}</p>
                <img class="img-fluid rounded mb-4 mb-lg-0" src="{{ $local->ruta_imagen_local }}" alt="local">
              </div>
              <div class="card-footer">
                <form method="post" action="/informacion-local">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="id_local" value="{{ $local->id }}">
                  <input type="submit" role="button" value="Más Información" class="btn btn-success">
                </form>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      @if (count($locales))
        {{ $locales->links() }}
      @endif
</div>
@endsection
