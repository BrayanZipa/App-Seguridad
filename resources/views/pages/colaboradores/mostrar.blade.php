@extends('themes.lte.layout')

@section('titulo')
    Colaboradores con activo
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
                "ajax": {
                    "url" : "{{ route('mostrarInfoColaboradores') }}",
                    "data" : { "tipoPersona" : 3 },
                    "type" : 'get'
                },
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
                        "data": null, 
                        "name": 'activo',
                        render: function ( data, type, row ) {
                            return data.activo+' '+data.codigo;
                        }
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

            //Se elije una fila de la tabla y se toma la información de la persona para mostrarla en un formulario y permitir actualizarla
            // $('#tabla_colaboradores tbody').on('click', 'td.editar_colaborador', function () {     
            //     if($('.colaborador').hasClass('is-invalid')){
            //         $('.colaborador').removeClass("is-invalid");
            //     }  
            //     $('#formEditarColaborador').css("display", "block");  
            //     var tr = $(this).closest('tr');
            //     var row = $('#tabla_colaboradores').DataTable().row(tr);
            //     var data = row.data();
            //     // console.log(data);
            //     //http://app-seguridad.test/colaboradores/editar/   
            //     $('#form_EditarColaborador').attr('action','http://127.0.0.1:8000/colaboradores/editar/' + data.id_personas); 
            //     $('#inputId').val(data.id_personas); 
            //     $('#inputNombre').val(data.nombre);
            //     $('#inputApellido').val(data.apellido);
            //     $('#inputIdentificacion').val(data.identificacion);
            //     $('#inputTelefono').val(data.tel_contacto);
            //     $('#selectEps').val(data.id_eps);
            //     $('#selectArl').val(data.id_arl);
            //     $('#selectEmpresa').val(data.id_empresa);
            //     $('#inputEmail').val(data.email);
            //     $('#inputCodigo').val(data.codigo);
            //     activarSelect2();
            // });

            // Se elije una fila de la tabla y se toma la información del colaborador para mostrarla en un formulario y permitir actualizarla
            $('#tabla_colaboradores tbody').on('click', '.editar_colaborador', function () { 
                var data = $('#tabla_colaboradores').DataTable().row(this).data();  

                if($('.colaborador').hasClass('is-invalid')){ $('.colaborador').removeClass("is-invalid"); }           
                if($('#mensajeError').length){ $('#mensajeError').remove(); }  
                if($('#mensajeCodigo').length){ $('#mensajeCodigo').remove(); } 

                $('#formEditarColaborador').css("display", "block");  
                $('#form_EditarColaborador').attr('action','http://127.0.0.1:8000/colaboradores/editar/' + data.id_personas); 
                $('#inputId').val(data.id_personas); 
                activarSelect2();

                $.ajax({
                    url: "{{ route('colaboradoridentificado') }}" ,
                    type: 'GET',
                    data: {
                        colaborador: data.identificacion
                    },
                    dataType: 'json',
                    success: function(response) {
                        if ('error' in response) {
                            $('.colaborador').each(function(index) {
                                $(this).val('');
                            });
                            $('#inputNombre').addClass('is-invalid');
                            $('#inputCodigo').addClass('is-invalid');
                            $('#inputNombre').val('*El colaborador no esta registrado en el sistema GLPI');
                            $('#inputCodigo').val('*Sin activo');

                        } else {                  
                            $.ajax({
                                url: "{{ route('computador') }}" ,
                                type: 'GET',
                                data: {
                                    colaborador: response.id,
                                },
                                dataType: 'json',
                                success: function(activo) {
                                    if ('error' in activo) {
                                        $('#inputCodigo').addClass('is-invalid');
                                        $('#inputCodigo').val('*Colaborador registrado en GLPI pero sin activo asignado');
                                    } else {
                                        $('#inputCodigo').val(activo['name']); 
                                        if(data.codigo != activo['name']){
                                            $('#inputCodigo').addClass('is-invalid');
                                            if($('#mensajeCodigo').length){ 
                                                $('#mensajeCodigo').text('El colaborador tiene asignado un nuevo activo, debe actualizar');
                                            } else {
                                                $('#inputCodigo').after($('<div id="mensajeError" class="invalid-feedback">El colaborador tiene asignado un nuevo activo, debe actualizar</div>'));
                                            }     
                                        }
                                    }
                                    
                                },
                                error: function() {
                                    console.log('Error obteniendo los datos de GLPI');
                                }
                            });

                            $('#inputIdentificacion').val(response['registration_number']);
                            $('#inputNombre').val(response['firstname']);
                            $('#inputApellido').val(response['realname']);
                            $('#inputEmail').val(response['email']);
                            $('#inputTelefono').val(data.tel_contacto);
                            $('#selectEps').val(data.id_eps);
                            $('#selectArl').val(data.id_arl);

                            if (response['phone2'].includes('Aviomar')) {
                                $('#selectEmpresa').val(1);
                            } else if (response['phone2'].includes('Snider')) {
                                $('#selectEmpresa').val(2);
                            } else if (response['phone2'].includes('Colvan')) {
                                $('#selectEmpresa').val(3);
                            }      
                            activarSelect2();         
                        }         
                    },
                    error: function() {
                        console.log('Error obteniendo los datos de GLPI');
                    }
                });
            });

            //Permite que a los select de selección de EPS Y ARL del formulario de actualizar colaborador se les asigne una barra de búsqueda haciendolos más dinámicos
            function activarSelect2() {
                $('.select2bs4').select2({
                    theme: 'bootstrap4',
                    language: {
                    noResults: function() {
                    return "No hay resultado";        
                    }}
                });
            }

            // Función anónima que genera mensajes de error cuando el usuario intenta enviar el formulario de actualización de colaboradores sin los datos requeridos, es una primera validación del lado del cliente
            (function () {
                'use strict'
                var form = document.getElementById('form_EditarColaborador');
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();

                        $('.colaborador').each(function(index) {
                            if (!this.checkValidity()) {
                                $(this).addClass('is-invalid');
                            }
                        });
                    }
                }, false);
            })();

            //Si en un input del formulario de actualizar colaboradores esta la clase is-invalid al escribir en el mismo input se elimina esta clase 
            $('input.colaborador').keydown(function(event){
                if($(this).hasClass('is-invalid')){
                    $(this).removeClass("is-invalid");
                }     
            });

            //Si en un select del formulario actualizar colaboradores esta la clase is-invalid al seleccionar algo en el mismo select se elimina esta clase 
            $( 'select.colaborador').change(function() {
                if($(this).hasClass('is-invalid')){
                    $(this).removeClass("is-invalid");
                };   
            }); 
    
            //Función anónima que permite devolver el formulario de actualización de colaboradores con los datos ingresados por el usuario con anterioridad en caso de que se cometa un error y se dispare una validación
            (function () {
                if((!!document.getElementById('botonRetorno')) || (!!document.getElementById('botonRetorno3'))){
                    var id_colaborador = document.getElementById('inputId').value;
                    document.getElementById('formEditarColaborador').style.display = 'block';
                    document.getElementById('form_EditarColaborador').setAttribute('action', 'http://127.0.0.1:8000/colaboradores/editar/' + id_colaborador);
                    activarSelect2();
                }
            })();

            //Boton que permite ocultar el formulario de editar
            $('#botonCerrar').click(function(){
                $("#formEditarColaborador").css("display", "none");
            });

            //Muestra el modal indicado al usuario que la actualización se ha realizado correctamente
            $('#modal-editar-colaborador2').modal("show");
            $('#modal-editar-colaboradorActivo2').modal("show");

            setTimeout(function(){
                $('#modal-editar-colaborador2').modal('hide');
            }, 2000);
            setTimeout(function(){
                $('#modal-editar-colaboradorActivo2').modal('hide');
            }, 3000);

        });

    </script>
@endsection


@section('contenido')
    <div class="content mb-n2">
        @include('pages.colaboradores.header')
    </div>

    <section id="formEditarColaborador" class="content-header mb-n4" style="display: none">
        @include('pages.colaboradores.formularioEditar')
    </section>

    <section class="content-header mb-n4">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Colaboradores con activo registrados</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- /.card-body -->
                        <table id="tabla_colaboradores" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Identificación</th>
                                    <th>Activo</th>
                                    <th>EPS</th>
                                    <th>ARL</th>         
                                    <th>Teléfono</th>
                                    <th>Empresa</th>
                                    <th>Correo empresarial</th>  
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

        @include('pages.colaboradores.modales')
        @include('pages.modalError')

    </section>
@endsection