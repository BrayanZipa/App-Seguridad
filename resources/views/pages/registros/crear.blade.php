@extends('themes.lte.layout')

@section('titulo')
    Registros
@endsection

@section('css')
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
            
            //Permite que a los select de selección de EPS y ARL se les asigne una barra de búsqueda haciendolos más dinámicos
            // function activarSelect2Visitante() {
            //         $('#selectEps').select2({
            //             theme: 'bootstrap4',
            //             placeholder: 'Seleccione EPS',
            //             language: {
            //                 noResults: function () {
            //                     return 'No hay resultado';
            //                 }
            //             }
            //         });
            //         $('#selectArl').select2({
            //             theme: 'bootstrap4',
            //             placeholder: 'Seleccione ARL',
            //             language: {
            //                 noResults: function () {
            //                     return 'No hay resultado';
            //                 }
            //             }
            //         });
            // }

                $('#selectPersona').select2({
                    theme: 'bootstrap4',
                    placeholder: 'Seleccione a la persona',
                    language: {
                        noResults: function () {
                            return 'No hay resultado';
                        }
                    }
                });

            //Función que permite que se despliegue otro select en el cual se puede buscar y seleccionar al propietario del vehículo
            function listarPersonas() {
                $('#selectPersona').empty();     

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
                        $('#selectPersona').val($('#retornoPersona').val());                               
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
                            $('#formRegistros1 #inputId').val(response.id_personas);
                            $('#formRegistros1 #inputFoto').val(response.foto);
                            $('#formRegistros1 #fotografia').attr('src', response.foto);  
                            $('#formRegistros1 #inputNombre').val(response.nombre);
                            $('#formRegistros1 #inputApellido').val(response.apellido);
                            $('#formRegistros1 #inputIdentificacion').val(response.identificacion);
                            $('#formRegistros1 #inputTelefono').val(response.tel_contacto);
                            $('#formRegistros1 #selectEps').val(response.id_eps);
                            $('#formRegistros1 #selectArl').val(response.id_arl);

                            if(response.id_tipo_persona == 1){
                                $('#formRegistros1 #inputActivo').val(response.activo);
                                $('#formRegistros1 #inputCodigo').val(response.codigo); 
                                if($('#checkActivo').prop('checked') == true){
                                    $('#checkActivo').trigger('click');
                                }

                                $('#titulo').text('Información visitante');
                                $('#checkBox').css('display', ''); 
                                $('#formVisitanteConductor').css('display', 'block'); 
                            } else {
                                $('#titulo').text('Información conductor');
                                $('.visitante').css('display', 'none');   
                                $('#formVisitanteConductor').css('display', 'block'); 
                            }

                        }  else if(response.id_tipo_persona == 2){
                            $('#formColaboradorSinActivo').css('display', 'block'); 

                            $('#formRegistros2 #inputNombre').val(response.nombre);
                            $('#formRegistros2 #inputApellido').val(response.apellido);
                            $('#formRegistros2 #inputIdentificacion').val(response.identificacion);
                            $('#formRegistros2 #inputEmail').val(response.email);
                            $('#formRegistros2 #inputTelefono').val(response.tel_contacto);
                            $('#formRegistros2 #selectEps').val(response.id_eps);
                            $('#formRegistros2 #selectArl').val(response.id_arl);
                            $('#formRegistros2 #selectEmpresa').val(response.id_empresa);
                            
                        }  else if(response.id_tipo_persona == 3){
                            $('#formColaboradorConActivo').css('display', 'block'); 

                            $('#formRegistros3 #inputNombre').val(response.nombre);
                            $('#formRegistros3 #inputApellido').val(response.apellido);
                            $('#formRegistros3 #inputIdentificacion').val(response.identificacion);
                            $('#formRegistros3 #inputEmail').val(response.email);
                            $('#formRegistros3 #inputTelefono').val(response.tel_contacto);
                            $('#formRegistros3 #selectEps').val(response.id_eps);
                            $('#formRegistros3 #selectArl').val(response.id_arl);
                            $('#formRegistros3 #selectEmpresa').val(response.id_empresa);
                        }                 
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

                } else if ($('#checkVehiculo').is(':checked') && ($('#checkActivo').prop('checked') == false)) {
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


            // Función anónima que genera mensajes de error cuando el usuario intenta enviar algún formulario del módulo registros sin los datos requeridos, es una primera validación del lado del cliente
            (function () {
                'use strict'
                var form = document.getElemetBy
                var form = document.getElementById('formRegistros1');
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();

                        $('.registros').each(function (index) {
                            if (!this.checkValidity()) {
                                $(this).addClass('is-invalid');
                            }
                        });
                    }
                }, false);
            })();


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