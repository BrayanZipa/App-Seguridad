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
    <script src="{{ asset('js/registros/registrosMostrar.js') }}"></script>
@endsection

@section('contenido')
    <div class="content mb-n2">
        @include('pages.registros.header')
    </div>

    <section class="content-header">
        <div class="row">
            <div class="col-md-12">
                <div id="informacionRegistro" class="mb-n2" style="display: none">
                    @include('pages.registros.panelDatosPersona')
                    {{-- @include('pages.registros.panelDatosPersona2') --}}
                </div>

                <div class="card card-primary mb-n2">
                    <div class="card-header">
                        <h3 class="card-title">Registrados realizados</h3>
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
                                    <th>Ingresa activo</th>
                                    <th>Ingresa vehículo</th> 
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