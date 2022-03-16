@extends('themes.lte.layout')

@section('titulo')
    Visitantes
@endsection

@section('css')
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
@endsection

@section('scripts')
    <script>
        $(function() {

            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

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

                } else if ($('#checkVehiculo').is(":checked") && ($('#checkActivo').prop("checked") == false)) {
                    $('#crearVehiculo').css("display", "block");
                    // $('#crearActivo').css("display", "none");
                    $('#botonCrear').css("display", "none");
                    $('#botonCrear2').css("display", "inline");
                    $('#checkVehiculo').prop("disabled", true);
                    $('#casoIngreso').val("casoVehiculo");
                    requiredTrue(".vehiculo");

                } else if ($('#checkActivo').is(":checked") && ($('#checkVehiculo').prop("checked") == false)) {
                    $('#crearActivo').css("display", "block");
                    // $('#crearVehiculo').css("display", "none");
                    $('#botonCrear').css("display", "none");
                    $('#checkActivo').prop("disabled", true);
                    $('#casoIngreso').val("casoActivo");
                    requiredTrue('.activo');
                }

                            //  else {
                            //     $('#crearVehiculo').css("display", "none");
                            //     $('#crearActivo').css("display", "none");
                            //     $('#botonCrear').css("display", "inline");
                            //     requiredFalse('.vehiculo');
                            //     requiredFalse('.activo');
                            // }
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
                $('.visitante').each(function(index) {
                    $(this).val('');
                });
            });

            //Botón que limpia la información del formulario de Vehículo
            $('#botonLimpiar2').click(function() {
                $('.vehiculo').each(function(index) {
                    $(this).val('');
                });
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
                $(location).attr('href', 'http://app-seguridad.test/visitantes');
            });

            // $('.botonSi').click(function() {
            //     $(location).attr('href', 'http://app-seguridad.test/visitantes/crear');
            // });

   

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

                <div id="crearVehiculo" style="display: none">
                    @include('pages.formCrearVehiculo')
                </div>

                <div id="crearActivo" style="display: none">
                    @include('pages.formCrearActivo')
                </div>
                {{-- </form> --}}
            </div>
        </div>

        @include('pages.visitantes.modales')

    </section>
@endsection
