@extends('themes.lte.layout')

@section('titulo')
    Visitantes
@endsection

@section('css')
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('scripts')
    <!-- Select2 -->
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

            activarSelect2Visitante();
            activarSelect2Vehiculo();
            
            //Manejo de los checkbox al ser seleccionados y control de la vista de formularios   
            $('input[type=checkbox]').on('change', function() {
                if ($('#checkVehiculo').is(":checked") && $('#checkActivo').is(":checked")) {                  
                    $('#botonComprimirVisitante').trigger("click");
                    $('#crearVehiculo').css("display", "block");
                    $('#crearActivo').css("display", "block");
                    $('#inputActivo').val("Computador");
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
                    $('#inputActivo').val("Computador");
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
                    if($(this).hasClass('is-invalid')){
                        $(this).removeClass("is-invalid");
                    }  
                });
                activarSelect2Visitante();
            });

            //Botón que limpia la información del formulario de Vehículo
            $('#botonLimpiar2').click(function() {
                document.getElementById('inputFotoVehiculo').setAttribute('value', '');
                $('#video2').css("display", "none");
                $('#canvas2').css("display", "none");
                $('#botonCapturar2').css("display", "none");
                $('.vehiculo').each(function(index) {
                    $(this).val('');
                    if($(this).hasClass('is-invalid')){
                        $(this).removeClass("is-invalid");
                    } 
                });
                $('#selectMarcaVehiculo').val([]);
                activarSelect2Vehiculo();
            });

            //Botón que limpia la información del formulario de Activo
            $('#botonLimpiar3').click(function() {
                $('.activo').each(function(index) {
                    $(this).val('');
                    if($(this).hasClass('is-invalid')){
                        $(this).removeClass("is-invalid");
                    } 
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

            //Botón que da acceso a la cámara web del computador donde este abierta la aplicación desde el formulario crear visitante
            $('#botonActivar').click(function() {
                var inputFoto = document.getElementById('inputFoto');
                if(inputFoto.classList.contains( 'is-invalid' )){
                    inputFoto.classList.remove('is-invalid');
                }
                document.getElementById('canvas').style.display = 'none';
                document.getElementById('inputFoto').setAttribute('value', '');
                const video = document.getElementById("video");

                if (!tieneSoporteUserMedia()) {
                    alert("Lo siento. Tu navegador no soporta esta característica");
                    return;
                }

                const constraints = {
                    audio: false,
                    video: {
                        width: 640, height: 600
                    }
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
                var inputFotoVehiculo = document.getElementById('inputFotoVehiculo');
                if(inputFotoVehiculo.classList.contains( 'is-invalid' )){
                    inputFotoVehiculo.classList.remove('is-invalid');
                }
                document.getElementById('canvas2').style.display = 'none';
                document.getElementById('inputFotoVehiculo').setAttribute('value', '');
                const video2 = document.getElementById("video2");

                if (!tieneSoporteUserMedia()) {
                    alert("Lo siento. Tu navegador no soporta esta característica");
                    return;
                }

                const constraints = {
                    audio: false,
                    video: {
                        width: 640, height: 480
                    }
                };

                navigator.mediaDevices.getUserMedia(constraints)
                    .then((stream) => {                       
                        video2.style.display = 'block';
                        video2.style.borderStyle = "solid";
                        video2.style.borderWidth = "1px";
                        video2.style.borderColor = "#fd7e14";

                        video2.srcObject = stream;
                        video2.play(); 

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
                var video2 = document.getElementById("video2");
                video2.pause();
                var canvas2 = document.getElementById("canvas2");
                var contexto2 = canvas2.getContext("2d");
                canvas2.width = video2.videoWidth;
                canvas2.height = video2.videoHeight;
                contexto2.drawImage(video2, 0, 0, canvas2.width, canvas2.height); 

                var foto = canvas2.toDataURL();
                document.getElementById('inputFotoVehiculo').setAttribute('value', foto); 
            });

            // Función que permite que al momento que el usuario seleccione Bicicleta en el formulario de ingreso de vehículo se desabilite el select de marca de vehículo
            function selectMarcaVehiculo() {
                var tipo = $('#selectTipoVehiculo option:selected').text();
                var tipoVehiculo = tipo.replace(/\s+/g, '');

                if( tipoVehiculo == "Bicicleta"){
                    $('#selectMarcaVehiculo').val('');
                    $('#selectMarcaVehiculo').prop('disabled', true);
                    $('#selectMarcaVehiculo').select2({
                        theme: 'bootstrap4',
                        placeholder: 'Seleccione la marca',
                        language: {
                            noResults: function() {
                                return "No hay resultado";
                            }
                        }
                    });        
                } else {
                    $('#selectMarcaVehiculo').prop('disabled', false);
                } 
            }

            //Función que se activa cuando el usuario selecciona alguna opción del select de marca de vehículo
            $('#selectTipoVehiculo').change(function() {
                selectMarcaVehiculo();
            });

            // Función anónima que genera mensajes de error cuando el usuario intenta enviar algún formulario del módulo visitantes sin los datos requeridos, es una primera validación del lado del cliente
            (function () {
                'use strict'
                var form = document.getElementById('formularioVisitante');
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();

                    $('.visitante, .vehiculo, .activo').each(function(index) {
                        if (!this.checkValidity()) {
                            $(this).addClass('is-invalid');
                        }
                    });
                    }
                }, false);
            })();

            //Si en un input del cualquier formulario del módulo visitantes esta la clase is-invalid al escribir en el mismo input se elimina esta clase 
            $('input.visitante, textarea.visitante, input.vehiculo, input.activo').keydown(function(event){
                if($(this).hasClass('is-invalid')){
                    $(this).removeClass("is-invalid");
                }     
            });

           //Si en un select del cualquier formulario del módulo visitantes esta la clase is-invalid al seleccionar algo en el mismo select se elimina esta clase 
            $( 'select.visitante, select.vehiculo' ).change(function() {
                if($(this).hasClass('is-invalid')){
                    $(this).removeClass("is-invalid");
                };   
            }); 

            // Función que permite mantener la fotografía tomada previamente al visitante en caso de que haya errores al enviar el formulario crear visitante
            function retornarFotoVisitante () {
                var inputFoto = document.getElementById('inputFoto').value;
                var video = document.getElementById("video");
                var canvas = document.getElementById("canvas");
                var contexto = canvas.getContext("2d");

                canvas.setAttribute("width", "640");
                canvas.setAttribute("height", "600");

                canvas.style.borderStyle = "solid";
                canvas.style.borderWidth = "1px";
                canvas.style.borderColor = "#007bff";

                var imagen = new Image();
                imagen.src = inputFoto;

                imagen.onload=function() {
                    document.getElementById('canvas').style.display = 'block';           
                    contexto.drawImage(imagen, 0, 0, imagen.width, imagen.height);
                }
            }

            //Función que permite mantener la fotografía tomada previamente al vehículo en caso de que haya errores al enviar el formulario crear vehículo
            function retornarFotoVehiculo () {
                var inputFotoVehiculo = document.getElementById('inputFotoVehiculo').value;              
                var video2 = document.getElementById("video2");
                var canvas2 = document.getElementById("canvas2");
                var contexto2 = canvas2.getContext("2d");

                canvas2.setAttribute("width", "640");
                canvas2.setAttribute("height", "480");

                canvas2.style.borderStyle = "solid";
                canvas2.style.borderWidth = "1px";
                canvas2.style.borderColor = "#fd7e14";

                var imagen2 = new Image();;
                imagen2.src = inputFotoVehiculo;

                imagen2.onload=function() {
                    document.getElementById('canvas2').style.display = 'block';
                    contexto2.drawImage(imagen2, 0, 0, imagen2.width, imagen2.height);
                }

                selectMarcaVehiculo();
                document.getElementById('checkVehiculo').click();
            }   

            //Botón que aparece si hay errores en el ingreso del formulario crear visitante y se activa si los tres formularios estan visibles, esto mantiene la información y los formularios visibles
            $('#botonRetorno').click(function () {
                requiredTrue('.activo'); 
                $('#botonCrear2').css("display", "none");
                $('#checkActivo').prop("disabled", true);
                $('#checkActivo').prop("checked", true);
                $('#crearActivo').css("display", "block");
                $('#casoIngreso').val("casoVehiculoActivo");
            });

            //Función anónima que se ejecuta si alguno de los elementos mencionados se crea en la interfaz debido a errores cometidos en el ingreso de los formularios del módulo de visitantes
            (function () {
                if(!!document.getElementById('botonRetorno')){
                    retornarFotoVisitante();
                    var caso = document.getElementById('casoIngreso').value;

                    if(caso == 'casoVehiculo'){
                        retornarFotoVehiculo();
                    } else if (caso == 'casoActivo'){
                        document.getElementById('checkActivo').click();
                    } else if (caso == 'casoVehiculoActivo'){
                        retornarFotoVehiculo();
                        document.getElementById('botonRetorno').click(); 
                    }
                } else if (!!document.getElementById('botonRetorno2')){
                    retornarFotoVisitante();
                    var caso = document.getElementById('casoIngreso').value;

                    if(caso == 'casoVehiculo'){
                        retornarFotoVehiculo();
                    } else if(caso == 'casoVehiculoActivo'){
                        retornarFotoVehiculo();
                        document.getElementById('checkActivo').click(); 
                    }                  
                } else if (!!document.getElementById('botonRetorno3')){
                    retornarFotoVisitante();
                    var caso = document.getElementById('casoIngreso').value;

                    if(caso == 'casoActivo'){
                        document.getElementById('checkActivo').click(); 
                    } else if(caso == 'casoVehiculoActivo'){
                        retornarFotoVehiculo();
                        document.getElementById('checkActivo').click(); 
                    }  
                }
            })();
            
            // Muestra los modales de ingreso correcto dependiendo de cuales se hayan ingresado y redirecciona en caso de que se oprima el botón continuar
            $('#modal-crear-visitante').modal("show");
            $('#modal-crear-visitanteVehiculo').modal("show");
            $('#modal-crear-visitanteActivo').modal("show");
            $('#modal-crear-visitanteVehiculoActivo').modal("show");

            $('.botonContinuar').click(function() {
                //http://app-seguridad.test/visitantes
                //http://127.0.0.1:8000/visitantes
                $(location).attr('href', "{{ route('mostrarVisitantes') }}");
            });          

        });
    </script>
@endsection

@section('contenido')
    <div class="content mb-n2">
        @include('pages.visitantes.header')
    </div>

    <section class="content-header mb-n4">
        <div class="row">
            <div class="col-md-12">
                <form id="formularioVisitante" action="{{ route('crearVisitante') }}" method="POST" novalidate>
                    @csrf


                    <div class="row">
                        <div class="col-md-12">
                          <div class="card card-primary card-tabs">
                            <div class="card-header p-0 pt-1">
                              <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                  <a class="nav-link active" id="" data-toggle="pill" href="#nuevo_visitante" role="tab" aria-controls="nuevo_visitante" aria-selected="true">Nuevo visitante</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="crearVehiculo" data-toggle="pill" href="#nuevo_vehiculo" role="tab" aria-controls="nuevo_vehiculo" aria-selected="false" style="display: none">Nuevo vehículo</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="crearActivo" data-toggle="pill" href="#nuevo_activo" role="tab" aria-controls="nuevo_activo" aria-selected="false" style="display: none">Nuevo activo</a>
                                </li>
                              </ul>
                            </div>
                            <div class="card-body">
                              <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade show active" id="nuevo_visitante" role="tabpanel" aria-labelledby="nuevo_visitante-tab">
                                    @include('pages.visitantes.formularioCrear2')
                                </div>
                                <div class="tab-pane fade" id="nuevo_vehiculo" role="tabpanel" aria-labelledby="nuevo_vehiculo-tab">
                                    @include('pages.vehiculos.formCrearVehiculo')
                                </div>
                                <div class="tab-pane fade" id="nuevo_activo" role="tabpanel" aria-labelledby="nuevo_activo-tab">
                                    @include('pages.activos.formCrearActivo')
                                </div>
                              </div>
                            </div>
                            <!-- /.card -->
                          </div>
                        </div>  
                    </div> 



                    {{-- <div>
                        @include('pages.visitantes.formularioCrear')
                    </div>

                    <div id="crearVehiculo" style="display:none">
                        @include('pages.formCrearVehiculo')
                    </div>

                    <div id="crearActivo" style="display: none">
                        @include('pages.formCrearActivo')
                    </div> --}}
                </form>
            </div>
        </div>

        @include('pages.visitantes.modales')
        @include('pages.modalError')

    </section>
@endsection