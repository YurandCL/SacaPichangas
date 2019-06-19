@extends('layouts.app')

@section('content')
<div class="container">
  <div class="d-flex justify-content-center">
    <div class="col-sm-6 col-md-6">
        <div class="card bg-success">
          <div class="card-header">
            <h3 class="text-white">
              Edita tu Cancha
            </h3>
          </div>
            <div class="card-body bg-light">
                <form method="post" action="{{ url('/editar-cancha') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" required>

                    @foreach ($canchas as $cancha)
                    <input type="hidden" name="id_cancha" value="{{ $cancha->id }}" required>
                      <div class="form-group row required">
                        <label for="name" class="control-label col-md-4">Descripción</label>
                        <div class="col-md-8">
                          <input id="descripcion_cancha" type="text" class="form-control" placeholder="Descripcion de la Cancha" name="descripcion_cancha" value="{{ $cancha->descripcion_cancha }}" required>
                        </div>
                      </div>

                      <div class="form-group row required">
                        <label for="name" class="control-label col-md-4">Número de cancha</label>
                        <div class="col-md-8">
                          <input id="nro_cancha" type="text" class="form-control" placeholder="Numero de Cancha" name="nro_cancha" value="{{ $cancha->nro_cancha }}" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="name" class="control-label col-md-4">Imagen acutal</label>
                        <div class="col-md-8">
                            <img class="img-fluid rounded mb-4 mb-lg-0" src="{{ $cancha->ruta_imagen_cancha }}">
                        </div>
                      </div>

                      <div class="form-group row validate-input m-b-18">
                        <label for="imagen" class="control-label col-md-4">Seleccione su nueva imágen:</label>
                        <div class="custom-file col-md-7 ml-3">
                          <input type="file" class="custom-file-input" id="validatedCustomFile" name="imagen">
                          <label class="custom-file-label" for="validatedCustomFile">Seleccionar archivo...</label>
                          <div class="invalid-feedback">Seleccione un archivo porfavor</div>
                        </div>
                        <span class="focus-input100"></span>
                      </div>

                      <div class="form-group row required">
                        <label for="name" class="control-label col-md-4">Tipo de Cancha</label>
                        <div class="col-md-8">
                          <select class="form-control" name="id_tipo_cancha" required>
                            @foreach ($tipo_canchas as $tipo_cancha)
                              @if ($cancha->id_tipo_cancha == $tipo_cancha->id)
                                <option selected value="{{ $tipo_cancha->id }}">
                                  {{ $tipo_cancha->nombre_tipo_cancha}}
                                </option>
                              @else
                                <option value="{{ $tipo_cancha->id }}">
                                  {{ $tipo_cancha->nombre_tipo_cancha}}
                                </option>
                              @endif
                            @endforeach
                          </select>
                        </div>
                      </div>
                    @endforeach

                    <div class="form-group row">
                      <a href="{{ url('/canchas')}}" class="col-md-4 form-control btn btn-danger" style=" color:white; text-align: center">
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