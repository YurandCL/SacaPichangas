@extends('layouts.app')

@section('content')
<div class="container">
  <div class="d-flex justify-content-center">
    <div class="col-sm-8 col-md-8">
        <div class="card bg-success">
          <div class="card-header">
            <h3 class="text-white">
              Edita tu Perfil
            </h3>
          </div>
          <div class="card-body bg-light">
              <form method="post" action="{{ url('/editar-perfil') }}" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" required>
                  @foreach ($usuarios as $usuario)
                    <input type="hidden" name="id_usuario" value="{{ $usuario->id }}" required>
                    <div class="form-group row required">
                      <label for="name" class="control-label col-md-4">Nombre</label>
                      <div class="col-md-8">
                        <input id="nombre_usuario" type="text" class="form-control" placeholder="Nombre" name="nombre_usuario" value="{{ $usuario->name }}" required>
                      </div>
                    </div>

                    <div class="form-group row required">
                      <label for="apellido" class="control-label col-md-4">Apellidos</label>
                      <div class="col-md-8">
                        <input id="apellido_usuario" type="text" class="form-control" placeholder="Apellidos" name="apellido_usuario" value="{{ $usuario->apellido }}" required>
                      </div>
                    </div>

                    <div class="form-group row required">
                      <label for="name" class="control-label col-md-4">Correo Electrónico</label>
                      <div class="col-md-8">
                        <input id="email" type="text" class="form-control" placeholder="Correo Electrónico" name="email" value="{{ $usuario->email }}" required>
                      </div>
                    </div>

                    <div class="form-group row required">
                      <label for="name" class="control-label col-md-4">Celular</label>
                      <div class="col-md-8">
                        <input id="celular" type="number" class="form-control" placeholder="Número de Celular" name="celular" value="{{ $usuario->celular }}" required>
                      </div>
                    </div>

                    <div class="form-group row required">
                      <label for="name" class="control-label col-md-4">Nombre de Usuario</label>
                      <div class="col-md-8">
                        <input id="usuario" type="text" class="form-control" placeholder="Nombre de Usuario" name="usuario" value="{{ $usuario->usuario }}" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="name" class="control-label col-md-4">Imagen acutal</label>
                      <div class="col-md-8">
                          <img class="img-fluid rounded mb-4 mb-lg-0" src="/images/usuarios/{{ $usuario->ruta_imagen_usuario }}">
                      </div>
                    </div>

                    <!-- <div class="form-group row">
                      <label for="imagen" class="control-label col-md-4">Seleccione su nueva imagen</label>
                      <div class="col-md-8 custom-file">
                          <input type="file" class="custom-file-input" name="imagen">
                      </div>
                    </div> -->
                    <div class="form-group row validate-input m-b-18">
                      <label for="imagen" class="control-label col-md-4">Seleccione su nueva imágen:</label>
                      <div class="custom-file col-md-7 ml-3">
                        <input type="file" class="custom-file-input" id="validatedCustomFile" name="imagen" required>
                        <label class="custom-file-label" for="validatedCustomFile">Seleccionar archivo...</label>
                        <div class="invalid-feedback">Seleccione un archivo porfavor</div>
                      </div>
                      <span class="focus-input100"></span>
                    </div>


                    <div class="form-group row">
                      <a href="{{ url('/principal')}}" class="col-md-4 form-control btn btn-danger" style=" color:white; text-align: center">
                        Cancelar
                      </a>

                      <div class="col-md-4"></div>
                      
                      <div class="col-md-4">
                        <button class="form-control btn btn-success" type="submit" style=" color:white; text-align: center"> 
                          Actualizar
                        </button>
                      </div>
                    </div>
                  @endforeach
              </form>
          </div>
        </div>
        <br>
        @if (auth()->user()->tipo_usuario == 'N')
          <div class="card">
            <a href="/crear-local" class="btn btn-sm btn-success form-control">Deseo ser un administrador</a>
          </div>
        @elseif (auth()->user()->tipo_usuario == 'A')
          <div class="card">
            <form method="post" action="/eliminar-local" onclick="return confirm('¿Está seguro de esto?')">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="id_usuario" value="{{ auth()->user()->id }}">
              <input type="submit" name="eliminar-local" value="Dejar de ser Administrador" class="btn btn-danger form-control">
            </form>
          </div>
        @endif
    </div>
  </div>
</div>
@endsection