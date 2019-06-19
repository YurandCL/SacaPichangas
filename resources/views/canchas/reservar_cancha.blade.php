@extends('layouts.app')

@section('content')
<script type="text/javascript" language="javascript">
    function validar_hora() {
        // alert('si entra');
        var hora_inicio          = 0;
        var hora_inicio_temprano = document.getElementById('hora_inicio_temprano').value;
        var hora_fin_temprano    = document.getElementById('hora_fin_temprano').value;
        var id_precio_temprano   = document.getElementById('id_precio_temprano').value;
        var precio_temprano   = document.getElementById('precio_temprano').value;

        var hora_inicio_tarde    = document.getElementById('hora_inicio_tarde').value;
        var hora_fin_tarde       = document.getElementById('hora_fin_tarde').value;
        var id_precio_tarde      = document.getElementById('id_precio_tarde').value;
        var precio_tarde      = document.getElementById('precio_tarde').value;

        hora_inicio = document.getElementById('select_hora_inicio').value;
        var suma = parseInt(hora_inicio) + 1;
        if (suma == 25){
            document.getElementById('select_hora_fin').value = 1;
            document.getElementById('hora_fin').value = 1;
        }else{
            document.getElementById('select_hora_fin').value = suma;
            document.getElementById('hora_fin').value = suma;
        }
        suma = suma - 1;
        if (suma >= parseInt(hora_inicio_temprano) && suma <= parseInt(hora_fin_temprano)) {
            document.getElementById('precio_mostrar').value = 'S/. '+precio_temprano+'.00';
            document.getElementById('precio').value = id_precio_temprano;
            // alert(id_precio_temprano);
        }else{
            document.getElementById('precio_mostrar').value = 'S/. '+precio_tarde+'.00';
            document.getElementById('precio').value = id_precio_tarde;
            // alert(id_precio_tarde);
        }        
    }
</script>

@foreach($precio_horas_temprano as $precio_hora_temprano)
    <input type="hidden" id="hora_inicio_temprano" value="{{$precio_hora_temprano->hora_inicio}}">
    <input type="hidden" id="hora_fin_temprano" value="{{$precio_hora_temprano->hora_fin}}">
    <input type="hidden" id="id_precio_temprano" value="{{$precio_hora_temprano->id}}">
    <input type="hidden" id="precio_temprano" value="{{$precio_hora_temprano->precio}}">
@endforeach

@foreach($precio_horas_tarde as $precio_hora_tarde)
    <input type="hidden" id="hora_inicio_tarde" value="{{$precio_hora_tarde->hora_inicio}}">
    <input type="hidden" id="hora_fin_tarde" value="{{$precio_hora_tarde->hora_fin}}">
    <input type="hidden" id="id_precio_tarde" value="{{$precio_hora_tarde->id}}">
    <input type="hidden" id="precio_tarde" value="{{$precio_hora_tarde->precio}}">
@endforeach

<div class="container">
    <div class="d-flex justify-content-center">
        <div class="col-sm-8 col-md-8">
            <div class="card bg-success">
                <div class="card-header">
                    <h3 class="card-title text-white">Reserva</h3>
                </div>
                <div class="card-body bg-light">
                    @foreach ($canchas as $cancha)
                        <div class="form-group row required">
                            <label class="col-md-3">Cancha nro:</label>
                            <input disabled 
                                class="form-control col-md-4" 
                                type="text" 
                                name="nombre_local" 
                                value="{{ $cancha->nro_cancha }}"
                            >
                            <div class="col-md-5 mb-5">
                                <div class="mr-3" style="position: absolute;">
                                    <img 
                                        class="img-fluid rounded mb-4 mb-lg-0" 
                                        src="{{ $cancha->ruta_imagen_cancha }}" 
                                        alt="cancha"
                                    >
                                </div>
                            </div>
                        </div>

                        @foreach ($locales as $local)
                            <div class="form-group row required">
                                <label class="col-md-3">Local:</label>
                                <input disabled 
                                    class="form-control col-md-4" 
                                    type="text" 
                                    name="nombre_local" 
                                    value="{{ $local->nombre_local }}"
                                >
                            </div>
                        @endforeach

                        <div class="form-group row required">
                            <label class="col-md-3">Usuario: </label>
                            <input disabled 
                                class="form-control col-md-4" 
                                type="text" 
                                name="nombre_usuario" 
                                value="{{ Auth::user()->name }} {{ Auth::user()->apellido}}"
                            >
                        </div>

                    <form action="/reservar-cancha" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" required>
                        <input type="hidden" name="id_cancha" value="{{ $cancha->id }}" required>
                        @endforeach

                        <div class="form-group row required">
                            <label class="col-md-3">Fecha:</label>
                            <input class="form-control col-md-4" type="date" name="fecha_reserva" required>
                        </div>

                            <div class="form-group row required">
                                <label class="col-md-3">Hora Inicio:</label>
                                <select 
                                    id="select_hora_inicio" 
                                    class="form-control col-md-4" 
                                    name="hora_inicio" 
                                    required 
                                    onchange="validar_hora();"
                                >
                                    <option selected value="8">8:00</option>
                                    <option value="9">9:00</option>
                                    <option value="10">10:00</option>
                                    <option value="11">11:00</option>
                                    <option value="12">12:00</option>
                                    <option value="13">13:00</option>
                                    <option value="14">14:00</option>
                                    <option value="15">15:00</option>
                                    <option value="16">16:00</option>
                                    <option value="17">17:00</option>
                                    <option value="18">18:00</option>
                                    <option value="19">19:00</option>
                                    <option value="20">20:00</option>
                                    <option value="21">21:00</option>
                                    <option value="22">22:00</option>
                                    <option value="23">23:00</option>
                                    <option value="24">24:00</option>
                                </select>

                                <label class="col-md-2">Hora Fin:</label>
                                <select id="select_hora_fin" 
                                    class="form-control col-md-3"
                                    required
                                    disabled
                                >
                                    <option selected value="9">9:00</option>
                                    <option value="10">10:00</option>
                                    <option value="11">11:00</option>
                                    <option value="12">12:00</option>
                                    <option value="13">13:00</option>
                                    <option value="14">14:00</option>
                                    <option value="15">15:00</option>
                                    <option value="16">16:00</option>
                                    <option value="17">17:00</option>
                                    <option value="18">18:00</option>
                                    <option value="19">19:00</option>
                                    <option value="20">20:00</option>
                                    <option value="21">21:00</option>
                                    <option value="22">22:00</option>
                                    <option value="23">23:00</option>
                                    <option value="24">24:00</option>
                                    <option value="1">01:00</option>
                                </select>

                                <input type="hidden" id="hora_fin" name="hora_fin" required>
                            </div>

                        <div class="form-group row required">
                            
                            <label class="col-md-3">Precio:</label>
                            
                            <input id="precio_mostrar" 
                                class="form-control col-md-4" 
                                type="text" 
                                name="precio_mostrar" 
                                value="S/. 50.00" 
                                required 
                                disabled
                            >

                            <input type="hidden" 
                                id="precio" 
                                name="id_precio_hora" 
                                required
                                value=1
                            >

                        </div>

                        <div class="form-group row validate-input m-b-18">
                            <label for="imagen" class="control-label col-md-3">Ingrese la imágen del Boucher:</label>
                            <div class="custom-file col-md-7 ml-3">
                                <input type="file" class="custom-file-input" id="validatedCustomFile" name="imagen" required>
                                <label class="custom-file-label" for="validatedCustomFile">Seleccionar archivo...</label>
                                <div class="invalid-feedback">Seleccione un archivo porfavor</div>
                            </div>
                            <span class="focus-input100"></span>
                        </div>

                        <div class="form-group row">
                            
                            <div class="col-md-3"></div>

                            <a href="{{ url('/')}}" 
                                class="col-md-2 btn btn-danger" 
                                style=" color:white; text-align: center" 
                                onclick="return confirm('¿Está seguro de Regresar? Se perderan todos los datos')"
                            >
                                Cancelar
                            </a>
                            
                            <div class="col-md-2"></div>

                            <input class="col-md-2 btn btn-success" 
                                type="submit" 
                                role="button" 
                                value="Reservar"
                            >

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
