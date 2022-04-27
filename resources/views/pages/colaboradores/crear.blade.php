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
                        return "No hay resultado";        
                    }}
                });
                $('#selectEps').select2({
                    theme: 'bootstrap4',
                    placeholder: 'Seleccione EPS',
                    language: {
                        noResults: function() {
                            return "No hay resultado";
                        }
                    }
                });
                $('#selectArl').select2({
                    theme: 'bootstrap4',
                    placeholder: 'Seleccione ARL',
                    language: {
                        noResults: function() {
                            return "No hay resultado";
                        }
                    }
                });
            }
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
                    success: function(response){ 
                        $('#inputCodigo').val($('#selectCodigo option:selected').text());           
                        $('#inputNombre').val(response['firstname']);
                        $('#inputApellido').val(response['realname']);
                        $('#inputIdentificacion').val(response['registration_number']);
                        $('#inputEmail').val(response['email']);
                        
                        if(response['user_dn'].includes('Aviomar')){
                            $('#selectEmpresa').val(1);
                        } else if(response['user_dn'].includes('Snider')){
                            $('#selectEmpresa').val(2);
                        } else if(response['user_dn'].includes('Colvan')){
                            $('#selectEmpresa').val(3);
                        } else {
                            $('#selectEmpresa').val('');
                        }                                           
                    }, 
                    error: function(){
                        console.log('Error obteniendo los datos de GLPI');
                    }
                }); 
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

            //Función que se activa cuando el usuario selecciona alguna opción del select de tipo de vehículo
            $('#selectTipoVehiculo').change(function() {
                selectMarcaVehiculo();
            });

            // Función anónima que genera mensajes de error cuando el usuario intenta enviar algún formulario del módulo colaboradores sin los datos requeridos, es una primera validación del lado del cliente
            (function () {
                'use strict'
                var form = document.getElementById('formularioColaborador');
                form.addEventListener('submit', function (event) {
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

            Si en un input del cualquier formulario del módulo colaboradores esta la clase is-invalid al escribir en el mismo input se elimina esta clase 
            $('input.colaborador, textarea.colaborador, input.vehiculo').keydown(function(event){
                if($(this).hasClass('is-invalid')){
                    $(this).removeClass("is-invalid");
                }     
            });

           Si en un select del cualquier formulario del módulo colaboradores esta la clase is-invalid al seleccionar algo en el mismo select se elimina esta clase 
            $( 'select.colaborador, select.vehiculo' ).change(function() {
                if($(this).hasClass('is-invalid')){
                    $(this).removeClass("is-invalid");
                };   
            }); 

            $( 'input.colaborador, textarea.colaborador, input.vehiculo' ).change(function() {
                if($(this).hasClass('is-invalid')){
                    $(this).removeClass("is-invalid");
                };   
            }); 

            var prueba = document.getElementById("inputNombre");

            prueba.addEventListener('input', function (event){
                if($('#inputNombre').hasClass('is-invalid')){
                     $('#inputNombre').removeClass("is-invalid");
                }; 
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
                <form id="formularioColaborador" action="{{ route('crearColaborador') }}" method="POST" novalidate>
                    @csrf
                    <div>
                        @include('pages.colaboradores.formularioCrear')
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection