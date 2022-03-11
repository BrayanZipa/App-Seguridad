@extends('themes.lte.layout')

@section('titulo')
    Visitantes
@endsection

@section('css')
@endsection

@section('scripts')
    <script>
        $(function() {

            // Muestra el modal y redirecciona en caso de que oprima el botón.
            $('#modal-crear').modal("show");
            $('#botonContinuar').click(function() {
                $(location).attr('href', 'http://app-seguridad.test/visitantes');
            });

            //Manejo de los checkbox y control de la vista de formularios   
            $('input[type=checkbox]').on('change', function() {
                if ($('#checkVehiculo').is(":checked") && ($('#checkActivo').prop("checked") == false)) {
                    $('#crearVehiculo').css("display", "block");
                    $('#crearActivo').css("display", "none");
                    $('#botonCrear').css("display", "none");
                    $('#botonCrear2').css("display", "inline");

                } else if ($('#checkActivo').is(":checked") && ($('#checkVehiculo').prop("checked") ==
                        false)) {
                    $('#crearActivo').css("display", "block");
                    $('#crearVehiculo').css("display", "none");
                    $('#botonCrear').css("display", "none");

                } else if ($('#checkVehiculo').is(":checked") && $('#checkActivo').is(":checked")) {
                    $('#botonComprimirVisitante').trigger("click");
                    $('#crearVehiculo').css("display", "block");
                    $('#crearActivo').css("display", "block");
                    $('#botonCrear2').css("display", "none");

                } else {
                    $('#crearVehiculo').css("display", "none");
                    $('#crearActivo').css("display", "none");
                    $('#botonCrear').css("display", "inline");
                    // $('#botonComprimirVisitante').trigger("click");
                }
            });

            //Manejo de los botones de eliminar de los formularios
            $('#botonCerrar2').click(function() {
                if($('#crearActivo').is(":visible")){
                    $('#botonComprimirVisitante').trigger("click");                                  
                } else {
                    $('#botonCrear').css("display", "inline");
                }
                $('#crearVehiculo').css("display", "none");
                $('#botonLimpiar2').trigger("click");
                $('#checkVehiculo').prop("checked", false);
            });

            $('#botonCerrar3').click(function() {              
                if($('#crearVehiculo').is(":visible")){
                    $('#botonComprimirVisitante').trigger("click"); 
                    $('#botonCrear2').css("display", "inline");                 
                } else {
                    $('#botonCrear').css("display", "inline");
                }
                $('#crearActivo').css("display", "none");
                $('#botonLimpiar3').trigger("click");
                $('#checkActivo').prop("checked", false);
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

                <form action="{{ route('crearVisitante') }}" method="POST">
                    @csrf

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Crear nuevo visitante</h3>
                            <div class="card-tools">
                                <button id="botonComprimirVisitante" type="button" class="btn btn-tool"
                                    data-card-widget="collapse"><i class="fas fa-minus"></i>
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
                                            placeholder="Nombre" autofocus required>
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
                                        <label for="inputTelefono">Ingrese un teléfono en caso de emergencia</label>
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
                            <br>
                            <div class="row">
                                <div class="col-sm-4">
                                    <!-- checkbox -->
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <label for="checkVehiculo">
                                                ¿El visitante ingresa vehículo?
                                            </label>
                                            <input type="checkbox" id="checkVehiculo">
                                        </div><br>
                                        <div class="icheck-primary d-inline">
                                            <label for="checkActivo">
                                                ¿El visitante ingresa portátil?
                                            </label>
                                            <input type="checkbox" id="checkActivo">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button id="botonCrear" type='submit' class="btn btn-primary">Crear visitante</button>
                            <button type='reset' class="btn btn-secondary">Limpiar</button>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->

                </form>

                <div id="crearVehiculo" style="display: none">
                    @include('pages.formCrearVehiculo')
                </div>

                <div id="crearActivo" style="display: none">
                    @include('pages.formCrearActivo')
                </div>

            </div>
        </div>

        @include('pages.visitantes.modales')

    </section>
@endsection
