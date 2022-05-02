@extends('themes.lte.layout')

@section('titulo')
    Colaboradores
@endsection

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('scripts')
    <!-- Select2 -->
    <script src="{{ asset('assets/lte/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(function() {

            //Permite que a los select de selección de Activo, EPS y ARL se les asigne una barra de búsqueda haciendolos más dinámicos
            function activarSelect2Colaborador() {
                $('#selectCodigo').select2({
                    theme: 'bootstrap4',
                    placeholder: 'Seleccione el código',
                    language: {
                        noResults: function() {
                            return 'No hay resultado';
                        }
                    }
                });
                $('#selectEps').select2({
                    theme: 'bootstrap4',
                    placeholder: 'Seleccione EPS',
                    language: {
                        noResults: function() {
                            return 'No hay resultado';
                        }
                    }
                });
                $('#selectArl').select2({
                    theme: 'bootstrap4',
                    placeholder: 'Seleccione ARL',
                    language: {
                        noResults: function() {
                            return 'No hay resultado';
                        }
                    }
                });
            }

            //Permite que a los select de selección Tipo de vehículo y Marca de vehículo se les asigne una barra de búsqueda haciendolos más dinámicos            
            function activarSelect2Vehiculo() {
                $('#selectTipoVehiculo').select2({
                    theme: 'bootstrap4',
                    placeholder: 'Seleccione el tipo',
                    language: {
                        noResults: function() {
                            return 'No hay resultado';
                        }
                    }
                });
                $('#selectMarcaVehiculo').select2({
                    theme: 'bootstrap4',
                    placeholder: 'Seleccione la marca',
                    language: {
                        noResults: function() {
                            return 'No hay resultado';
                        }
                    }
                });
            }

            activarSelect2Vehiculo();
            activarSelect2Colaborador();

            //Función que permite traer los datos del propietario del código del activo seleccionado y una vez traidos, se coloquen automáticamente en su respectivo input
            $('#selectCodigo').change(function() {
                $.ajax({
                    url: '/colaboradores/persona',
                    type: 'GET',
                    data: {
                        colaborador: $('#selectCodigo option:selected').val(),
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#inputCodigo').val($('#selectCodigo option:selected').text());
                        $('#inputNombre').val(response['firstname']);
                        $('#inputApellido').val(response['realname']);
                        $('#inputIdentificacion').val(response['registration_number']);
                        $('#inputEmail').val(response['email']);

                        if (response['user_dn'].includes('Aviomar')) {
                            $('#selectEmpresa').val(1);
                        } else if (response['user_dn'].includes('Snider')) {
                            $('#selectEmpresa').val(2);
                        } else if (response['user_dn'].includes('Colvan')) {
                            $('#selectEmpresa').val(3);
                        } else {
                            $('#selectEmpresa').val('');
                        }

                        $('.colaborador').each(function(index) {
                            if ((!$(this).val() == '') && ($(this).hasClass(
                                    'is-invalid'))) {
                                $(this).removeClass("is-invalid");
                            }
                        });
                    },
                    error: function() {
                        console.log('Error obteniendo los datos de GLPI');
                    }
                });
            });

            //Manejo del checkbox que muestra el formulario de crear vehículo si es seleccionado
            $('#checkVehiculo').on('change', function() {
                if ($('#checkVehiculo').is(":checked")) {
                    $('#botonComprimirColaborador').trigger("click");
                    $('#crearVehiculo').css("display", "block");
                    $('#botonCrear').css("display", "none");
                    $('#checkVehiculo').prop("disabled", true);
                    $('#casoIngreso').val("casoVehiculoActivo");
                    requiredTrue('.vehiculo');
                }
            });

            //Manejo del botón eliminar del formulario de Vehiculo
            $('#botonCerrar2').click(function() {
                $('#botonComprimirColaborador').trigger("click");
                $('#botonCrear').css("display", "inline");
                $('#casoIngreso').val("");
                $('#crearVehiculo').css("display", "none");
                $('#botonLimpiar2').trigger("click");
                $('#checkVehiculo').prop('disabled', false);
                $('#checkVehiculo').prop("checked", false);
                requiredFalse('.vehiculo');
            });

            //Botón que limpia la información del formulario de colaborador
            $('#botonLimpiar').click(function() {
                $('.colaborador').each(function(index) {
                    $(this).val('');
                    if ($(this).hasClass('is-invalid')) {
                        $(this).removeClass("is-invalid");
                    }
                });
                activarSelect2Colaborador();
            });

            //Botón que limpia la información del formulario de Vehículo
            $('#botonLimpiar2').click(function() {
                document.getElementById('inputFotoVehiculo').setAttribute('value', '');
                $('#video2').css("display", "none");
                $('#canvas2').css("display", "none");
                $('#botonCapturar2').css("display", "none");
                $('.vehiculo').each(function(index) {
                    $(this).val('');
                    if ($(this).hasClass('is-invalid')) {
                        $(this).removeClass("is-invalid");
                    }
                });
                $('#selectMarcaVehiculo').val([]);
                activarSelect2Vehiculo();
            });

            //Al iniciar la página inhabilita la propiedad required del formulario de Vehiculo mientras no sea seleccionado por el usuario
            if ($('#crearVehiculo').is(":hidden")) {
                requiredFalse('.vehiculo');
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

            //Botón que da acceso a la cámara web del computador donde este abierta la aplicación desde el formulario ingresar vehículo
            $('#botonActivar2').click(function() {
                var inputFotoVehiculo = document.getElementById('inputFotoVehiculo');
                if (inputFotoVehiculo.classList.contains('is-invalid')) {
                    inputFotoVehiculo.classList.remove('is-invalid');
                }
                document.getElementById('canvas2').style.display = 'none';
                document.getElementById('inputFotoVehiculo').setAttribute('value', '');
                const video2 = document.getElementById('video2');

                if (!tieneSoporteUserMedia()) {
                    alert("Lo siento. Tu navegador no soporta esta característica");
                    return;
                }

                const constraints = {
                    audio: false,
                    video: {
                        width: 640,
                        height: 480
                    }
                };

                navigator.mediaDevices.getUserMedia(constraints)
                    .then((stream) => {
                        video2.style.display = 'block';
                        video2.style.borderStyle = 'solid';
                        video2.style.borderWidth = '1px';
                        video2.style.borderColor = '#fd7e14';

                        video2.srcObject = stream;
                        video2.play();

                        document.getElementById('botonCapturar2').style.backgroundColor =
                            'rgb(255, 115, 0)';
                        document.getElementById('botonCapturar2').style.display = 'inline';
                    })
                    .catch((err) => console.log(err))
            });

            // Función que permite saber si el navegador que se esta utilizando soporta características audio visuales
            function tieneSoporteUserMedia() {
                return !!(navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices
                        .getUserMedia) ||
                    navigator.webkitGetUserMedia || navigator.msGetUserMedia)
            }

            //Botón que captura una fotografía desde el formulario de crear vehículo con la cámara web del computador donde este abierta la aplicación
            $('#botonCapturar2').click(function() {
                var video2 = document.getElementById('video2');
                video2.pause();
                var canvas2 = document.getElementById('canvas2');
                var contexto2 = canvas2.getContext('2d');
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

                if (tipoVehiculo == "Bicicleta") {
                    $('#selectMarcaVehiculo').val('');
                    $('#selectMarcaVehiculo').prop('disabled', true);
                    $('#selectMarcaVehiculo').select2({
                        theme: 'bootstrap4',
                        placeholder: 'Seleccione la marca',
                        language: {
                            noResults: function() {
                                return 'No hay resultado';
                            }
                        }
                    });
                } else {
                    $('#selectMarcaVehiculo').prop('disabled', false);
                }
            }

            //Función que se activa cuando el usuario selecciona alguna opción del select de tipo de vehículo
            $('#selectTipoVehiculo').change(function() {
                selectMarcaVehiculo();
            });

            // Función anónima que genera mensajes de error cuando el usuario intenta enviar algún formulario del módulo colaboradores sin los datos requeridos, es una primera validación del lado del cliente
            (function() {
                'use strict'
                var form = document.getElementById('formularioColaborador');
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();

                        $('.colaborador, .vehiculo').each(function(index) {
                            if (!this.checkValidity()) {
                                $(this).addClass('is-invalid');
                            }
                        });
                    }
                }, false);
            })();

            //Si en un input del cualquier formulario del módulo colaboradores esta la clase is-invalid al escribir en el mismo input se elimina esta clase 
            $('input.colaborador, textarea.colaborador, input.vehiculo').keydown(function(event) {
                if ($(this).hasClass('is-invalid')) {
                    $(this).removeClass('is-invalid');
                }
            });

            //Si en un select del cualquier formulario del módulo colaboradores esta la clase is-invalid al seleccionar algo en el mismo select se elimina esta clase 
            $('select.colaborador, select.vehiculo').change(function() {
                if ($(this).hasClass('is-invalid')) {
                    $(this).removeClass('is-invalid');
                };
            });

            //Función que permite mantener la fotografía tomada previamente al vehículo en caso de que haya errores al enviar el formulario crear vehículo
            function retornarFotoVehiculo() {
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

                imagen2.onload = function() {
                    document.getElementById('canvas2').style.display = 'block';
                    contexto2.drawImage(imagen2, 0, 0, imagen2.width, imagen2.height);
                }
            }

            //Botón que aparece si hay errores en el ingreso del formulario crear visitante y se activa si los tres formularios estan visibles, esto mantiene la información y los formularios visibles
            $('#botonRetorno').click(function() {
                $('#crearVehiculo').css("display", "block");
                $('#botonCrear').css("display", "none");
                $('#checkVehiculo').prop("disabled", true);
                $('#checkVehiculo').prop("checked", true);
                requiredTrue('.vehiculo');
            });

            //Función anónima que se ejecuta si alguno de los elementos mencionados se crea en la interfaz debido a errores cometidos en el ingreso de los formularios del módulo de colaboradores
            (function() {
                if (!!document.getElementById('botonRetorno')) {
                    var caso = document.getElementById('casoIngreso').value;
                    if (caso == 'casoVehiculoActivo') {
                        retornarFotoVehiculo();
                        selectMarcaVehiculo();
                        document.getElementById('botonRetorno').click();
                    }
                } else if (!!document.getElementById('botonRetorno2')) {
                    var caso = document.getElementById('casoIngreso').value;
                    if (caso == 'casoVehiculoActivo') {
                        retornarFotoVehiculo();
                        selectMarcaVehiculo();
                        document.getElementById('checkVehiculo').click();
                    }
                }

                // var caso = document.getElementById('casoIngreso').value;
                // if(caso == 'casoVehiculoActivo'){
                //     retornarFotoVehiculo();
                //     document.getElementById('checkVehiculo').click();
                // }

                // if(!!document.getElementById('botonRetorno2')){
                //     retornarFotoVehiculo();
                //     document.getElementById('checkVehiculo').click();
                //     // selectMarcaVehiculo();
                // }

            })();

            //Muestra los modales de ingreso correcto dependiendo de que formularios se hayan ingresado y redirecciona en caso de que se oprima el botón continuar
            $('#modal-crear-colaborador').modal("show");
            $('#modal-crear-colaboradorVehiculo').modal("show");
            $('#modal-crear-colaboradorVehiculoActivo').modal("show");

            $('.botonContinuar').click(function() {
                //http://app-seguridad.test/colaboradores
                //http://127.0.0.1:8000/colaboradores
                $(location).attr('href', "{{ route('mostrarColaboradores') }}");
            });

        });
    </script>
@endsection

@section('contenido')
    <div class="content mb-n2">
        @include('pages.colaboradores.header')
    </div>

    <section class="content-header">
        <div class="row">
            <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-dark card-tabs mb-n2">
                                <div class="card-header p-0 pt-1">
                                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="" data-toggle="pill" href="#nuevo_colaborador"
                                                role="tab" aria-controls="nuevo_colaborador" aria-selected="true">Nuevo colabordor con activo</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="" data-toggle="pill"
                                                href="#nuevo_colaboradorVehiculo" role="tab" aria-controls="nuevo_colaboradorVehiculo"
                                                aria-selected="false">Nuevo colaborador con vehículo</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content p-0" id="custom-tabs-one-tabContent" >
                                        <div class="tab-pane fade show active mb-n4" id="nuevo_colaborador" role="tabpanel" aria-labelledby="nuevo_colaborador-tab">
                                            
                                            <form id="formularioColaborador" action="{{ route('crearColaborador') }}" method="POST" novalidate>
                                                @csrf
                                                <div class="mt-n3 mx-n3">
                                                    @include('pages.colaboradores.formularioCrear')
                                                </div>
                                        
                                                <div id="crearVehiculo" class="mt-n2 mb-n4 mx-n3" style="display: none">
                                                    @include('pages.colaboradores.formularioCrearVehiculo')
                                                </div>
                                            </form>
                                        </div>

                                        <div class="tab-pane fade" id="nuevo_colaboradorVehiculo" role="tabpanel" aria-labelledby="nuevo_colaboradorVehiculo-tab">

                                            <form id="formularioColaborador2" action="{{ route('crearColaborador') }}" method="POST" novalidate>
                                                @csrf
                                                <div class="mt-n3 mx-n3">
                                                @include('pages.colaboradores.formularioCrear2')
                                                </div>

                                                <div id="crearVehiculo" class="mt-n2 mb-n4 mx-n3">
                                                    @include('pages.colaboradores.formularioCrearVehiculo')
                                                </div> 
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>




                    {{-- <div>
                        @include('pages.colaboradores.formularioCrear')
                    </div>

                    <div id="crearVehiculo" class="mt-n2 mb-n4" style="display:none">
                        @include('pages.colaboradores.formularioCrearVehiculo')
                    </div> --}}
                
            </div>
        </div>

        @include('pages.colaboradores.modales')
        @include('pages.modalError')

    </section>
@endsection