@extends('themes.lte.layout')

@section('titulo')
    Vehículos
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

            activarSelect2Vehiculo();

            //Botón que limpia la información del formulario de Vehículo
            $('#botonLimpiar2').click(function() {
                $('#botonActivar2').trigger("click");
                $('.vehiculo').each(function(index) {
                    $(this).val('');
                    if($(this).hasClass('is-invalid')){
                        $(this).removeClass("is-invalid");
                    } 
                });
                $('#selectMarcaVehiculo').val([]);
                activarSelect2Vehiculo();
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

            // Función anónima que genera mensajes de error cuando el usuario intenta enviar algún formulario del módulo vehículos sin los datos requeridos, es una primera validación del lado del cliente
            (function () {
                'use strict'
                var form = document.getElementById('formularioVehiculo');
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();

                    $('.vehiculo').each(function(index) {
                        if (!this.checkValidity()) {
                            $(this).addClass('is-invalid');
                        }
                    });
                    }
                }, false);
            })();

            //Si en un input del formulario del módulo vehículos esta la clase is-invalid al escribir en el mismo input se elimina esta clase 
            $('input.vehiculo').keydown(function(event){
                if($(this).hasClass('is-invalid')){
                    $(this).removeClass("is-invalid");
                }     
            });

           //Si en un select del formulario del módulo vehículos esta la clase is-invalid al seleccionar algo en el mismo select se elimina esta clase 
            $( 'select.vehiculo' ).change(function() {
                if($(this).hasClass('is-invalid')){
                    $(this).removeClass("is-invalid");
                };   
            }); 

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
            }   

            //Función anónima que se ejecuta si el botón mencionado se crea en la interfaz debido a errores cometidos en el ingreso del formulario crear vehículo
            (function () {
                if (!!document.getElementById('botonRetorno2')){
                    retornarFotoVehiculo();
                    selectMarcaVehiculo();
                }
            })();
            
            // Muestra el modal de creación de vehículo exitoso y redirecciona en caso de que se oprima el botón continuar
            $('#modal-crear-vehiculo').modal("show");

            $('.botonContinuar').click(function() {
                //http://app-seguridad.test/vehiculos
                //http://127.0.0.1:8000/vehiculos
                $(location).attr('href', "{{ route('mostrarVehiculos') }}");
            });          

        });
    </script>
@endsection

@section('contenido')
    <div class="content mb-n2">
        @include('pages.vehiculos.header')
    </div>

    <section class="content-header mb-n4">
        <div class="row">
            <div class="col-md-12">
                <form id="formularioVehiculo" action="{{ route('crearVehiculo') }}" method="POST" novalidate>
                    @csrf
                    <div>
                        @include('pages.vehiculos.formularioCrear')
                    </div>
                </form>
            </div>
        </div>

        @include('pages.vehiculos.modales')
        @include('pages.modalError')

    </section>
@endsection