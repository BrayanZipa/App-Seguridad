@extends('themes.lte.layout')

@section('titulo')
    Visitantes
@endsection

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('scripts')
    <!-- DataTables  & Plugins -->
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
    
    <!-- JavaScript propio-->
    <script>
        $(function() {
            $('#tabla_visitantes').DataTable({
                "destroy": true,
                "processing": true,
                // "serverSide": true,
                "responsive": true,
                "autoWidth": false,
                // "scrollY": '300px',
                "ajax": "{{ route('mostrarInformacion') }}",
                "columns": [
                    {
                        "data": 'id_personas',
                        "name": 'id_personas'
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
                        "data": 'name',
                        "name": 'name',
                    },
                    {
                        "class": 'editar_visitante',
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
            });

            $('#tabla_visitantes tbody').on('click', 'td.editar_visitante', function () {
                $('#formularioEditar').css("display", "block");
                var tr = $(this).closest('tr');
                var row = $('#tabla_visitantes').DataTable().row(tr);
                var data = row.data();
                // console.log(data);
                $('#form_editar').attr('action','http://app-seguridad.test/visitantes/editar/' + data.id_personas);    
                $('#inputNombre').val(data.nombre);
                $('#inputApellido').val(data.apellido);
                $('#inputIdentificacion').val(data.identificacion);
                $('#inputTelefono').val(data.tel_contacto);
                $('#inputEps').val(data.id_eps);
                $('#inputArl').val(data.id_arl);
            });

            $('#botonCerrar').click(function(){
                $("#formulario").css("display", "none");
            });
        });        
    </script>

    <script>
         $(function() {
            $('#modal-editar').modal("show");
            setTimeout(function(){
                $('#modal-editar').modal('hide');
            }, 3000);
         });      
    </script>
@endsection

@section('contenido')
    <div class="content mb-n2">
        @include('pages.visitantes.header')
    </div>

    <section id="formularioEditar" class="content-header" style="display: none">
        @include('pages.visitantes.formularioEditar')
    </section>

    <section class="content-header">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Visitantes registrados</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- /.card-body -->
                        <table id="tabla_visitantes" class="table table-bordered table-striped table-hover ">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Identificación</th>
                                    <th>EPS</th>
                                    <th>ARL</th>
                                    <th>Teléfono de emergencia</th>
                                    <th>Ingresado por</th>
                                    <th>Editar</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

          @include('pages.visitantes.modales')

    </section>
@endsection