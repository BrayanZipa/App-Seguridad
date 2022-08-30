$(function() {

    //Uso de DataTables para mostrar la información de todos los usuarios creados en la aplicación
    $('#tabla_usuarios').DataTable({
        'destroy': true,
        'processing': true,
        'responsive': true,
        'autoWidth': false,
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
                'data': 'roles',
                render: function ( data, type, row ) {
                    return data[0].name;
                }
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

    //Se elije una fila de la tabla de usuarios y se toma la información de este para mostrarla en un formulario y permitir asignar un rol
    $('#tabla_usuarios tbody').on('click', '.asignar_rol', function () { 
        var data = $('#tabla_usuarios').DataTable().row(this).data(); 
        $('#form_editarUsuario').attr('action','users/editar/' + data.id_usuarios); 
        $('#inputUsuario').val(data.name);
        $('#inputRol').val(data.roles[0].id);
        $('#selectRol').val(data.roles[0].id);
        $('#formEditarUsuario').css('display', 'block');  
    });

    // Función anónima que genera mensajes de error cuando el usuario intenta enviar el formulario de asignación de rol sin los datos requeridos, es una primera validación del lado del cliente
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

    //Si en un input del formulario de asignación de rol esta la clase is-invalid al escribir en el mismo input se elimina esta clase 
    $('input.usuario').keydown(function(event){
        if($(this).hasClass('is-invalid')){
            $(this).removeClass('is-invalid');
        }     
    });

   //Si en un select del formulario de asignación de rol esta la clase is-invalid al seleccionar algo en el mismo select se elimina esta clase 
    $( 'select.usuario' ).change(function() {
        if($(this).hasClass('is-invalid')){
            $(this).removeClass('is-invalid');
        };   
    }); 
    
    //Botón que permite ocultar el formulario de asignar rol
    $('#botonCerrar').click(function(){
        $('#formEditarUsuario').css('display', 'none'); 
    });

    //Muestra el modal indicado al usuario que la asignación del rol se ha realizado correctamente
    $('#modal-asignar-rol').modal('show');
    setTimeout(function(){
        $('#modal-asignar-rol').modal('hide');
    }, 3000);

});