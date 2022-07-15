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
                                    <div class="card card-primary card-tabs mb-4 mx-n1">
                                        @include('pages.registros.panelDatosPersona')
                                    </div>
                                    {{-- @include('pages.registros.panelDatosPersona2') --}}
                                </div>
                                <div class="mt-n3 mx-n3">
                                    <div class="card card-primary mb-n4 mx-n1">
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
                                    @include('pages.registros.panelDatosPersona')
                                    {{-- @include('pages.registros.panelDatosPersona2') --}}
                                </div>
                                <div class="mt-n3 mx-n3">
                                    <div class="card card-orange mb-n4 mx-n1">
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

                {{-- <div class="card card-primary">
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
                </div> --}}
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

{{-- <div class="card card-primary card-tabs">
    <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Datos de ingreso</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Datos básicos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Activo</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-one-tabContent">
            <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur.
            </div>
            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
            </div>
            <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
            Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
            </div>
      </div>
    </div>
    <!-- /.card -->
</div> --}}