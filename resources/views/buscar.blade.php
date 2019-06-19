@extends('layouts.app')

@section('content')
<br><br><br>
  <!-- Page Content -->
  <div class="container">

      <div class="row">
        @foreach ($canchas as $cancha)
          <div class="col-md-4 mb-5">
            <div class="card h-100">
              <div class="card-header bg-success">
                <h3 class="card-title text-white">{{ $cancha->id_cancha }}</h3>
              </div>
              <div class="card-body">
                <p class="card-text">{{ $cancha->descripcion_cancha }}</p>
                <img class="img-fluid rounded mb-4 mb-lg-0" src="{{ $cancha->ruta_imagen_cancha }}" alt="cancha">
              </div>
              <div class="card-footer">
                <a href="{{ url('/buscar') }}" class="btn btn-success btn-sm">Reservar</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      @if (count($canchas))
        {{ $canchas->render() }}
      @endif

    </div>
    <!-- /.row -->

  @endsection
