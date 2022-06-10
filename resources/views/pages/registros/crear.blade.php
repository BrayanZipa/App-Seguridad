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
                // if($('#selectPersona').hasClass('is-invalid')){
                //     $('#selectPersona').removeClass('is-invalid');
                // }  
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
                $.ajax({
                    url: '/registros/persona',
                    type: 'GET',
                    data: {
                        persona: $('#selectPersona option:selected').val(),
                    },
                    dataType: 'json',
                    success: function(response){
                        console.log(response);

                        if(response.id_tipo_persona == 1){
                            $('#inputActivo').css('display', 'block');  
                            $('#inputCodigo').css('display', 'block');  
                            $('#formularioVisitante').css('display', 'block');  
                            $('#inputFoto').val(response.foto);
                            $('#fotoVisitante').attr('src', response.foto);  
                            $('#inputNombre').val(response.nombre);
                            $('#inputApellido').val(response.apellido);
                            $('#inputIdentificacion').val(response.identificacion);
                            $('#inputTelefono').val(response.tel_contacto);
                            $('#inputEps').val(response.id_eps);
                            $('#inputArl').val(response.id_arl);
                            $('#inputActivo').val(response.activo);
                            $('#inputCodigo').val(response.codigo); 

                        }  else if(response.id_tipo_persona == 2){

                        }  else if(response.id_tipo_persona == 3){

                        }  else if(response.id_tipo_persona == 4){
                            $('#inputActivo').css('display', 'none');  
                            $('#inputCodigo').css('display', 'none');  
                            $('#formularioVisitante').css('display', 'block');  
                            $('#inputFoto').val(response.foto);
                            $('#fotoVisitante').attr('src', response.foto);  
                            $('#inputNombre').val(response.nombre);
                            $('#inputApellido').val(response.apellido);
                            $('#inputIdentificacion').val(response.identificacion);
                            $('#inputTelefono').val(response.tel_contacto);
                            $('#inputEps').val(response.id_eps);
                            $('#inputArl').val(response.id_arl);  
                        }                   
                    }, 
                    error: function(){
                        console.log('Error obteniendo los datos de la persona');
                    }
                }); 
            }); 

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
                {{-- <form id="formulario" action="{{ route('crearVehiculo') }}" method="POST" novalidate>
                    @csrf --}}
                    <div>
                        @include('pages.registros.formularioCrear')
                    </div>
                    <div id="formularioVisitante" style="display: none">
                        @include('pages.registros.formularioEditar')
                    </div>
                {{-- </form> --}}
            </div>
        </div>

        {{-- @include('pages.vehiculos.modales') --}}
        @include('pages.modalError')

    </section>

    {{-- <div class="row justify-content-center">
        <div class="col-sm-6">
            <form action="simple-results.html">

                <div class="form-group">
                    <div class="input-group">
                        <input type="search" class="form-control" placeholder="Buscar persona">
                        <div class="input-group-append">
                            <button  class="btn  btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

                
            </form>
        </div>
    </div> --}}

@endsection