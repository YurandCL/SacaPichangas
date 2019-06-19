@extends('layouts.app')

@section('content')
<div class="container">
	<div class="card bg-success">
		@foreach ($locales as $local)
			<div class="card-header" style="color: white;">
				<h3 class="card-title">
					{{ $local->nombre_local }}
				</h3>
			</div>
			<div class="card-body bg-light">
				<div class="row form-group">
					<label class="control-label col-md-4">Distrito: </label>
					@foreach ($distritos as $distrito)
					<div class="col-md-4">
						<label > {{ $distrito->nombre_distrito }}</label>
					</div>
					@endforeach
					<div class="col-md-4 mb-5">
                        <div class="mr-3" style="position: absolute;">
                            <img class="img-fluid rounded mb-4 mb-lg-0" src="{{ $local->ruta_imagen_local }}" alt="local">
                        </div>
	                </div>
				</div>
				<div class="row form-group">
					<label class="col-md-4">Descripcion: </label>
					<label class="col-md-4"> {{ $local->descripcion_local }}</label>
				</div>
				<div class="row form-group">
					<label class="col-md-4">Ubicación del Local: </label>
					<label class="col-md-4"> {{ $local->ubicacion_local }}</label>
				</div>
				<div class="row form-group">
					<label class="col-md-4">Teléfono del Local: </label>
					<label class="col-md-4"> {{ $local->telefono }}</label>
				</div>
				<div class="row form-group">
					<label class="col-md-4">Dueño del Local: </label>
					@foreach ($usuarios as $usuario)
					<label class="col-md-4"> {{ $usuario->name }} {{ $usuario->apellido }}</label>
					@endforeach
				</div>
			</div>
		@endforeach
	</div>

	<br>
<?php $i = 0 ?>
	<div class="row">
        @foreach ($canchas as $cancha)
        	<?php $i += 1 ?>
	        <div class="col-md-4 mb-5">
	            <div class="card h-100">
	        	    <div class="card-header bg-success">
	            	    <h3 class="card-title text-white">{{ $cancha->descripcion_cancha }}</h3>
	              	</div>
	              	<div class="card-body">
	              		@foreach ($tipo_canchas as $tipo_cancha)
	                		@if ($cancha->id_tipo_cancha == $tipo_cancha->id)
	                			<p class="card-text">Tipo de cancha: {{ $tipo_cancha->nombre_tipo_cancha }}</p>
	                		@endif
	                	@endforeach
	                	<img class="img-fluid rounded mb-4 mb-lg-0" src="{{ $cancha->ruta_imagen_cancha }}" alt="cancha">
	              	</div>
	              	<div class="card-footer">
		                <form method="post" action="/reservar">
		                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
		                  <input type="hidden" name="id_cancha" value="{{ $cancha->id }}">
		                  <input type="hidden" name="id_local" value="{{ $id_local }}">
		                  <input type="submit" role="button" value="Reservar" class="btn btn-success">
		                </form>
	              	</div>
	    	    </div>
	        </div>
        @endforeach
    </div>

    @if ($i <= 0)
    	<div class="card card-body bg-danger text-center text-white">
	        <h5>Este Local no tiene ninguna cancha lista para alquilar, Lamentamos los inconvenientes.</h5>
	    </div>
    @endif
</div>
@endsection