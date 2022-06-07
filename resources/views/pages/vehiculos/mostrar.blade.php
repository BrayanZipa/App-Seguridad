@extends('themes.lte.layout')

@section('titulo')
    Vehículos
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

            //Uso de DataTables para mostrar la información de todos los vehículos creados
            $('#tabla_vehiculos').DataTable({
                "destroy": true,
                "processing": true,
                "responsive": true,
                "autoWidth": false,
                // "serverSide": true,
                // "scrollY": '300px',
                "ajax": "{{ route('mostrarInfoVehiculos') }}",
                "columns": [
                    {
                        "data": 'id_vehiculos',
                        "name": 'id_vehiculos'
                    },
                    {
                        "data": 'identificador',
                        "name": 'identificador'
                    },
                    {
                        "data": 'tipo',
                        "name": 'tipo',
                    },
                    {
                        "data": 'marca',
                        "name": 'marca',
                    },
                    {
                        "data": null, 
                        render: function ( data, type, row ) {
                            return data.nombre+' '+data.apellido;
                        } 
                    },
                    {
                        "data": 'identificacion',
                        "name": 'identificacion',
                    },
                    {
                        "data": 'name',
                        "name": 'name',
                    },
                    {
                        "class": 'editar_vehiculo',
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

            //Se elije una fila de la tabla y se toma la información del vehículo para mostrarla en un formulario y permitir actualizarla
            $('#tabla_vehiculos tbody').on('click', 'td.editar_vehiculo', function () { 
                if($('.vehiculo').hasClass('is-invalid')){
                    $('.vehiculo').removeClass("is-invalid");
                }                       
                var tr = $(this).closest('tr');
                var row = $('#tabla_vehiculos').DataTable().row(tr);
                var data = row.data();
                // console.log(data);
                //http://app-seguridad.test/vehiculos/editar/  
                $('#form_EditarVehiculo').attr('action','http://127.0.0.1:8000/vehiculos/editar/' + data.id_vehiculos); 
                $('#inputIdVehiculo').val(data.id_vehiculos); 
                $('#inputFotoVehiculo').val(data.foto_vehiculo); 
                $('#fotoVehiculo').attr("src", data.foto_vehiculo);  
                $('#inputNumeroIdentificador').val(data.identificador);
                $('#selectTipoVehiculo').val(data.id_tipo_vehiculo);
                $('#selectMarcaVehiculo').val(data.id_marca_vehiculo);
                $('#selectTipoPersona').val(data.id_tipo_persona);             
                $('#retornoPersona').val(data.id_persona);
                $('#personaAnterior').val(data.id_persona);
                selectMarcaVehiculo(); 
                activarSelect2();
                selectPropietario(data.id_persona); 
                $('#formEditarVehiculo').css("display", "block");
            });

            //Permite que a los select de selección de tipo de vehículo y marca de vehículo del formulario actualizar vehículo se les asigne una barra de búsqueda haciendolos más dinámicos
            function activarSelect2() {
                $('.select2bs4').select2({
                    theme: 'bootstrap4',
                    placeholder: 'Seleccione la marca',
                    language: {
                    noResults: function() {
                    return "No hay resultado";        
                    }}
                });

                $('#selectPersona').select2({
                    theme: 'bootstrap4',
                    placeholder: 'Seleccione al propietario',
                    language: {
                    noResults: function() {
                    return "No hay resultado";        
                    }}
                });
            }

            // Función que permite que al momento que el usuario seleccione Bicicleta en el formulario de ingreso de vehículo se desabilite el select de marca de vehículo
            function selectMarcaVehiculo() {
                var tipo = $('#selectTipoVehiculo option:selected').text();
                var tipoVehiculo = tipo.replace(/\s+/g, '');

                if( tipoVehiculo == "Bicicleta"){
                    $('#selectMarcaVehiculo').val('');
                    $('#selectMarcaVehiculo').prop('disabled', true);
                    $('#selectMarcaVehiculo').select2({
                        theme: 'bootstrap4',
                        placeholder: 'Seleccione la marca',
                        language: {
                            noResults: function() {
                                return "No hay resultado";
                            }
                        }
                    });       
                } else {
                    $('#selectMarcaVehiculo').prop('disabled', false);
                } 
            }

            //Función que se activa cuando el usuario selecciona alguna opción del select de tipo de vehículo
            $('#selectTipoVehiculo').change(function() {
                selectMarcaVehiculo();
            });

            //Función que se activa cuando el usuario selecciona alguna opción del select tipo de persona, esto permite que se desplegue otro select en el cual se puede buscar y seleccionar al propietario del vehículo
            function selectPropietario(idPersona) {
                if($('#selectPersona').hasClass('is-invalid')){
                    $('#selectPersona').removeClass("is-invalid");
                }  
                $('#selectPersona').empty();
                // $('#selectPersona').append("<option value=''>Seleccione al propietario</option>");          
                
                $.ajax({
                    url: "{{ route('personas') }}",
                    type: 'GET',
                    data: {
                        tipoPersona: $('#selectTipoPersona option:selected').val(),
                    },
                    dataType: 'json',
                    success: function(response){
                        $.each(response.data, function(key, value){                   
                            $('#selectPersona').append("<option value='" + value.id_personas + "'> C.C. " + value.identificacion + " - " + value.nombre + " " + value.apellido + "</option>");
                        });
                        $('#selectPersona').val(idPersona);               
                    }, 
                    error: function(){
                        console.log('Error obteniendo los datos');
                    }
                });
            }

            //Función que se activa cuando el usuario selecciona alguna opción del select tipo de persona
            $('#selectTipoPersona').change(function() {  
                $('#retornoPersona').val(''); 
                selectPropietario('');                  
            }); 

            //Función que se activa cuando el usuario selecciona alguna opción del select de propietario, permite que se guarde la selección del usuario para que se pueda retanar el valor en caso de que haya errores al momento de enviar la información
            $('#selectPersona').change(function() {  
                $('#retornoPersona').val($('#selectPersona option:selected').val());
            });  

            // Función anónima que genera mensajes de error cuando el usuario intenta enviar el formulario de actualización de vehículos sin los datos requeridos, es una primera validación del lado del cliente
            (function () {
                'use strict'
                var form = document.getElementById('form_EditarVehiculo');
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();

                        $('.vehiculo').each(function(index) {
                            if (!this.checkValidity()) {
                                $(this).addClass('is-invalid');
                            }
                        });
                    }
                }, false);
            })();

            //Si en un input del formulario de actualizar vehículos esta la clase is-invalid al escribir en el mismo input se elimina esta clase 
            $('input.vehiculo').keydown(function(event){
                if($(this).hasClass('is-invalid')){
                    $(this).removeClass("is-invalid");
                }     
            });

            //Si en un select del formulario actualizar vehículos esta la clase is-invalid al seleccionar algo en el mismo select se elimina esta clase 
            $( 'select.vehiculo').change(function() {
                if($(this).hasClass('is-invalid')){
                    $(this).removeClass("is-invalid");
                };   
            }); 

            //Función anónima que permite devolver el formulario de actualización de vehículos con los datos ingresados por el usuario con anterioridad en caso de que se cometa un error y se dispare una validación
            (function () {
                if(!!document.getElementById('botonRetorno2')){
                    var id_vehiculo = document.getElementById('inputIdVehiculo').value;
                    var foto = document.getElementById('inputFotoVehiculo').value;
                    document.getElementById('form_EditarVehiculo').setAttribute('action', 'http://127.0.0.1:8000/vehiculos/editar/' + id_vehiculo);
                    document.getElementById('fotoVehiculo').setAttribute('src', foto);        
                    selectMarcaVehiculo();
                    activarSelect2();
                    selectPropietario($('#retornoPersona').val());
                    document.getElementById('formEditarVehiculo').style.display = 'block';
                }
            })();

            //Boton que permite ocultar el formulario de editar vehículo
            $('#botonCerrar').click(function(){
                $('#formEditarVehiculo').css("display", "none"); 
            });

            //Muestra el modal indicado al usuario que la actualización del vehículo se ha realizado correctamente
            $('#modal-editar-vehiculo').modal("show");
            setTimeout(function(){
                $('#modal-editar-vehiculo').modal('hide');
            }, 2000);

        });
    </script>
@endsection


@section('contenido')
    <div class="content mb-n2">
        @include('pages.vehiculos.header')
    </div>

    <section id="formEditarVehiculo" class="content-header mb-n4" style="display: none">
        @include('pages.vehiculos.formularioEditar')
    </section>

    <section class="content-header mb-n4">
        <div class="row">
            <div class="col-12">
                <div class="card card-orange">
                    <div class="card-header">
                        <h3 class="card-title">Vehículos registrados</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- /.card-body -->
                        <table id="tabla_vehiculos" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Identificador</th>
                                    <th>Tipo</th>
                                    <th>Marca</th>
                                    <th>Propietario</th>
                                    <th>Identificación</th>
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

        @include('pages.vehiculos.modales')
        @include('pages.modalError')

    </section>
@endsection