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
    <!-- JavaScript propio -->
    <script src="{{ asset('js/registros/registrosMostrar2.js') }}"></script>
@endsection

@section('contenido')
    <div class="content mb-n2">
        @include('pages.registros.header')
    </div>

    <section class="content-header">
        <div class="row">
            <div class="col-12">
                <div class="card card-dark card-tabs mt-n1 mb-n2">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tabPersonasSinSalida" data-toggle="pill" href="#personasSinSalida" role="tab" aria-controls="personasSinSalida" aria-selected="true">Personas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tabVehiculosSinSalida" data-toggle="pill" href="#vehiculosSinSalida" role="tab" aria-controls="vehiculosSinSalida" aria-selected="false">Vehículos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tabActivosSinSalida" data-toggle="pill" href="#activosSinSalida" role="tab" aria-controls="activosSinSalida" aria-selected="false">Activos</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade active show" id="personasSinSalida" role="tabpanel" aria-labelledby="tabPersonasSinSalida">
                                <div id="informacionRegistro" class="mt-n3 mx-n3" style="display: none">
                                    @include('pages.registros.panelDatosPersona')
                                </div>
                                <div class="mt-n3 mx-n3">
                                    <div class="card card-primary mb-n4 mx-n1">
                                        <div class="card-header">
                                            <h3 class="card-title">Registros realizados</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            @hasanyrole('Admin|Seguridad')
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
                                                    <div class="col-md-3 col-sm-12 d-flex align-items-end">
                                                        <div class="form-group">
                                                            <button id="btnFiltros" class="btn btn-primary btn-block">Limpiar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endhasanyrole
                                            <table id="tabla_registros_salida" class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>   
                                                        <th>ID</th>
                                                        <th>Tipo de persona</th>
                                                        <th>Nombre</th>
                                                        <th>Identificación</th>
                                                        <th>Teléfono</th>  
                                                        <th>Fecha ingreso</th>
                                                        <th>Hora ingreso</th>                   
                                                        <th>Ingresa activo</th>
                                                        <th>Ingresa vehículo</th> 
                                                        @hasanyrole('Admin|Seguridad')
                                                            <th id="thCiudad">Ciudad</th>
                                                        @else
                                                            <th>Ciudad</th> 
                                                        @endhasanyrole
                                                        <th>Ingresado por</th>
                                                        <th>Dar salida</th>
                                                    </tr>
                                                </thead>
                                                <tbody>       
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                            <div class="tab-pane fade" id="vehiculosSinSalida" role="tabpanel" aria-labelledby="tabVehiculosSinSalida">
                                <div id="infoRegistroVehiculo" class="mt-n3 mx-n3" style="display: none">
                                    @include('pages.registros.panelDatosVehiculo')
                                </div>
                                <div class="mt-n3 mx-n3">
                                    <div class="card card-orange mb-n4 mx-n1">
                                        <div class="card-header">
                                            <h3 class="card-title">Registros realizados</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            @hasanyrole('Admin|Seguridad')
                                                <div class="row mb-3">
                                                    <div class="col-md-3 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="inputBuscar2">Búsqueda manual</label>
                                                            <input type="search" id="inputBuscar2" class="filtros2 registros form-control" placeholder="Buscar" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12">
                                                        <div class="form-group">
                                                        <label for="selectTipoPersona2">Filtrar por tipo de persona</label>
                                                            <select id="selectTipoPersona2" class="filtros2 form-control" style="width: 100%;">
                                                                <option selected="selected" value="" disabled>Tipo de persona</option>
                                                                <option value="Visitantes">Visitantes</option>
                                                                <option value="Colaboradores">Colaboradores</option>
                                                                <option value="Colaboradores con activo">Colaboradores con activo</option>
                                                                <option value="Conductores">Conductores</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12">
                                                        <div class="form-group">
                                                        <label for="selectCiudad2">Filtrar por ciudad</label>
                                                            <select id="selectCiudad2" class="filtros2 form-control" style="width: 100%;">
                                                                <option selected="selected" value="" disabled>Ciudad</option>
                                                                <option value="Bogotá">Bogotá</option>
                                                                <option value="Cartagena">Cartagena</option>
                                                                <option value="Buenaventura">Buenaventura</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12 d-flex align-items-end">
                                                        <div class="form-group">
                                                            <button id="btnFiltros2" class="btn btn-primary btn-block">Limpiar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endhasanyrole
                                            <table id="tabla_registros_vehiculos" class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Tipo de persona</th>
                                                        <th>Nombre</th>
                                                        <th>Identificación</th>
                                                        <th>Teléfono</th> 
                                                        <th>Vehículo</th> 
                                                        <th>Tipo</th> 
                                                        <th>Marca</th> 
                                                        <th>Fecha ingreso</th>
                                                        <th>Hora ingreso</th> 
                                                        @hasanyrole('Admin|Seguridad')
                                                            <th id="thCiudad2">Ciudad</th>
                                                        @else
                                                            <th>Ciudad</th> 
                                                        @endhasanyrole                  
                                                        <th>Ingresado por</th>
                                                        <th>Dar salida</th>
                                                    </tr>
                                                </thead>
                                                <tbody> 
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                            <div class="tab-pane fade" id="activosSinSalida" role="tabpanel" aria-labelledby="tabActivosSinSalida">
                                <div id="infoRegistroActivo" class="mt-n3 mx-n3" style="display: none">
                                    @include('pages.registros.panelDatosActivo')
                                </div>
                                <div class="mt-n3 mx-n3">
                                    <div class="card card-primary mb-n4 mx-n1">
                                        <div class="card-header">
                                            <h3 class="card-title">Registros realizados</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            @hasanyrole('Admin|Seguridad')
                                                <div class="row mb-3">
                                                    <div class="col-md-3 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="inputBuscar3">Búsqueda manual</label>
                                                            <input type="search" id="inputBuscar3" class="filtros3 registros form-control" placeholder="Buscar" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12">
                                                        <div class="form-group">
                                                        <label for="selectCiudad3">Filtrar por ciudad</label>
                                                            <select id="selectCiudad3" class="filtros3 form-control" style="width: 100%;">
                                                                <option selected="selected" value="" disabled>Ciudad</option>
                                                                <option value="Bogotá">Bogotá</option>
                                                                <option value="Cartagena">Cartagena</option>
                                                                <option value="Buenaventura">Buenaventura</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12 d-flex align-items-end">
                                                        <div class="form-group">
                                                            <button id="btnFiltros3" class="btn btn-primary btn-block">Limpiar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endhasanyrole
                                            <table id="tabla_registros_activos" class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Tipo de persona</th>
                                                        <th>Nombre</th>
                                                        <th>Identificación</th>
                                                        <th>Teléfono</th> 
                                                        <th>Activo</th> 
                                                        <th>Código</th> 
                                                        <th>Fecha ingreso</th>
                                                        <th>Hora ingreso</th> 
                                                        @hasanyrole('Admin|Seguridad')
                                                            <th id="thCiudad3">Ciudad</th>
                                                        @else
                                                            <th>Ciudad</th> 
                                                        @endhasanyrole                    
                                                        <th>Ingresado por</th>
                                                        <th>Dar salida</th>
                                                    </tr>
                                                </thead>
                                                <tbody> 
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('pages.registros.modales')

    </section>
@endsection