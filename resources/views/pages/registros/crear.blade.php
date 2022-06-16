@extends('themes.lte.layout')

@section('titulo')
    Registros
@endsection

@section('css')
    <!-- Token de Laravel -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('scripts')
    <!-- Select2 -->
    <script src="{{ asset('assets/lte/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- JavaScript propio -->
    {{-- <script src="{{ asset('js/registros/registrosCrear.js') }}"></script> --}}

    <script>
        $(function () {

            //Token de Laravel
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            //Permite que a los select de selección de EPS y ARL de todos los formularios se les asigne una barra de búsqueda haciendolos más dinámicos, también se le asigna select de persona
            function activarSelect2Registros() {
                $('#selectPersona').select2({
                    theme: 'bootstrap4',
                    placeholder: 'Seleccione a la persona',
                    language: {
                        noResults: function () {
                            return 'No hay resultado';
                        }
                    }
                });
                $('.select2EPS').select2({
                    theme: 'bootstrap4',
                    placeholder: 'Seleccione EPS',
                    language: {
                        noResults: function () {
                            return 'No hay resultado';
                        }
                    }
                });
                $('.select2ARL').select2({
                    theme: 'bootstrap4',
                    placeholder: 'Seleccione ARL',
                    language: {
                        noResults: function () {
                            return 'No hay resultado';
                        }
                    }
                });
            }
            activarSelect2Registros();

            //Función que permite que por medio de una solicitud Ajax se listen en un select todas las personas que pertenezcan a un tipo de persona que se haya seleccionado
            function listarPersonas() {
                $('#selectPersona').empty();   
                $('#selectPersona').append("<option value=''>Seleccione a la persona</option>");
                $.ajax({
                    url: '/registros/personas',
                    type: 'GET',
                    data: {
                        tipoPersona: $('#selectTipoPersona option:selected').val(),
                    },
                    dataType: 'json',
                    success: function(response){
                        $('#buscarPersona').css('display', 'block'); 
                        $.each(response.data, function(key, value){                   
                            $('#selectPersona').append("<option value='" + value.id_personas + "'> C.C. " + value.identificacion + " - " + value.nombre + " " + value.apellido + "</option>");
                        });                      
                        // $('#selectPersona').val($('#retornoPersona').val());                               
                    }, 
                    error: function(){
                        console.log('Error obteniendo los datos de las personas');
                    }
                }); 
            }

            //Función que se activa cuando el usuario selecciona alguna opción del select tipo de persona
            $('#selectTipoPersona').change(function() { 
                listarPersonas();
            });
            
            //Función que permite que al seleccionar a una persona se traiaga su información por medio de una solicitud Ajax y dependiendo del tipo de persona esta información se muestre en los diferentes formularios
            $('#selectPersona').change(function() { 
                if($('.registros').hasClass('is-invalid')){
                    $('.registros').removeClass('is-invalid');
                }  
                $.ajax({
                    url: '/registros/persona',
                    type: 'GET',
                    data: {
                        persona: $('#selectPersona option:selected').val(),
                    },
                    dataType: 'json',
                    success: function(response){
                        console.log(response);

                        if($('#formVisitanteConductor').is(':visible')){
                            $('#formVisitanteConductor').css('display', 'none');
                        } else if ($('#formColaboradorSinActivo').is(':visible')){
                            $('#formColaboradorSinActivo').css('display', 'none');
                        }else if ($('#formColaboradorConActivo').is(':visible')){
                            $('#formColaboradorConActivo').css('display', 'none');
                        }

                        if(response.id_tipo_persona == 1 || response.id_tipo_persona == 4){
                            $('#inputId').val(response.id_personas);
                            $('#inputFoto').val(response.foto);
                            $('#fotografia').attr('src', response.foto);  
                            $('#inputNombre').val(response.nombre);
                            $('#inputApellido').val(response.apellido);
                            $('#inputIdentificacion').val(response.identificacion);
                            $('#inputTelefono').val(response.tel_contacto);
                            $('#selectEps').val(response.id_eps);
                            $('#selectArl').val(response.id_arl);

                            if(response.id_tipo_persona == 1){
                                $('#inputActivo').val(response.activo);
                                $('#inputCodigo').val(response.codigo); 
                                if($('#checkActivo').prop('checked') == true){
                                    $('#checkActivo').trigger('click');
                                }

                                $('#selectEps').prop('required', false);
                                $('#selectArl').prop('required', false);
                                $('#titulo').text('Información visitante');
                                $('#checkBox').css('display', ''); 
                                $('#formVisitanteConductor').css('display', 'block'); 
                            } else {
                                $('#selectEps').prop('required', true);
                                $('#selectArl').prop('required', true);
                                $('#titulo').text('Información conductor');
                                $('.visitante').css('display', 'none');   
                                $('#formVisitanteConductor').css('display', 'block'); 
                            }

                        }  else if(response.id_tipo_persona == 2){
                            $('#formColaboradorSinActivo').css('display', 'block'); 

                            $('#inputId2').val(response.id_personas);
                            $('#inputNombre2').val(response.nombre);
                            $('#inputApellido2').val(response.apellido);
                            $('#inputIdentificacion2').val(response.identificacion);
                            $('#inputEmail2').val(response.email);
                            $('#inputTelefono2').val(response.tel_contacto);
                            $('#selectEps2').val(response.id_eps);
                            $('#selectArl2').val(response.id_arl);
                            $('#selectEmpresa2').val(response.id_empresa);
                            
                        }  else if(response.id_tipo_persona == 3){
                            $('#formColaboradorConActivo').css('display', 'block'); 

                            $('#inputId3').val(response.id_personas);
                            $('#inputCodigo3').val(response.codigo);
                            $('#inputNombre3').val(response.nombre);
                            $('#inputApellido3').val(response.apellido);
                            $('#inputIdentificacion3').val(response.identificacion);
                            $('#inputEmail3').val(response.email);
                            $('#inputTelefono3').val(response.tel_contacto);
                            $('#selectEps3').val(response.id_eps);
                            $('#selectArl3').val(response.id_arl);
                            $('#selectEmpresa3').val(response.id_empresa);
                        }   
                        activarSelect2Registros();              
                    }, 
                    error: function(){
                        console.log('Error obteniendo los datos de la persona');
                    }
                }); 
            }); 

            //Manejo de los checkbox al ser seleccionados y control de la vista de formularios   
            $('input[type=checkbox]').on('change', function () {
                if ($('#checkVehiculo').is(':checked') && $('#checkActivo').is(':checked')) {
                    // $('#botonComprimirVisitante').trigger('click');
                    // $('#crearVehiculo').css('display', 'block');
                    // $('#crearActivo').css('display', 'block');
                    // $('#inputActivo').val('Computador');
                    // $('#botonCrear2').css('display', 'none');
                    // $('#checkVehiculo').prop('disabled', true);
                    // $('#checkActivo').prop('disabled', true);
                    // $('#casoIngreso').val('casoVehiculoActivo');
                    // requiredTrue('.vehiculo');
                    // requiredTrue('.activo');

                } else if ($('#checkVehiculo3').is(':checked')) {
                    obtenerVehiculos();
                    // $('#crearVehiculo').css('display', 'block');
                    // $('#botonCrear').css('display', 'none');
                    // $('#botonCrear2').css('display', 'inline');
                    // $('#checkVehiculo').prop('disabled', true);
                    // $('#casoIngreso').val('casoVehiculo');
                    // requiredTrue('.vehiculo');

                } else if ($('#checkActivo').is(':checked') && ($('#checkVehiculo').prop('checked') == false)) {
                    if($('#inputActivo').val('')){
                        $('#inputActivo').val('Computador');
                    }
                    $('#divActivo').css('display', ''); 
                    // $('#crearActivo').css('display', 'block');
                    // $('#inputActivo').val('Computador');
                    // $('#botonCrear').css('display', 'none');
                    // $('#checkActivo').prop('disabled', true);
                    // $('#casoIngreso').val('casoActivo');
                    // requiredTrue('.activo');
                } else if (!$('#checkActivo').is(':checked') && ($('#checkVehiculo').prop('checked') == false)) {
                    $('#divActivo').css('display', 'none');
                }
            });

            // Funciones anónimas que generan mensajes de error cuando el usuario intenta enviar algún formulario del módulo registros sin los datos requeridos, es una primera validación del lado del cliente
            (function () {
                'use strict'
                var form = document.getElementById('formRegistros1');
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        validacion(form);
                    } else {
                        event.preventDefault();
                        guardar();
                        // event.currentTarget.submit();
                    }
                }, false);
            })();

            (function () {
                'use strict'
                var form = document.getElementById('formRegistros2');
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        validacion(form);
                    }
                }, false);
            })();

            (function () {
                'use strict'
                var form = document.getElementById('formRegistros3');
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        validacion(form);
                    }
                }, false);
            })();

            function validacion(form) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                    $('.registros').each(function (index) {
                        if (!this.checkValidity()) {
                            $(this).addClass('is-invalid');
                        }
                    });
                }
            }


            function guardar() {
                datos = {};
                datos['foto'] = $('#inputFoto').val();
                datos['nombre'] = $('#inputNombre').val();
                datos['apellido'] = $('#inputApellido').val();
                datos['identificacion'] = $('#inputIdentificacion').val();
                datos['tel_contacto'] = $('#inputTelefono').val();
                datos['id_eps'] =  $('#selectEps').val();
                datos['id_arl'] = $('#selectArl').val();

                datos['activo'] =  $('#inputActivo').val();
                datos['codigo'] = $('#inputCodigo').val();
                
                console.log(datos);

                $.ajax({
                    url: '/visitantes/editar/' + $('#inputId').val(),
                    type: 'PUT',
                    data: datos,
                    // dataType: 'json',
                    success: function(response){
                        console.log(response);
                    }, 
                    error: function(errores){
                        console.log(errores);
                    }
                }); 
            }


            function obtenerVehiculos(params) {
                $.ajax({
                    url: '/registros/vehiculos/',
                    type: 'GET',
                    data: {
                        persona: $('#selectPersona option:selected').val()
                    },
                    dataType: 'json',
                    success: function(response){
                        console.log(response);
                    }, 
                    error: function(errores){
                        console.log(errores);
                    }
                }); 
            }


            // $( "#formRegistros1" ).submit(function( event ) {
            //     alert( "Handler for .submit() called." );
            //     event.preventDefault();
            // });


        });        
    </script>

@endsection

@section('contenido')
    <div class="content mb-n2">
        @include('pages.registros.header')
    </div>

    <section class="content-header mb-n4">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Crear nuevo registro</h3>
                        <div class="card-tools">
                            <button id="botonComprimirVisitante" type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body mb-n4 mt-n1" >
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="selectTipoPersona">Seleccione el tipo de persona</label>
                                        <select id="selectTipoPersona" class="select2bs4 form-control" style="width: 100%;">
                                            <option selected="selected" value="" disabled>Tipo de persona</option>
                                            @foreach ($tipoPersonas as $tipo)
                                                <option value="{{ $tipo->id_tipo_personas }}" {{ $tipo->id_tipo_personas == old('tipoPersona') ? 'selected' : '' }}>{{ $tipo->tipo }}</option>
                                            @endforeach
                                        </select>  
                                </div>
                            </div>
                            <div id="buscarPersona" class="col-sm-6" style="display: none">
                                <div class="form-group">
                                    <label for="selectPersona">Seleccione a la persona</label>
                                    <select id="selectPersona" class="select2bs4 form-control" style="width: 100%;" name="id_persona">
                                        <option selected="selected" value="" disabled></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="formVisitanteConductor" style="display: none">
                    @include('pages.registros.formularioVisitanteConductor')
                </div>

                <div id="formColaboradorSinActivo" style="display: none">
                    @include('pages.registros.formularioColaboradorSinActivo')
                </div>

                <div id="formColaboradorConActivo" style="display: none">
                    @include('pages.registros.formularioColaboradorConActivo')
                </div>
                
            </div>
        </div>

        {{-- @include('pages.registros.modales') --}}
        @include('pages.modalError')

    </section>
@endsection

{{-- <form id="formulario" action="{{ route('crearVehiculo') }}" method="POST" novalidate>
                    @csrf --}}
                    {{-- <div>
                        @include('pages.registros.formularioCrear')
                    </div> --}}
                    {{-- </form> --}}