$(function() {

    //Token de Laravel
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Uso de DataTables para mostrar la información de todos los colaboradores creados
    $('#tabla_colaboradores').DataTable({
        'destroy': true,
        'processing': true,
        'responsive': true,
        'autoWidth': false,
        // 'serverSide': true,
        // 'scrollY': '300px',
        'ajax': {
            'url' : 'informacion',
            'data' : { 'tipoPersona' : 3 },
            'type' : 'get'
        },
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
                'data': null, 
                'name': 'activo',
                render: function ( data, type, row ) {
                    return data.activo+' '+data.codigo;
                }
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
                'data': 'empresa',
                'name': 'empresa',
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
                'class': 'editar_colaborador',
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

    // Se elije una fila de la tabla y se toma la información del colaborador para mostrarla en un formulario y permitir actualizarla
    $('#tabla_colaboradores tbody').on('click', '.editar_colaborador', function () { 
        var data = $('#tabla_colaboradores').DataTable().row(this).data();  
        
        if($('.colaborador').hasClass('is-invalid')){ $('.colaborador').removeClass('is-invalid'); }           
        if($('#mensajeError').length){ $('#mensajeError').remove(); }  
        if($('#mensajeCodigo').length){ $('#mensajeCodigo').remove(); } 
        $('.colaborador').each(function(index) { $(this).val(''); }); 
        activarSelect2(); 

        $('#formEditarColaborador').css('display', 'block');  
        $('#form_EditarColaborador').attr('action','../colaboradores/editar/' + data.id_personas); 
        $('#inputId').val(data.id_personas); 

        $.ajax({
            url: 'colaboradoridentificado',
            type: 'GET',
            data: {
                colaborador: data.identificacion,
                tipoBusqueda: 1,
            },
            dataType: 'json',
            success: function(response) {
                if ('error' in response) { 
                    $('#inputCodigo').addClass('is-invalid');                
                    $('#inputCodigo').val('*El colaborador no esta registrado en el sistema GLPI');
                    $('#inputNombre').val(data.nombre);
                    $('#inputApellido').val(data.apellido);
                    $('#inputIdentificacion').val(data.identificacion);
                    $('#inputEmail').val(data.email);
                    $('#inputTelefono').val(data.tel_contacto);
                    $('#selectEps').val(data.id_eps);
                    $('#selectArl').val(data.id_arl);
                    $('#selectEmpresa').val(data.id_empresa);
                    activarSelect2();
                    $('#botonActualizar').css('display', 'none');
                    $('#botonCambiarRol').css('display', '');

                } else {                  
                    $.ajax({
                        url: 'computador',
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
                    $('#botonActualizar').css('display', '');
                    $('#botonCambiarRol').css('display', 'none');        
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
            return 'No hay resultado';        
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
            $(this).removeClass('is-invalid');
        }     
    });

    //Si en un select del formulario actualizar colaboradores esta la clase is-invalid al seleccionar algo en el mismo select se elimina esta clase 
    $( 'select.colaborador').change(function() {
        if($(this).hasClass('is-invalid')){
            $(this).removeClass('is-invalid');
        };   
    }); 

    //Función anónima que permite devolver el formulario de actualización de colaboradores con los datos ingresados por el usuario con anterioridad en caso de que se cometa un error y se dispare una validación
    (function () {
        if((!!document.getElementById('botonRetorno')) || (!!document.getElementById('botonRetorno3'))){
            var id_colaborador = document.getElementById('inputId').value;
            document.getElementById('formEditarColaborador').style.display = 'block';
            document.getElementById('form_EditarColaborador').setAttribute('action', '../colaboradores/editar/' + id_colaborador);
            activarSelect2();
        }
    })();

    //Botón que permite desplegar un modal de confirmación cuando el usuario quiera cambiar el rol de un colaborador con activo a visitante
    $('#botonCambiarRol').click(function(){
        $('#modalCambioRol').modal('show');
    });

    //Botón que hace una petición Ajax hacia el servidor para cambiar el rol de un colaborador con activo a visitante y eliminar su registro de la tabla de se_activos
    $('#botonConfirmar').click(function(){
        $.ajax({
            url: 'cambiar_rol/' + $('#inputId').val(),
            type: 'DELETE',
            success: function(res) {
                window.location.reload();
            },
            error: function() {
                console.log('Error tratando de cambiar el rol del colaborador');
            }
        });
    });

    //Boton que permite ocultar el formulario de editar
    $('#botonCerrar').click(function(){
        $('#formEditarColaborador').css('display', 'none');
    });

    //Muestra el modal indicado al usuario que la actualización se ha realizado correctamente
    $('#modal-editar-colaborador2').modal('show');
    $('#modal-editar-colaboradorActivo2').modal('show');

    setTimeout(function(){
        $('#modal-editar-colaborador2').modal('hide');
    }, 2000);
    setTimeout(function(){
        $('#modal-editar-colaboradorActivo2').modal('hide');
    }, 3000);

});