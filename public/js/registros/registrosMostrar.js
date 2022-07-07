$(function() {

    //Token de Laravel
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Uso de DataTables para mostrar los registros realizados de las entradas y salidas de todas las personas creadas
    function datatableRegistrosSalida(){
        $('#tabla_registros_salida').DataTable({
            'destroy': true,
            'processing': true,
            'responsive': true,
            'autoWidth': false,
            // 'serverSide': true,
            // 'scrollY': '300px',
            'ajax': '/registros/informacion_sin_salida',
            'dataType': 'json',
            'type': 'POST',
            'columns': [
                {
                    'data': 'id_registros',
                    'name': 'id_registros'
                },
                {
                    'data': 'tipopersona',
                    'name': 'tipopersona'
                },
                {  
                    'data': null, 
                    'name': 'nombre',
                    render: function ( data, type, row ) {
                        return data.nombre+' '+data.apellido;
                    }
                },
                {
                    'data': 'identificacion',
                    'name': 'identificacion',
                },
                {
                    'data': 'tel_contacto',
                    'name': 'tel_contacto',
                },  
                {
                    'data': 'ingreso_persona',
                    render: function (data) {
                        return moment(data).format('DD-MM-YYYY');
                    } 
                },
                {
                    'data': 'ingreso_persona',
                    render: function (data) {
                        return moment(data).format('h:mm:ss a');
                    } 
                },
                {
                    'data': 'ingreso_activo',
                    render: function (data) {
                        if(data != null){ return 'Si'; }
                        return 'No';
                    } 
                },
                {
                    'data': 'ingreso_vehiculo',
                    render: function (data) {
                        if(data != null){ return 'Si'; }
                        return 'No';
                    }
                },     
                {
                    'data': 'name',
                    'name': 'name',
                    // 'searchable': false,
                    // 'orderable': false
                },
                {
                    'class': 'editar_registro',
                    'orderable': false,
                    'data': null,
                    'defaultContent': '<td>' +
                        '<div class="action-buttons text-center">' +
                        '<a href="#" class="btn btn-primary btn-icon btn-sm">' +
                        '<i class="fa-solid fa-eye"></i>' +
                        '</a>' +
                        '</div>' +
                        '</td>',
                }],
            'order': [[0, 'desc']],  
            'lengthChange': true,
            'lengthMenu': [
                [6, 10, 25, 50, 75, 100, -1],
                [6, 10, 25, 50, 75, 100, 'ALL']
            ],
            'language': {
                'lengthMenu': 'Mostrar _MENU_ registros por página',
                'zeroRecords': 'No hay registros',
                'info': 'Mostrando página _PAGE_ de _PAGES_',
                'infoEmpty': 'No hay registros disponibles',
                'infoFiltered': '(filtrado de _MAX_ registros totales)',
                'search': 'Buscar:',
                'paginate': {
                    'next': 'Siguiente',
                    'previous': 'Anterior'
                }
            },
        });
    }
    datatableRegistrosSalida();

    //Uso de DataTables para mostrar los registros realizados de las entradas y salidas de todas las personas creadas
    function datatableRegistros() {
        $('#tabla_registros').DataTable({
            'destroy': true,
            'processing': true,
            'responsive': true,
            'autoWidth': false,
            // 'serverSide': true,
            // 'scrollY': '300px',
            'ajax': '/registros/informacion',
            'dataType': 'json',
            'type': 'POST',
            'columns': [
                {
                    'data': 'id_registros',
                    'name': 'id_registros'
                },
                {
                    'data': 'tipopersona',
                    'name': 'tipopersona'
                },
                {  
                    'data': null, 
                    'name': 'nombre',
                    render: function ( data, type, row ) {
                        return data.nombre+' '+data.apellido;
                    }
                },
                {
                    'data': 'identificacion',
                    'name': 'identificacion',
                },
                {
                    'data': 'ingreso_persona',
                    render: function (data) {
                        return moment(data).format('DD-MM-YYYY');
                    } 
                },
                {
                    'data': 'ingreso_persona',
                    render: function (data) {
                        return moment(data).format('h:mm:ss a');
                    } 
                },
                {
                    'data': 'salida_persona',
                    render: function (data) {
                        return moment(data).format('DD-MM-YYYY');
                    } 
                },
                {
                    'data': 'salida_persona',
                    render: function (data) {
                        return moment(data).format('h:mm:ss a');
                    } 
                }, 
                {
                    'data': 'tel_contacto',
                    'name': 'tel_contacto',
                },     
                {
                    'data': 'empresavisitada',
                    'name': 'empresavisitada',
                },
                {
                    'data': 'colaborador',
                    'name': 'colaborador',
                },
                {
                    'data': 'name',
                    'name': 'name',
                    // 'searchable': false,
                    // 'orderable': false
                },
                {
                    'class': 'editar_registro',
                    'orderable': false,
                    'data': null,
                    'defaultContent': '<td>' +
                        '<div class="action-buttons text-center">' +
                        '<a href="#" class="btn btn-primary btn-icon btn-sm">' +
                        '<i class="fa-solid fa-eye"></i>' +
                        '</a>' +
                        '</div>' +
                        '</td>',
                }],
            'order': [[0, 'desc']],  
            'lengthChange': true,
            'lengthMenu': [
                [6, 10, 25, 50, 75, 100, -1],
                [6, 10, 25, 50, 75, 100, 'ALL']
            ],
            'language': {
                'lengthMenu': 'Mostrar _MENU_ registros por página',
                'zeroRecords': 'No hay registros',
                'info': 'Mostrando página _PAGE_ de _PAGES_',
                'infoEmpty': 'No hay registros disponibles',
                'infoFiltered': '(filtrado de _MAX_ registros totales)',
                'search': 'Buscar:',
                'paginate': {
                    'next': 'Siguiente',
                    'previous': 'Anterior'
                }
            },
        });
    }
    datatableRegistros();

    //Se elije una fila de la tabla y se toma la información del vehículo para mostrarla en un formulario y permitir actualizarla
    $('#tabla_registros_salida tbody').on('click', '.editar_registro', function () { 
        var data = $('#tabla_registros_salida').DataTable().row(this).data(); 

        $('#idRegistro').val(data.id_registros);
        $('#idTipoPersona').val(data.id_tipo_persona);

        if(data.id_tipo_persona == 1){

        } else if(data.id_tipo_persona == 2){

        } else if(data.id_tipo_persona == 3){

        } else if(data.id_tipo_persona == 4){

        }

        // $('#form_registroSalida').attr('action', '/registros/salida_persona' + data.id_registros);    

        $('#formRegistros').css('display', 'block');   
        console.log(data);
        
        // if($('.vehiculo').hasClass('is-invalid')){
        //     $('.vehiculo').removeClass('is-invalid');
        // }                       
        // $('#form_EditarVehiculo').attr('action','/vehiculos/editar/' + data.id_vehiculos); 
        // $('#inputIdVehiculo').val(data.id_vehiculos); 
        // $('#inputFotoVehiculo').val(data.foto_vehiculo); 
        // $('#fotoVehiculo').attr('src', data.foto_vehiculo);  
        // $('#inputNumeroIdentificador').val(data.identificador);
        // $('#selectTipoVehiculo').val(data.id_tipo_vehiculo);
        // $('#selectMarcaVehiculo').val(data.id_marca_vehiculo);
        // $('#selectTipoPersona').val(data.id_tipo_persona);             
        // $('#retornoPersona').val(data.id_persona);
        // $('#personaAnterior').val(data.id_persona);
        // selectMarcaVehiculo(); 
        // activarSelect2();
        // selectPropietario(data.id_persona); 
        // $('#formEditarVehiculo').css('display', 'block');
    });

    //Función que se activa cuando el usuario le da click al checkbox de verificar si una persona sale sin su vehículo, esto hace que a un input se le agregue información que será utilizada para no tener en cuenta la salida del vehículo 
    $('#checkVehiculo').on('click', function () {
        if ($('#checkVehiculo').is(':checked')) {
            $('#inputVehiculo').val('sinVehiculo');
        } else {
            $('#inputVehiculo').val('');
        }
    });

    //Función que se activa cuando el usuario hace click en el botón de registar salida, esto envia una petición Ajax al servidor para modificar la base de datos y registrar la salida de una persona dependiendo el caso
    $('#botonGuardarSalida').on('click', function () {
        $.ajax({
            url: '/registros/salida_persona/' + $('#idRegistro').val(),
            type: 'PUT',
            data: {
                tipoPersona: $('#idTipoPersona').val(),
                estadoVehiculo: $('#inputVehiculo').val()
            },
            success: function(res) {
                // console.log(res);
                datatableRegistrosSalida();
                datatableRegistros();

                $('#formRegistros').css('display', 'none'); 
                if($('#checkVehiculo').prop('checked')){
                    $('#checkVehiculo').prop('checked', false);
                    $('#inputVehiculo').val('');
                }
                $('#parrafo').text(res.message);
                $('#modal-registro-salida').modal('show');
                // window.location.reload();
            },
            error: function() {
                console.log('Error al registrar la salida de la persona');
            }
        });
    });

});