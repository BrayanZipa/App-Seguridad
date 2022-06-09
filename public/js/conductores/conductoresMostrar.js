$(function() {

    //Uso de DataTables para mostrar la información de todos los visitantes creados
    $('#tabla_conductores').DataTable({
        'destroy': true,
        'processing': true,  
        'responsive': true,
        'autoWidth': false,
        // 'serverSide': true,
        // 'scrollY': '300px',
        'ajax': '/conductores/informacion',
        'columns': [
            {
                'data': 'id_personas',
                'name': 'id_personas'
            },
            {
                'data': 'nombre',
                'name': 'nombre'
            },
            {
                'data': 'apellido',
                'name': 'apellido',
            },
            {
                'data': 'identificacion',
                'name': 'identificacion',
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
                'data': 'tel_contacto',
                'name': 'tel_contacto',
            },
            {
                'data': 'name',
                'name': 'name',
            },
            {
                'class': 'editar_conductor',
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

    //Se elije una fila de la tabla y se toma la información de la persona para mostrarla en un formulario y permitir actualizarla
    $('#tabla_conductores tbody').on('click', '.editar_conductor', function () { 
        var data = $('#tabla_conductores').DataTable().row(this).data();

        if($('.conductor').hasClass('is-invalid')){
            $('.conductor').removeClass('is-invalid');
        }      
        $('#formEditarConductor').css('display', 'block');  
        $('#form_EditarConductor').attr('action','/conductores/editar/' + data.id_personas); 
        $('#inputId').val(data.id_personas); 
        $('#inputFoto').val(data.foto); 
        $('#fotoConductor').attr('src', data.foto);  
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
            return 'No hay resultado';        
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
            $(this).removeClass('is-invalid');
        }     
    });

    //Si en un select del formulario actualizar conductores esta la clase is-invalid al seleccionar algo en el mismo select se elimina esta clase 
    $( 'select.conductor').change(function() {
        if($(this).hasClass('is-invalid')){
            $(this).removeClass('is-invalid');
        };   
    }); 

    //Función anónima que permite devolver el formulario de actualización de conductores con los datos ingresados por el usuario con anterioridad en caso de que se cometa un error y se dispare una validación
    (function () {
        if(!!document.getElementById('botonRetorno')){
            var id_conductor = document.getElementById('inputId').value;
            var foto = document.getElementById('inputFoto').value;
            document.getElementById('formEditarConductor').style.display = 'block';
            document.getElementById('form_EditarConductor').setAttribute('action', '/conductores/editar/' + id_conductor);
            document.getElementById('fotoConductor').setAttribute('src', foto);
            activarSelect2();
        }
    })();

    //Boton que permite ocultar el formulario de editar conductor
    $('#botonCerrar').click(function(){
        $('#formEditarConductor').css('display', 'none'); 
    });

    //Muestra el modal indicado al usuario que la actualización del conductor se ha realizado correctamente
    $('#modal-editar-conductor').modal('show');
    setTimeout(function(){
        $('#modal-editar-conductor').modal('hide');
    }, 2000);

});