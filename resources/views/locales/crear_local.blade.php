@extends('layouts.app')

@section('content')

<div class="container">
  <div class="d-flex justify-content-center">
    <div class="col-sm-8 col-md-8">
        <div class="card bg-success">
          <div class="card-header">
            <h3 class="text-white">
              Crea tu Local
            </h3>
          </div>
            <div class="card-body bg-light">
              <form method="POST" action="/crear-local" enctype="multipart/form-data">
                
                <input type="hidden" name="_token" value="{{ csrf_token() }}" required>
                <input type="hidden" name="id_usuario" value="{{ auth()->user()->id }}" required>
                
                <div class="form-group row required">
                  <label for="name" class="control-label col-md-4">Dueño del Local</label>
                  <div class="col-md-8">
                    <input disabled class="form-control" name="nombre_duenio" value="{{ auth()->user()->name }}" required>
                  </div>

                </div>

                <div class="form-group row required">
                  <label for="name" class="control-label col-md-4">Nombre del Local</label>
                  <div class="col-md-8">
                    <input type="text" class="form-control required" placeholder="Nombre del Local" name="nombre_local" required>
                  </div>
                </div>

                <div class="form-group row required">
                  <label for="name" class="control-label col-md-4">Dirección del Local</label>
                  <div class="col-md-8">
                    <input type="text" class="form-control required" placeholder="Direccion del Local" name="ubicacion_local" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="name" class="control-label col-md-4">Inserte una Imágen</label>
                  <div class="col-md-8">
                      <input type="file" class="form-control required" name="imagen" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="name" class="control-label col-md-4">Descripción del Local</label>
                  <div class="col-md-8">
                      <input type="text" class="form-control" placeholder="Descripción del Local" name="descripcion_local" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="name" class="control-label col-md-4">Teléfono del Local</label>
                  <div class="col-md-8">
                      <input type="number" class="form-control" placeholder="Ingrese el Teléfono del Local" name="telefono_local" required>
                  </div>
                </div>

                <div class="form-group row required">
                  <label for="name" class="control-label col-md-4">Distrito</label>
                  <div class="col-md-8">
                    <select class="form-control" name="id_distrito" required>
                      @foreach ($distritos as $distrito)
                        <option value="{{ $distrito->id }}" name="{{ $distrito->nombre_distrito }}">
                            {{ $distrito->nombre_distrito}}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group row required">
                  <label for="name" class="control-label col-md-4">Tipo de Local</label>
                  <div class="col-md-8">
                    <select class="form-control" name="id_tipo_local" required>
                      @foreach ($tipo_locales as $tipo_local)
                        <option value="{{ $tipo_local->id }}" name="{{ $tipo_local->nombre_tipo_local }}">
                          {{ $tipo_local->nombre_tipo_local }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <a href="{{ url('/')}}" class="col-md-4 form-control btn btn-success" style=" color:white; text-align: center">
                      Cancelar
                    </a>
                  
                  <div class="col-md-4"></div>

                  <div class="col-md-4">
                    <button class="form-control btn btn-success" type="submit" style=" color:white; text-align: center"> 
                      Crear Local
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