@extends('themes.lte.layout')

@section('titulo')
    Visitantes
@endsection

@section('css')
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('assets/lte/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(function() {

            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

            //Permite que a los select de selección de EPS y ARL se les asigne una barra de búsqueda haciendolos más dinámicos
            function activarSelect2Visitante() {
                $('#selectEps').select2({
                theme: 'bootstrap4',
                placeholder: 'Seleccione EPS'
                });
                $('#selectArl').select2({
                    theme: 'bootstrap4',
                    placeholder: 'Seleccione ARL'
                });            
            }    
            
            //Permite que a los select de selección Tipo de vehículo y Marca de vehículo se les asigne una barra de búsqueda haciendolos más dinámicos            
            function activarSelect2Vehiculo() {
                $('#selectTipoVehiculo').select2({
                    theme: 'bootstrap4',
                    placeholder: 'Seleccione el tipo'
                });
                $('#selectMarcaVehiculo').select2({
                    theme: 'bootstrap4',
                    placeholder: 'Seleccione la marca'
                });
            }

            activarSelect2Visitante();
            activarSelect2Vehiculo();
            
            //Manejo de los checkbox al ser seleccionados y control de la vista de formularios   
            $('input[type=checkbox]').on('change', function() {
                if ($('#checkVehiculo').is(":checked") && $('#checkActivo').is(":checked")) {                  
                    $('#botonComprimirVisitante').trigger("click");
                    $('#crearVehiculo').css("display", "block");
                    $('#crearActivo').css("display", "block");
                    $('#botonCrear2').css("display", "none");
                    $('#checkVehiculo').prop("disabled", true);
                    $('#checkActivo').prop("disabled", true);
                    $('#casoIngreso').val("casoVehiculoActivo");
                    requiredTrue('.vehiculo');
                    requiredTrue('.activo');
                    

                } else if ($('#checkVehiculo').is(":checked") && ($('#checkActivo').prop("checked") ==
                        false)) {
                    $('#crearVehiculo').css("display", "block");
                    $('#botonCrear').css("display", "none");
                    $('#botonCrear2').css("display", "inline");
                    $('#checkVehiculo').prop("disabled", true);
                    $('#casoIngreso').val("casoVehiculo");
                    requiredTrue(".vehiculo");

                } else if ($('#checkActivo').is(":checked") && ($('#checkVehiculo').prop("checked") ==
                        false)) {
                    $('#crearActivo').css("display", "block");
                    $('#botonCrear').css("display", "none");
                    $('#checkActivo').prop("disabled", true);
                    $('#casoIngreso').val("casoActivo");
                    requiredTrue('.activo');
                }
            });

            //Manejo del botón eliminar del formulario de Vehiculo
            $('#botonCerrar2').click(function() {
                if ($('#crearActivo').is(":visible")) {
                    $('#botonComprimirVisitante').trigger("click");
                    $('#casoIngreso').val("casoActivo");
                } else {
                    $('#botonCrear').css("display", "inline");
                    $('#casoIngreso').val("");
                }
                $('#crearVehiculo').css("display", "none");
                $('#botonLimpiar2').trigger("click");
                $('#checkVehiculo').prop('disabled', false);
                $('#checkVehiculo').prop("checked", false);
                requiredFalse('.vehiculo');
            });

            //Manejo del botón eliminar del formulario de Activo
            $('#botonCerrar3').click(function() {
                if ($('#crearVehiculo').is(":visible")) {
                    $('#botonComprimirVisitante').trigger("click");
                    $('#botonCrear2').css("display", "inline");
                    $('#casoIngreso').val("casoVehiculo");
                } else {
                    $('#botonCrear').css("display", "inline");
                    $('#casoIngreso').val("");
                }
                $('#crearActivo').css("display", "none");
                $('#botonLimpiar3').trigger("click");
                $('#checkActivo').prop('disabled', false);
                $('#checkActivo').prop("checked", false);
                requiredFalse('.activo');
            });

            //Botón que limpia la información del formulario de Visitante
            $('#botonLimpiar').click(function() {
                $('#botonActivar').trigger("click");
                $('.visitante').each(function(index) {
                    $(this).val('');
                });
                activarSelect2Visitante();
            });

            //Botón que limpia la información del formulario de Vehículo
            $('#botonLimpiar2').click(function() {
                $('#inputFotoVehiculo').val('');
                $('#video2').css("display", "none");
                $('#botonCapturar2').css("display", "none");
                $('.vehiculo').each(function(index) {
                    $(this).val('');
                });
                $('#selectMarcaVehiculo').val([]);
                activarSelect2Vehiculo();
            });

            //Botón que limpia la información del formulario de Activo
            $('#botonLimpiar3').click(function() {
                $('.activo').each(function(index) {
                    $(this).val('');
                });
            });

            //Al iniciar la página inhabilita la propiedad required de los formularios de Vehiculo y Activo mientras no son seleccionados por el usuario
            if ($('#crearVehiculo').is(":hidden") && $('#crearActivo').is(":hidden")) {
                requiredFalse('.vehiculo');
                requiredFalse('.activo')
            }

            //Función que permite volver verdadera la propiedad required de los formularios  
            function requiredTrue(clase) {
                $(clase).each(function(index) {
                    $(this).prop("required", true);
                });
            }

            //Función que permite volver falsa la propiedad required de los formularios
            function requiredFalse(clase) {
                $(clase).each(function(index) {
                    $(this).prop("required", false);
                });
            }

            // Muestra los modales dependiendo de los formularios que se hayan ingresado y redirecciona en caso de que se oprima el botón continuar
            $('#modal-crear-visitante').modal("show");
            $('#modal-crear-visitanteVehiculo').modal("show");
            $('#modal-crear-visitanteActivo').modal("show");
            $('#modal-crear-visitanteVehiculoActivo').modal("show");

            $('.botonContinuar').click(function() {
                //http://app-seguridad.test/visitantes
                //http://127.0.0.1:8000/visitantes
                $(location).attr('href', "{{ route('mostrarVisitantes') }}");
            });

            // Muestra un modal con los diferentes errores cometidos por el usuario a la hora de ingresar un visitante
            $('#modal-errores-personas').modal("show");

            //Botón que da acceso a la cámara web del computador donde este abierta la aplicación desde el formulario crear visitante
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

            //Botón que da acceso a la cámara web del computador donde este abierta la aplicación desde el formulario ingresar vehículo
            $('#botonActivar2').click(function() {
                document.getElementById('canvas2').style.display = 'none';
                document.getElementById('inputFotoVehiculo').setAttribute('value', '');
                const video = document.getElementById("video2");

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
                        video.style.borderColor = "#fd7e14";

                        video.srcObject = stream;
                        video.play(); 

                        document.getElementById('botonCapturar2').style.backgroundColor = 'rgb(255, 115, 0)'; 
                        document.getElementById('botonCapturar2').style.display = 'inline';                      
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

            //Botón que captura una fotografía desde el formulario de crear vehículo con la cámara web del computador donde este abierta la aplicación
            $('#botonCapturar2').click(function() {
                var video = document.getElementById("video2");
                video2.pause();
                var canvas = document.getElementById("canvas2");
                var contexto = canvas2.getContext("2d");
                canvas2.width = video2.videoWidth;
                canvas2.height = video2.videoHeight;
                contexto.drawImage(video, 0, 0, canvas2.width, canvas2.height); 

                var foto = canvas2.toDataURL();
                document.getElementById('inputFotoVehiculo').setAttribute('value', foto);  
            });

            // Botón que devuelve la fotografía tomanda con anterioridad por el usuario en caso de que se cometa un error en el ingreso de datos
            $('.botonError').click(function() {
                var inputFoto = document.getElementById('inputFoto').value;
                var inputFotoVehiculo = document.getElementById('inputFotoVehiculo').value;

                var video = document.getElementById("video");
                var canvas = document.getElementById("canvas");
                var contexto = canvas.getContext("2d");               
                var video2 = document.getElementById("video2");
                var canvas2 = document.getElementById("canvas2");
                var contexto2 = canvas2.getContext("2d");

                canvas.setAttribute("width", "640");
                canvas.setAttribute("height", "480");
                canvas2.setAttribute("width", "640");
                canvas2.setAttribute("height", "480");

                var imagen = new Image();
                var imagen2 = new Image();
                imagen.src = inputFoto;
                imagen2.src = inputFotoVehiculo;

                imagen.onload=function() {
                    document.getElementById('canvas').style.display = 'block';
                    document.getElementById('canvas2').style.display = 'block';
                    contexto.drawImage(imagen, 0, 0, imagen.width, imagen.height);
                    contexto2.drawImage(imagen2, 0, 0, imagen2.width, imagen2.height);
                }
            });

        });
    </script>
@endsection

@section('contenido')
    <div class="content mb-n2">
        @include('pages.visitantes.header')
    </div>

    <section class="content-header">
        <div class="row">
            <div class="col-md-12">
                {{-- <form id="formularioVisitante" action="{{ route('crearVisitante') }}" method="POST">
                    @csrf --}}
                <div>
                    @include('pages.visitantes.formularioCrear')
                </div>

                <div id="crearVehiculo" style="display:none">
                    @include('pages.formCrearVehiculo')
                </div>

                <div id="crearActivo" style="display: none">
                    @include('pages.formCrearActivo')
                </div>
                {{-- </form> --}}
            </div>
        </div>

        @include('pages.visitantes.modales')
        @include('pages.modalError')

    </section>
@endsection