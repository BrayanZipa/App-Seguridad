$(function() {

    //Uso de DataTables para mostrar los registros realizados de las entradas y salidas de todas las personas creadas
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
                'data': 'tel_contacto',
                'name': 'tel_contacto',
            },
            {
                'data': 'eps',
                'name': 'eps',
            },
            {
                'data': 'arl',
                'name': 'arl',
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

    //Se elije una fila de la tabla y se toma la información del vehículo para mostrarla en un formulario y permitir actualizarla
    $('#tabla_registros tbody').on('click', '.editar_registro', function () { 
        var data = $('#tabla_registros').DataTable().row(this).data(); 

        $('#form_editar').attr('action', '/registros/salida_persona' + data.id_registros);


        $('#form_registroSalida').css('display', 'block');   
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

    // $.ajax({
    //     url: '/registros/salida_persona/' + $('#inputId').val(),
    //     type: 'PUT',
    //     success: function(res) {
    //         window.location.reload();
    //     },
    //     error: function() {
    //         console.log('Error tratando de cambiar el rol del colaborador');
    //     }
    // });

});