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
                'data': 'empresa',
                'name': 'empresa',
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
                    '<i class="fas fa-edit"></i>' +
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

});