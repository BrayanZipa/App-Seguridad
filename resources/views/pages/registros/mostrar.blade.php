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
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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
    <!-- Select2 -->
    <script src="{{ asset('assets/lte/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Moment.js -->
    <script src="{{ asset('assets/lte/plugins/moment/moment.min.js') }}"></script>
    <!-- JavaScript propio -->
    <script src="{{ asset('js/registros/registrosMostrar.js') }}"></script>
@endsection

@section('contenido')
    <div class="content mb-n2">
        @include('pages.registros.header')
    </div>

    <section class="content-header">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-dark card-tabs mt-n1 mb-n2">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tabPersonasSinSalida" data-toggle="pill" href="#personasSinSalida" role="tab" aria-controls="personasSinSalida" aria-selected="true">Personas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tabVehiculosSinSalida" data-toggle="pill" href="#vehiculosSinSalida" role="tab" aria-controls="vehiculosSinSalida" aria-selected="false">Vehículos</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade active show" id="personasSinSalida" role="tabpanel" aria-labelledby="tabPersonasSinSalida">
                                <div id="informacionRegistro" class="mt-n3 mx-n3" style="display: none">
                                    {{-- @include('pages.registros.prueba') --}}
                                    @include('pages.registros.panelDatosPersona')
                                </div>
                                <div class="card card-primary mt-n3 mx-n3">
                                    <div class="card-header">
                                        <h3 class="card-title">Registros realizados</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
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
                                                    <th>Ingresado por</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>       
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <div class="tab-pane fade" id="vehiculosSinSalida" role="tabpanel" aria-labelledby="tabVehiculosSinSalida">
                                <div class="card card-orange">
                                    <div class="card-header">
                                        <h3 class="card-title">Registros realizados</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
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
                                                    <th>Ingresado por</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content-header mb-n4">
        <div class="row">
            <div class="col-12">
                {{-- <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Registros sin salida</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- /.card-body -->
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
                                    <th>Ingresado por</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div> --}}
                <!-- /.card -->

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Registrados realizados</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
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
                                    <th>Teléfono</th>  
                                    <th>Empresa visitada</th>
                                    <th>Responsable</th>
                                    <th>Ingresado por</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody> </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                {{-- <div class="card card-orange">
                    <div class="card-header">
                        <h3 class="card-title">Vehículos sin salida</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- /.card-body -->
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
                                    <th>Ingresado por</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody> </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div> --}}
                <!-- /.card -->
            </div>
        </div>

        @include('pages.registros.modales')
        {{-- @include('pages.modalError') --}}

    </section>
@endsection

{{-- @foreach($registros as $registro)
                                                    <tr>
                                                        <td>{{ $registro->id_registros }}</td>
                                                        <td>{{ $registro->persona->nombre }} {{ $registro->persona->apellido }}</td>
                                                        <td>{{ $registro->persona->identificacion }}</td>
                                                        <td>{{ $registro->ingreso_persona}}</td>  
                                                        <td></td>                                 
                                                        <td>{{ $registro->persona->id_eps}}</td>
                                                        <td>{{ $registro->persona->id_arl}}</td>
                                                        <td>{{ $registro->persona->tel_contacto}}</td>
                                                        <td>{{ $registro->colaborador}}</td>
                                                        <td>{{ $registro->persona->usuario->name}}</td>
                                                    </tr>
@endforeach --}}       