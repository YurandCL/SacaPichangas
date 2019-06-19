@extends('layouts.app')

@section('content') 
<div class="container">
    <div class="card bg-success">
        @foreach ($canchas as $cancha)
        <div class="card-header">
            <h3 class="card-title text-white">
                Esta es la información de la cancha {{ $cancha->nro_cancha }}
            </h3>
        </div>

        <div class="card-body bg-light">
            <div class="form-group row">
                <label for="name" class="control-label col-md-4">Local:</label>
                <div class="col-md-4">
                    @foreach ($locales as $local)
                        @if ($local->id == $cancha->id_local)
                            <label>{{ $local->nombre_local }}</label>
                        @endif
                    @endforeach
                </div>
                <div class="col-md-4 mb-5">
                    <div class="h-100">
                        <div class="" style="position: absolute;">
                            <img class="img-fluid rounded mb-4 mb-lg-0" src="{{ $cancha->ruta_imagen_cancha }}" alt="cancha">
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <div class="form-group row">
                <label for="name" class="control-label col-md-4">Descripción:</label>
                <div class="col-md-8">
                    <label>{{ $cancha->descripcion_cancha }}</label>
                </div>
            </div>

            <br>

            <div class="form-group row">
                <label for="name" class="control-label col-md-4">Número de Cancha:</label>
                <div class="col-md-8">
                    <label>{{ $cancha->nro_cancha }}</label>
                </div>
            </div>

            <br>

            <div class="form-group row">
                <label for="name" class="control-label col-md-4">Tipo de cancha:</label>
                <div class="col-md-4">
                    @foreach ($tipo_canchas as $tipo_cancha)
                        @if ($tipo_cancha->id == $cancha->id_tipo_cancha)
                            <label>{{ $tipo_cancha->nombre_tipo_cancha }}</label>
                        @endif
                    @endforeach
                </div>
            </div>

            <br>

        </div>
        @endforeach
    </div>
<br>
    <div class="card bg-success">
        <div class="card-header">
            <h3 class="card-title text-white">Reservas en esta cancha</h3>
        </div>
        <div class="card-body bg-light">
            @foreach ($reservas as $reserva)
                <div class="card bg-success">
                    <div class="card-header">
                        <h5 class="card-title text-white">{{ $reserva->name }} {{ $reserva->apellido}}</h5>
                    </div>
                    <div class="card-body bg-light">
                        <div class="col-md-8 form-group row">
                            <label for="hora" class="col-md-4">Hora de reserva:</label>
                            <label for="hora" class="col-md-6">Desde: {{ $reserva->hora_inicio }}:00 hasta: {{ $reserva->hora_fin }}:00</label>
                        </div>

                        <div class="col-md-8 form-group row">
                            <label for="hora" class="col-md-4">Dia de reserva:</label>
                            <label for="hora" class="col-md-6">{{ $reserva->fecha_reserva }}</label>
                        </div>

                        <div class="col-md-8 form-group row">
                            <label for="hora" class="col-md-4">Teléfono del usuario:</label>
                            <label for="hora" class="col-md-6">{{ $reserva->celular}}</label>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection