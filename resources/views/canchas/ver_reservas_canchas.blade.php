@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card bg-success">
        <div class="card-header text-white">
            <h3 class="card-title">Aqui puedes ver tus reservas hasta el momento</h3>
        </div>
        <div class="card-body bg-light">
            @foreach ($reservas as $reserva)
                <div class="card bg-success">
                    <div class="card-header">
                        <h4 class="card-title text-white">{{ $reserva->nombre_local }}</h4>
                    </div>
                    <div class="card-body bg-light">

                        <div class="form-group row">
                            <label for="hora" class="col-md-4">Cancha reservada:</label>
                            <label for="hora" class="col-md-4">{{ $reserva->descripcion_cancha }}</label>
                        </div>

                        <div class="form-group row">
                            <label for="hora" class="col-md-4">Número de Cancha reservada:</label>
                            <label for="hora" class="col-md-4">{{ $reserva->nro_cancha }}</label>
                        </div>

                        <div class="form-group row">
                            <label for="hora" class="col-md-4">Hora reservada:</label>
                            <label for="hora" class="col-md-4">Desde las: {{ $reserva->hora_inicio }} hasta las: {{ $reserva->hora_fin }}</label>
                        </div>

                        <div class="form-group row">
                            <label for="fecha" class="col-md-4">Dia reservado:</label>
                            <label for="fecha" class="col-md-4">{{ $reserva->fecha_reserva }}</label>
                        </div>

                        <div class="form-group row">
                            <label for="hora" class="col-md-4">Boucher de Pago:</label>
                            <div class="col-md-8">
                                <img class="img-fluid rounded mb-4 mb-lg-0" src="/images/reserva/{{$reserva->ruta_imagen_reserva}}" alt="boucher">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection