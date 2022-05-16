@extends('themes.lte.layout')

@section('titulo')
    Registros
@endsection

@section('css')
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
    
    <!-- JavaScript propio-->
    <script>
        $(function() {

            //Uso de DataTables para mostrar la información de todos los colaboradores creados
            $('#tabla_colaboradores').DataTable({
                "destroy": true,
                "processing": true,
                // "serverSide": true,
                "responsive": true,
                "autoWidth": false,
                // "scrollY": '300px',
                "ajax": "{{ route('mostrarInfoColaboradores') }}",
                "columns": [
                    {
                        "data": 'id_registros',
                        "name": 'id_registros'
                    },
                    {
                        "data": 'nombre',
                        "name": 'nombre'
                    },
                    {
                        "data": 'apellido',
                        "name": 'apellido',
                    },
                    {
                        "data": 'identificacion',
                        "name": 'identificacion',
                    },
                    {
                        "data": 'eps',
                        "name": 'eps',
                    },
                    {
                        "data": 'arl',
                        "name": 'arl',
                    },
                    {
                        "data": 'tel_contacto',
                        "name": 'tel_contacto',
                    },      
                    {
                        "data": 'empresa',
                        "name": 'empresa',
                    },
                    {
                        "data": 'email',
                        "name": 'email',
                    },
                    {
                        "data": 'name',
                        "name": 'name',
                    },
                    {
                        "class": 'editar_colaborador',
                        "orderable": false,
                        "data": null,
                        "defaultContent": '<td>' +
                            '<div class="action-buttons text-center">' +
                            '<a href="#" class="btn btn-primary btn-icon btn-sm">' +
                            '<i class="fas fa-edit"></i>' +
                            '</a>' +
                            '</div>' +
                            '</td>',
                    }],
                "lengthChange": true,
                "lengthMenu": [
                    [5, 10, 25, 50, 75, 100, -1],
                    [5, 10, 25, 50, 75, 100, 'ALL']
                ],
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "No hay registros",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }       
            });

        });
    </script>
@endsection

@section('contenido')
    <div class="content mb-n2">
        @include('pages.registros.header')
    </div>

    <section id="formRegistros" class="content-header" style="display: none">
        {{-- @include('pages.conductores.formularioEditar') --}}
    </section>

    <section class="content-header">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Registrados realizados</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- /.card-body -->
                        <table id="tabla_conductores" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Identificación</th>
                                    <th>Fecha ingreso</th>
                                    <th>Hora ingreso</th>                      
                                    <th>EPS</th>
                                    <th>ARL</th>
                                    <th>Teléfono</th>
                                    <th>Responsable</th>
                                    <th>Ingresado por</th>
                                    <th>Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($registros as $registro)
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

        {{-- @include('pages.conductores.modales')
        @include('pages.modalError') --}}

    </section>
@endsection