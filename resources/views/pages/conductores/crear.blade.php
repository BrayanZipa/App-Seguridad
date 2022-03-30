@extends('themes.lte.layout')

@section('titulo')
    Conductores
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('assets/lte/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(function() {

            //Permite que a los select de selección de EPS y ARL se les asigne una barra de búsqueda haciendolos más dinámicos
            function activarSelect2Conductor() {
                $('#selectEps').select2({
                theme: 'bootstrap4',
                placeholder: 'Seleccione EPS',
                language: {
                    noResults: function() {
                    return "No hay resultado";        
                    }}
                });
                $('#selectArl').select2({
                    theme: 'bootstrap4',
                    placeholder: 'Seleccione ARL',
                    language: {
                    noResults: function() {
                    return "No hay resultado";        
                    }}
                });            
            }
            
            //Permite que a los select de selección Tipo de vehículo y Marca de vehículo se les asigne una barra de búsqueda haciendolos más dinámicos            
            function activarSelect2Vehiculo() {
                $('#selectTipoVehiculo').select2({
                    theme: 'bootstrap4',
                    placeholder: 'Seleccione el tipo',
                    language: {
                    noResults: function() {
                    return "No hay resultado";        
                    }}
                });
                $('#selectMarcaVehiculo').select2({
                    theme: 'bootstrap4',
                    placeholder: 'Seleccione la marca',
                    language: {
                    noResults: function() {
                    return "No hay resultado";        
                    }}
                });
            }

            activarSelect2Conductor();
            activarSelect2Vehiculo();

            //Botón que limpia la información del formulario de Conductor
            $('#botonLimpiar').click(function() {
                $('#botonActivar').trigger("click");
                $('.conductor').each(function(index) {
                    $(this).val('');
                });
                activarSelect2Conductor();
            });

            //Botón que da acceso a la cámara web del computador donde este abierta la aplicación desde el formulario crear conductor
            $('#botonActivar').click(function() {
                document.getElementById('canvas').style.display = 'none';
                document.getElementById('inputFoto').setAttribute('value', '');
                const video = document.getElementById("video");

                if (!tieneSoporteUserMedia()) {
                    alert("Lo siento. Tu navegador no soporta esta característica");
                    return;
                }

                const constraints = {
                    audio: false,
                    video: true
                };

                navigator.mediaDevices.getUserMedia(constraints)
                    .then((stream) => {                       
                        video.style.display = 'block';
                        video.style.borderStyle = "solid";
                        video.style.borderWidth = "1px";
                        video.style.borderColor = "#007bff";

                        video.srcObject = stream;
                        video.play(); 

                        document.getElementById('botonCapturar').style.display = 'inline';                      
                    })
                    .catch((err) => console.log(err))            
            });

            // Función que permite saber si el navegador que se esta utilizando soporta características audio visuales
            function tieneSoporteUserMedia() {
                return !!(navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) ||
                navigator.webkitGetUserMedia || navigator.msGetUserMedia)
            }

            //Botón que captura una fotografía desde el formulario de crear visitante con la cámara web del computador donde este abierta la aplicación
            $('#botonCapturar').click(function() {
                var video = document.getElementById("video");
                video.pause();
                var canvas = document.getElementById("canvas");
                var contexto = canvas.getContext("2d");
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                contexto.drawImage(video, 0, 0, canvas.width, canvas.height); 

                var foto = canvas.toDataURL();
                document.getElementById('inputFoto').setAttribute('value', foto);  
            });

            $('.botonContinuar').click(function() {
                //http://127.0.0.1:8000/conductores
                $(location).attr('href', "{{ route('mostrarConductores') }}");
            });

            // Muestra un modal con los diferentes errores cometidos por el usuario a la hora de ingresar un visitante
            $('#modal-errores-personas').modal("show");
            
        });
    </script>
@endsection

@section('contenido')
    <div class="content mb-n2">
        @include('pages.conductores.header')
    </div>
    
    <section class="content-header">
        <div class="row">
            <div class="col-md-12">

                {{-- <form id="formularioConductor" action="{{ route('crearConductor') }}" method="POST"> --}}
                <form action="{{ route('crearConductor') }}" method="POST">           
                    @csrf

                    <div>
                        @include('pages.conductores.formularioCrear')
                    </div>
                    

                    {{-- <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Crear nuevo conductor</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="inputNombre">Ingrese el nombre</label>
                                        <input type="text" class="form-control" id="inputNombre" name="nombre"
                                            placeholder="Nombre" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="inputApellido">Ingrese el apellido</label>
                                        <input type="text" class="form-control" id="inputApellido" name="apellido"
                                            placeholder="Apellido" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="inputIdentificacion">Ingrese la identificación</label>
                                        <input type="text" class="form-control" id="inputIdentificacion"
                                            name="identificacion" placeholder="Identificación" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="inputTelefono">Ingrese el teléfono</label>
                                        <input type="tel" class="form-control" id="inputTelefono" name="tel_contacto"
                                            placeholder="Teléfono" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Ingrese la EPS</label>
                                        <select class="form-control select2" style="width: 100%;" name="id_eps" required>
                                            <option selected="selected" value="" disabled>Seleccione EPS</option>
                                            @foreach ($eps as $ep)
                                                <option value="{{ $ep->id_eps }}">{{ $ep->eps }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Ingrese el ARL</label>
                                        <select class="form-control select2" style="width: 100%;" name="id_arl" required>
                                            <option selected="selected" value="" disabled>Seleccione ARL</option>
                                            @foreach ($arl as $ar)
                                                <option value="{{ $ar->id_arl }}">{{ $ar->arl }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type='submit' class="btn btn-primary">Crear conductor</button>
                            <button type='reset' class="btn btn-secondary">Limpiar</button>
                        </div>
                        <!-- /.card-footer-->
                    </div> --}}
                    <!-- /.card -->

                </form> 
            </div>
        </div>

        {{-- @include('pages.conductores.modales') --}}
        @include('pages.modalError')

    </section>
@endsection

