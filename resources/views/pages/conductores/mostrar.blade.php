@extends('themes.lte.layout')

@section('titulo')
    Conductores
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

            //Uso de DataTables para mostrar la información de todos los visitantes creados
            $('#tabla_conductores').DataTable({
                "destroy": true,
                "processing": true,
                // "serverSide": true,
                "responsive": true,
                "autoWidth": false,
                // "scrollY": '300px',
                "ajax": "{{ route('mostrarInfoConductores') }}",
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
                        "class": 'editar_conductor',
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

            //Se elije una fila de la tabla y se toma la información de la persona para mostrarla en un formulario y permitir actualizarla
            $('#tabla_conductores tbody').on('click', 'td.editar_conductor', function () { 
                if($('.conductor').hasClass('is-invalid')){
                    $('.conductor').removeClass("is-invalid");
                }      
                $('#formEditarConductor').css("display", "block");  
                var tr = $(this).closest('tr');
                var row = $('#tabla_conductores').DataTable().row(tr);
                var data = row.data();
                // console.log(data);
                //http://app-seguridad.test/conductores/editar/  
                $('#form_EditarConductor').attr('action','http://127.0.0.1:8000/conductores/editar/' + data.id_personas); 
                $('#inputId').val(data.id_personas); 
                $('#inputFoto').val(data.foto); 
                $('#fotoConductor').attr("src", data.foto);  
                $('#inputNombre').val(data.nombre);
                $('#inputApellido').val(data.apellido);
                $('#inputIdentificacion').val(data.identificacion);
                $('#inputTelefono').val(data.tel_contacto);
                $('#inputEps').val(data.id_eps);
                $('#inputArl').val(data.id_arl);
                activarSelect2();
            });

            //Permite que a los select de selección de EPS Y ARL del formulario de actualizar conductor se les asigne una barra de búsqueda haciendolos más dinámicos
            function activarSelect2() {
                $('.select2bs4').select2({
                    theme: 'bootstrap4',
                    language: {
                    noResults: function() {
                    return "No hay resultado";        
                    }}
                });
            }

            // Función anónima que genera mensajes de error cuando el usuario intenta enviar el formulario de actualización de visitantes sin los datos requeridos, es una primera validación del lado del cliente
            (function () {
                'use strict'
                var form = document.getElementById('form_EditarConductor');
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();

                        $('.conductor').each(function(index) {
                            if (!this.checkValidity()) {
                                $(this).addClass('is-invalid');
                            }
                        });
                    }
                }, false);
            })();

            //Si en un input del formulario de actualizar conductores esta la clase is-invalid al escribir en el mismo input se elimina esta clase 
            $('input.conductor').keydown(function(event){
                if($(this).hasClass('is-invalid')){
                    $(this).removeClass("is-invalid");
                }     
            });

            //Si en un select del formulario actualizar conductores esta la clase is-invalid al seleccionar algo en el mismo select se elimina esta clase 
            $( 'select.conductor').change(function() {
                if($(this).hasClass('is-invalid')){
                    $(this).removeClass("is-invalid");
                };   
            }); 

            //Función anónima que permite devolver el formulario de actualización de conductores con los datos ingresados por el usuario con anterioridad en caso de que se cometa un error y se dispare una validación
            (function () {
                if(!!document.getElementById('botonRetorno')){
                    var id_conductor = document.getElementById('inputId').value;
                    var foto = document.getElementById('inputFoto').value;
                    document.getElementById('formEditarConductor').style.display = 'block';
                    document.getElementById('form_EditarConductor').setAttribute('action', 'http://127.0.0.1:8000/conductores/editar/' + id_conductor);
                    document.getElementById('fotoConductor').setAttribute('src', foto);
                    activarSelect2();
                }
            })();

            //Boton que permite ocultar el formulario de editar conductor
            $('#botonCerrar').click(function(){
                $('#formEditarConductor').css("display", "none"); 
            });

            //Muestra el modal indicado al usuario que la actualización del conductor se ha realizado correctamente
            $('#modal-editar-conductor').modal("show");
            setTimeout(function(){
                $('#modal-editar-conductor').modal('hide');
            }, 2000);

            // Muestra un modal con los diferentes errores cometidos por el usuario a la hora de actualizar un conductor
            // $('#modal-errores-personas').modal("show");

        });
    </script>
@endsection


@section('contenido')
    <div class="content mb-n2">
        @include('pages.conductores.header')
    </div>

    <section id="formEditarConductor" class="content-header mb-n4" style="display: none">
        @include('pages.conductores.formularioEditar')
    </section>

    <section class="content-header mb-n4">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Conductores registrados</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- /.card-body -->
                        <table id="tabla_conductores" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Identificación</th>
                                    <th>EPS</th>
                                    <th>ARL</th>
                                    <th>Teléfono</th>
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

        @include('pages.conductores.modales')
        @include('pages.modalError')

    </section>
@endsection