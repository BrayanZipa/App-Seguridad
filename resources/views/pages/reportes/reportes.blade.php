@extends('themes.lte.layout')

@section('titulo')
    Reportes
@endsection

@section('css')
    {{-- <!-- Token de Laravel -->
    <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- DateRangePicker.js -->
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/daterangepicker/daterangepicker.css') }}">
    {{-- <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}"> --}}
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
    <script src="{{ asset('js/reportes/reportes.js') }}"></script>
@endsection

@section('contenido')

    <div class="content mb-n2">
        @include('pages.reportes.header')
    </div>
    
    <section class="content-header">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Generar reportes</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form id="formulario" action="{{ route('exportarReportes') }}" method="GET" novalidate>
                            <input type="hidden" id="inputFormato" name="formato">

                            <div class="row justify-content-md-center mb-3">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                    <label for="selectTipoReporte">Tipos de reportes a generar</label>
                                        <select id="selectTipoReporte" name="tipoReporte" class="form-control" style="width: 100%;">
                                            <option selected="selected" value="" disabled>Seleccione el reporte</option>
                                            <option {{ old('tipoReporte') == '1' ? 'selected' : '' }} value="1">Reporte agrupado por mes</option>
                                            <option {{ old('tipoReporte') == '2' ? 'selected' : '' }} value="2">Reporte agrupado por fecha específica</option>
                                            <option {{ old('tipoReporte') == '3' ? 'selected' : '' }} value="3">Reporte individual por mes</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div id="columnaAnio" class="col-md-3 col-sm-12" style="display: none">
                                    <div class="form-group">
                                    <label for="selectAnio">Filtrar por año</label>
                                        <select id="selectAnio" name="anio" class="filtros requerido form-control {{ $errors->has('anio') ? 'is-invalid' : '' }}" style="width: 100%;">
                                            <option selected="selected" value="" disabled>Año</option>
                                        </select>
                                        @if ($errors->has('anio')) 
                                            <div class="invalid-feedback">
                                                {{ $errors->first('anio') }}
                                            </div>            
                                        @endif
                                    </div>
                                </div>
                                <div id="columnaMes" class="col-md-3 col-sm-12" style="display: none">
                                    <div class="form-group">
                                    <label for="selectMes">Filtrar por mes</label>
                                        <select id="selectMes" name="mes" class="filtros requerido form-control {{ $errors->has('mes') ? 'is-invalid' : '' }}" style="width: 100%;">
                                            <option selected="selected" value="" disabled>Mes</option>
                                            <option {{ old('mes') == '01' ? 'selected' : '' }} value="01">Enero</option>
                                            <option {{ old('mes') == '02' ? 'selected' : '' }} value="02">Febrero</option>
                                            <option {{ old('mes') == '03' ? 'selected' : '' }} value="03">Marzo</option>
                                            <option {{ old('mes') == '04' ? 'selected' : '' }} value="04">Abril</option>
                                            <option {{ old('mes') == '05' ? 'selected' : '' }} value="05">Mayo</option>
                                            <option {{ old('mes') == '06' ? 'selected' : '' }} value="06">Junio</option>
                                            <option {{ old('mes') == '07' ? 'selected' : '' }} value="07">Julio</option>
                                            <option {{ old('mes') == '08' ? 'selected' : '' }} value="08">Agosto</option>
                                            <option {{ old('mes') == '09' ? 'selected' : '' }} value="09">Septiembre</option>
                                            <option {{ old('mes') == '10' ? 'selected' : '' }} value="10">Octubre</option>
                                            <option {{ old('mes') == '11' ? 'selected' : '' }} value="11">Noviembre</option>
                                            <option {{ old('mes') == '12' ? 'selected' : '' }} value="12">Diciembre</option>
                                        </select>
                                        @if ($errors->has('mes')) 
                                            <div class="invalid-feedback">
                                                {{ $errors->first('mes') }}
                                            </div>            
                                        @endif
                                    </div>
                                </div>
                                <div id="columnaFecha" class="col-md-3 col-sm-12" style="display: none">
                                    <div class="form-group">
                                        <label for="inputFecha">Filtrar por fecha específica</label>
                                        <div class="input-group">
                                            <input type="text" id="inputFecha" name="fecha" class="filtros requerido form-control float-right {{ $errors->has('fecha') ? 'is-invalid' : '' }}" value="{{ old('fecha') }}" placeholder="Fecha" autocomplete="off" onkeypress="return /\/[0-9]/i.test(event.key)">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                        @if ($errors->has('fecha')) 
                                            <div class="invalid-feedback">
                                                {{ $errors->first('fecha') }}
                                            </div>            
                                        @endif
                                    </div>
                                </div>
                                <div id="columnaIdentificacion" class="col-md-3 col-sm-12" style="display: none">
                                    <div class="form-group">
                                        <label for="inputIdentificacion">Número de identificación</label>
                                        <input type="search" id="inputIdentificacion" name="identificacion" class="filtros requerido registros form-control {{ $errors->has('identificacion') ? 'is-invalid' : '' }}" value="{{ old('identificacion') }}" placeholder="Identificación" autocomplete="off" onkeypress="return /[0-9]/i.test(event.key)">
                                        @if ($errors->has('identificacion')) 
                                            <div class="invalid-feedback">
                                                {{ $errors->first('identificacion') }}
                                            </div>            
                                        @endif
                                    </div>
                                </div>
                                <div id="columnaTipoPersona" class="col-md-3 col-sm-12" style="display: none">
                                    <div class="form-group">
                                        <label for="selectTipoPersona">Filtrar por tipo de persona</label>
                                        <select id="selectTipoPersona" name="tipoPersona" class="filtros form-control" style="width: 100%;">
                                            <option selected="selected" value="" disabled>Tipo de persona</option>
                                            <option {{ old('tipoPersona') == '1' ? 'selected' : '' }} value="1">Visitantes</option>
                                            <option {{ old('tipoPersona') == '2' ? 'selected' : '' }} value="2">Colaboradores</option>
                                            <option {{ old('tipoPersona') == '3' ? 'selected' : '' }} value="3">Colaboradores con activo</option>
                                            <option {{ old('tipoPersona') == '4' ? 'selected' : '' }} value="4">Conductores</option>
                                            <option {{ old('tipoPersona') == '5' ? 'selected' : '' }} value="5">Todos</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="columnaEmpresa" class="col-md-3 col-sm-12" style="display: none">
                                    <div class="form-group">
                                        <label for="selectEmpresa">Filtrar por empresa visitada</label>
                                        <select id="selectEmpresa" name="empresa" class="filtros form-control" style="width: 100%;">
                                            <option selected="selected" value="" disabled>Empresa</option>
                                            <option {{ old('empresa') == '1' ? 'selected' : '' }} value="1">Aviomar</option>
                                            <option {{ old('empresa') == '2' ? 'selected' : '' }} value="2">Snider</option>
                                            <option {{ old('empresa') == '3' ? 'selected' : '' }} value="3">Colvan</option>
                                            <option {{ old('empresa') == '4' ? 'selected' : '' }} value="4">Todas</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="columnaCiudad" class="col-md-3 col-sm-12" style="display: none">
                                    <div class="form-group">
                                        <label for="selectCiudad">Filtrar por ciudad</label>
                                        <select id="selectCiudad" name="ciudad" class="filtros form-control" style="width: 100%;">
                                            <option selected="selected" value="" disabled>Ciudad</option>
                                            <option  {{ old('ciudad') == 'Bogotá' ? 'selected' : '' }} value="Bogotá">Bogotá</option>
                                            <option  {{ old('ciudad') == 'Cartagena' ? 'selected' : '' }} value="Cartagena">Cartagena</option>
                                            <option  {{ old('ciudad') == 'Buenaventura' ? 'selected' : '' }} value="Buenaventura">Buenaventura</option>
                                            <option  {{ old('ciudad') == 'Todas' ? 'selected' : '' }} value="Todas">Todas</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 d-flex align-items-end">
                                    <div id="columnaBoton" class="form-group" style="display: none">
                                        <button id="btnLimpiar" type="button" class="btn btn-primary">Limpiar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row justify-content-end">
                            <div class="col-md-3 col-sm-12">
                                <div class="input-group mb-3 d-flex justify-content-end">
                                    <button id="btnExcel" type="button" class="btn btn-success mr-1"><i class="fas fa-file-excel"></i> Descargar EXCEL</button>
                                    <button id="btnPdf" type="button" class="btn btn-danger mr-1"><i class="fas fa-file-pdf"></i> Descargar PDF</button>
                                </div>
                            </div>
                        </div>

                        <table id="tablaReportes" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tipo de persona</th>
                                    <th>Nombre</th>
                                    <th>Identificación</th>
                                    <th>Empresa a la que visita / pertenece</th>
                                    <th>Colaborador a cargo</th>
                                    <th>Fecha ingreso</th>
                                    <th>Hora ingreso</th>
                                    <th>Fecha salida</th>
                                    <th>Hora salida</th>
                                    <th>Ingresa activo</th>
                                    <th>Ingresa vehículo</th>
                                    <th>Ciudad</th>
                                    <th>Registrado por</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>

@endsection