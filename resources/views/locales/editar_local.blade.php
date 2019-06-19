@extends('layouts.app')

@section('content')

<div class="container">
  <div class="d-flex justify-content-center">
    <div class="col-sm-8 col-md-8">
        <div class="card bg-success">
          <div class="card-header">
            <h3 class="text-white">
              Edita tu Local
            </h3>
          </div>
            <div class="card-body bg-light">
                <form method="post" action="{{ url('/editar-local') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" required>
                    
                    <div class="form-group row required">
                      <label for="name" class="control-label col-md-4">Dueño del Local</label>
                      <div class="col-md-8">
                        <input disabled class="form-control" name="nombre_duenio" value="{{ $usuario }}" required>
                      </div>
                    </div>
                    
                    @foreach ($locales as $local)
                    
                    <input type="hidden" name="id_local" value="{{ $local->id }}" required>
                      <div class="form-group row required">
                        <label for="name" class="control-label col-md-4">Nombre del Local</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" placeholder="Nombre del Local" name="nombre_local" value="{{ $local->nombre_local }}" required>
                        </div>
                      </div>

                      <div class="form-group row required">
                        <label for="name" class="control-label col-md-4">Dirección del Local</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" placeholder="Direccion del Local" name="ubicacion_local" value="{{ $local->ubicacion_local }}" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="name" class="control-label col-md-4">Imagen acutal</label>
                        <div class="col-md-8">
                            <img class="img-fluid rounded mb-4 mb-lg-0" src="{{ $local->ruta_imagen_local }}">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="name" class="control-label col-md-4">Seleccione su nueva imagen</label>
                        <div class="col-md-8">
                            <input type="file" class="form-control" name="imagen">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="name" class="control-label col-md-4">Descripción del Local</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="Descripción del Local" name="descripcion_local" value="{{ $local->descripcion_local }}" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="name" class="control-label col-md-4">Teléfono del Local</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" placeholder="Teléfono del Local" name="telefono_local" value="{{ $local->telefono }}" required>
                        </div>
                      </div>

                      <div class="form-group row required">
                        <label for="name" class="control-label col-md-4">Distrito</label>
                        <div class="col-md-8">
                          <select class="form-control" name="id_distrito" required>
                            @foreach ($distritos as $distrito)
                              @if ($distrito->id == $local->id_distrito)
                                <option selected value="{{ $distrito->id }}" name="{{ $distrito->nombre_distrito }}">
                                  {{ $distrito->nombre_distrito}}
                                </option>
                              @else
                                <option value="{{ $distrito->id }}" name="{{ $distrito->nombre_distrito }}">
                                  {{ $distrito->nombre_distrito}}
                                </option>
                              @endif
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="form-group row required">
                        <label for="name" class="control-label col-md-4">Tipo de Local</label>
                        <div class="col-md-8">
                          <select class="form-control" name="id_tipo_local" required>
                            @foreach ($tipo_locales as $tipo_local)
                              @if ($tipo_local->id == $local->id_tipo_local)
                                <option selected value="{{ $tipo_local->id }}" name="{{ $tipo_local->nombre_tipo_local }}">
                                  {{ $tipo_local->nombre_tipo_local }}
                                </option>
                              @else
                                <option value="{{ $tipo_local->id }}" name="{{ $tipo_local->nombre_tipo_local }}">
                                  {{ $tipo_local->nombre_tipo_local }}
                                </option>
                              @endif
                            @endforeach
                          </select>
                        </div>
                      </div>
                    @endforeach

                    <div class="form-group row">
                      <a href="{{ url('/canchas')}}" class="col-md-4 form-control btn btn-success" style=" color:white; text-align: center">
                          Cancelar
                        </a>
                      
                      <div class="col-md-4"></div>

                      <div class="col-md-4">
                        <button class="form-control btn btn-success" type="submit" style=" color:white; text-align: center"> 
                          Actualizar
                        </button>
                      </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
</div>

@endsection