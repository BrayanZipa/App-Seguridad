$(function() {

    //Uso de DataTables para mostrar la información de todos los usuarios creados
    $('#tabla_usuarios').DataTable({
        'destroy': true,
        'processing': true,
        'responsive': true,
        'autoWidth': false,
        // 'serverSide': true,
        // 'scrollY': '300px',
        'ajax': 'users/informacion',
        'columns': [
            {
                'data': 'id_usuarios',
                'name': 'id_usuarios'
            },
            {
                'data': 'name',
                'name': 'name'
            },
            {
                'data': 'email',
                'name': 'email',
            },
            {
                'data': 'name',
                'name': 'name',
            },
            {
                'class': 'asignar_rol',
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
        } 
    });

    //Se elije una fila de la tabla y se toma la información del vehículo para mostrarla en un formulario y permitir actualizarla
    $('#tabla_usuarios tbody').on('click', '.asignar_rol', function () { 
        var data = $('#tabla_usuarios').DataTable().row(this).data(); 

        $('#form_editarUsuario').attr('action','users/editar/' + data.id_usuarios); 
        $('#inputUsuario').val(data.name);
        $('#formEditarUsuario').css('display', 'block');  
    });

    // Función anónima que genera mensajes de error cuando el usuario intenta enviar algún formulario del módulo vehículos sin los datos requeridos, es una primera validación del lado del cliente
    (function () {
        'use strict'
        var form = document.getElementById('form_editarUsuario');
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();

            $('.usuario').each(function(index) {
                if (!this.checkValidity()) {
                    $(this).addClass('is-invalid');
                }
            });
            }
        }, false);
    })();

    $('#botonCerrar').click(function(){
        $('#formEditarUsuario').css('display', 'none'); 
    });

});