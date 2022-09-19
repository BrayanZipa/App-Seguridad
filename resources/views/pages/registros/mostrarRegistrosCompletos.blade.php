@extends('themes.lte.layout')

@section('titulo')
    Registros
@endsection

@section('css')
    <!-- Token de Laravel -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- DateRangePicker.js -->
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/daterangepicker/daterangepicker.css') }}">
@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="{{ asset('assets/lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/lte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/lte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/lte/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/lte/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/lte/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/lte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/lte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/lte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Moment.js -->
    <script src="{{ asset('assets/lte/plugins/moment/moment.min.js') }}"></script>
    <!-- DateRangePicker.js -->
    <script src="{{ asset('assets/lte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- JavaScript propio -->
    <script src="{{ asset('js/registros/registrosMostrar.js') }}"></script>
@endsection

@section('contenido')
    <div class="content mb-n2">
        @include('pages.registros.header')
    </div>

    <section class="content-header">
        <div class="row">
            <div class="col-12">
                <div id="informacionRegistro" class="mb-n2" style="display: none">
                    @include('pages.registros.panelDatosPersona')
                </div>

                <div class="card card-primary mb-n2">
                    <div class="card-header">
                        <h3 class="card-title">Registrados realizados</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="inputBuscar">Búsqueda manual</label>
                                    <input type="search" id="inputBuscar" class="filtros registros form-control" placeholder="Buscar" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                <label for="selectTipoPersona">Filtrar por tipo de persona</label>
                                    <select id="selectTipoPersona" class="filtros form-control" style="width: 100%;">
                                        <option selected="selected" value="" disabled>Tipo de persona</option>
                                        <option value="Visitantes">Visitantes</option>
                                        <option value="Colaboradores">Colaboradores</option>
                                        <option value="Colaboradores con activo">Colaboradores con activo</option>
                                        <option value="Conductores">Conductores</option>
                                    </select>
                                </div>
                            </div>
                            @hasanyrole('Admin|Seguridad')
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                    <label for="selectCiudad">Filtrar por ciudad</label>
                                        <select id="selectCiudad" class="filtros form-control" style="width: 100%;">
                                            <option selected="selected" value="" disabled>Ciudad</option>
                                            <option value="Bogotá">Bogotá</option>
                                            <option value="Cartagena">Cartagena</option>
                                            <option value="Buenaventura">Buenaventura</option>
                                        </select>
                                    </div>
                                </div>
                            @endhasanyrole
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="inputFechaIngreso">Filtrar por fecha de ingreso</label>
                                    <div class="input-group">
                                        <input type="text" id="inputFechaIngreso" class="filtros form-control float-right" placeholder="Fecha de ingreso" autocomplete="off">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="inputFechaSalida">Filtrar por fecha de salida</label>
                                    <div class="input-group">
                                        <input type="text" id="inputFechaSalida" class="filtros form-control float-right" placeholder="Fecha de salida" autocomplete="off">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                <label for="selectIngresoActivo">Filtrar por ingreso de activo</label>
                                    <select id="selectIngresoActivo" class="filtros form-control" style="width: 100%;">
                                        <option selected="selected" value="" disabled>Ingreso de activo</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                <label for="selectIngresoVehiculo">Filtrar por ingreso de vehículo</label>
                                    <select id="selectIngresoVehiculo" class="filtros form-control" style="width: 100%;">
                                        <option selected="selected" value="" disabled>Ingreso de vehículo</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 d-flex align-items-end">
                                <div class="form-group">
                                    <button id="btnFiltros" class="btn btn-primary btn-block">Limpiar</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <table id="tabla_registros" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tipo de persona</th>
                                    <th>Nombre</th>
                                    <th>Identificación</th>
                                    <th>Fecha ingreso</th>
                                    <th>Hora ingreso</th>                   
                                    <th>Fecha salida</th>
                                    <th>Hora salida</th> 
                                    <th>Ingresa activo</th>
                                    <th>Ingresa vehículo</th> 
                                    @hasanyrole('Admin|Seguridad')
                                        <th id="thCiudad">Ciudad</th>
                                    @else
                                        <th>Ciudad</th> 
                                    @endhasanyrole
                                    <th>Ingresado por</th>
                                    <th>Consultar</th>
                                </tr>
                            </thead>
                            <tbody> </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
@endsection