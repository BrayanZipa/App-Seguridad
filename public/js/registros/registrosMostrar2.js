$(function() {

    //Token de Laravel
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var casoSalida = '';
    var idRegistro = '';
    var nuevoActivo = '';
    var datosRegistro = {};

    //Uso de DataTables para mostrar los registros realizados en los cuales no se registra la salida de los diferentes tipos de persona (visitantes, conductores, colaboradores con y sin activo)
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
            'type': 'GET',
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
                    'class': 'registrar_salida',
                    'orderable': false,
                    'data': null,
                    'defaultContent': '<td>' +
                        '<div class="action-buttons text-center">' +
                        '<a href="#" class="btn btn-primary btn-icon btn-sm">' +
                        '<i class="fa-solid fa-arrow-right-from-bracket"></i>' +
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

    //Uso de DataTables para mostrar los registros realizados donde se ingresa un vehículo y se registra la salida del propietario pero no del vehículo
    function datatableRegistrosVehiculos() {
        $('#tabla_registros_vehiculos').DataTable({
            'destroy': true,
            'processing': true,
            'responsive': true,
            'autoWidth': false,
            // 'serverSide': true,
            // 'scrollY': '300px',
            'ajax': '/registros/informacion_vehiculos',
            'dataType': 'json',
            'type': 'GET',
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
                    'data': 'identificador',
                    'name': 'identificador',
                }, 
                {
                    'data': 'tipo',
                    'name': 'tipo',
                }, 
                {
                    'data': 'marca',
                    'name': 'marca',
                },
                {
                    'data': 'ingreso_vehiculo',
                    render: function (data) {
                        return moment(data).format('DD-MM-YYYY');
                    } 
                },
                {
                    'data': 'ingreso_vehiculo',
                    render: function (data) {
                        return moment(data).format('h:mm:ss a');
                    } 
                },                     
                {
                    'data': 'name',
                    'name': 'name',
                },
                {
                    'class': 'registrar_salidaVehiculo',
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
    datatableRegistrosVehiculos();

    //Función que permite reestablecer las pestañas de selección (Tabs) en la vista para que sea la pestaña inicial la primera que se muestre al momento en que se seleccione un nuevo registro para darle salida 
    function restablecerTabs() {
        if($('#tabInfoVehiculo').hasClass('active')){
            $('#tabInfoVehiculo').removeClass('active');
            $('#infoVehiculo').removeClass('active show');
            $('#tabInfoRegistro').addClass('active');
            $('#infoRegistro').addClass('active show');
        }

        if($('#tabDatosActivo').hasClass('active') || $('#tabDatosBasicos').hasClass('active')){
            if($('#tabDatosActivo').hasClass('active')){
                $('#tabDatosActivo').removeClass('active');
                $('#datosActivo').removeClass('active show');
            } else {
                $('#tabDatosBasicos').removeClass('active');
                $('#datosBasicos').removeClass('active show');
            }
            $('#tabDatosIngreso').addClass('active');
            $('#datosIngreso').addClass('active show');
        }
    }

    //Al momento en que se carga la página se ocultan elemetos al usuario para esta vista y se cambia el tamaño de varias columnas para mostar de mejor manera la información
    $('#infoSalidaPersona').css('display', 'none');
    $('#infoSalidaVehiculo').css('display', 'none');
    $('#infoSalidaActivo').css('display', 'none');
    $('.columnaPanel').removeClass('col-sm-3');
    $('.columnaPanel').addClass('col-sm-4');
    $('#infoVisitanteConductor').removeClass('col-sm-6');
    $('#infoVisitanteConductor').addClass('col-sm-8');

    //Se elije una fila de la tabla de registros sin salida y se toma la información del registro para mostrarla en un panel de pestañas de selección de manera organizada dependiendo del tipo de persona
    $('#tabla_registros_salida tbody').on('click', '.registrar_salida', function () { 
        var data = $('#tabla_registros_salida').DataTable().row(this).data(); 
        restablecerTabs();

        if(data.ingreso_vehiculo != null && data.ingreso_activo != null){
            casoSalida = 'salidaVehiculoActivo';
        } else if(data.ingreso_vehiculo != null && data.ingreso_activo == null) {
            casoSalida = 'salidaPersonaVehiculo';
        } else if(data.ingreso_activo != null && data.ingreso_vehiculo == null) {
            casoSalida = 'salidaPersonaActivo';
        } else {
            casoSalida = 'salidaPersona';
        }

        idRegistro = data.id_registros;
        datosRegistro = {
            idPersona: data.id_persona,
            tipoPersona: data.id_tipo_persona,
            nombrePersona: data.nombre + ' ' + data.apellido,
            vehiculo: data.identificador,
            activo: data.codigo_activo, 
        }

        if(data.ingreso_vehiculo != null){ 
            if($('#checkVehiculo').prop('checked')){
                $('#checkVehiculo').prop('checked', false);
            }     
            $('#fotoVehiculo').attr('src', data.foto_vehiculo);
            $('#spanFechaVehiculo').text(moment(data.ingreso_vehiculo).format('DD-MM-YYYY'));
            $('#spanHoraVehiculo').text(moment(data.ingreso_vehiculo).format('h:mm:ss a'));
            $('#spanIdentificador').text(data.identificador);
            $('#spanTipo').text(data.tipo);  
            $('#spanMarca').text(data.marca);   
            $('#tabInfoVehiculo').css('display', 'block');
        } else {
            $('#tabInfoVehiculo').css('display', 'none');
        }

        if(data.ingreso_activo != null){
            if($('#checkActivo').prop('checked')){
                $('#checkActivo').prop('checked', false);
            } 
            $('#columnaActivo').css('display', 'none');
            $('#divActivo').css('display', '');
            $('#spanFechaActivo').text(moment(data.ingreso_activo).format('DD-MM-YYYY'));
            $('#spanHoraActivo').text(moment(data.ingreso_activo).format('h:mm:ss a'));
            $('#spanTipoActivo').text(data.activo);
            $('#spanCodigoActivo').text(data.codigo);  
            $('#tabDatosActivo').css('display', 'block');
        } else {
            $('#tabDatosActivo').css('display', 'none');
        }
    
        $('#spanFecha').text(moment(data.ingreso_persona).format('DD-MM-YYYY'));
        $('#spanHora').text(moment(data.ingreso_persona).format('h:mm:ss a'));
        $('#spanNombre').text(data.nombre);
        $('#spanApellido').text(data.apellido);
        $('#spanIdentificacion').text(data.identificacion);
        $('#spanTelefono').text(data.tel_contacto);
        $('#spanEps').text(data.eps);
        $('#spanArl').text(data.arl); 
        $('#parrafoDescripcion').text(data.descripcion);

        if(data.id_tipo_persona == 1 || data.id_tipo_persona == 4){
            if($('#columnaFoto').hasClass('col-sm-2')){
                $('#columnaFoto').removeClass('col-sm-2');
                $('#columnaFoto').addClass('col-sm-3');
                $('#columnaInformacion').removeClass('col-sm-10');
                $('#columnaInformacion').addClass('col-sm-9'); 
            }  
            if($('#columnaDescripcion').hasClass('col-sm-6')){
                $('#columnaDescripcion').removeClass('col-sm-6');
                $('#columnaDescripcion').addClass('col-sm-4');
            }
            $('#infoColaborador').css('display', 'none');            
            $('#spanEmpresa').text(data.empresavisitada); 
            $('#spanColaborador').text(data.colaborador);
            $('#infoVisitanteConductor').css('display', '');  
            
            $('#divLogoEmpresa').css('display', 'none');
            $('#fotoPersona').attr('src', data.foto).on('load', function() {
                $('#divFotoPersona').css('display', 'block');
            });

            if(data.id_tipo_persona == 1){
                $('#divActivo').css('display', 'none');
                $('#tabInfoRegistro').text('Registro visitante');
                $('#tituloTelefono').text('Teléfono de emergencia'); 
            } else {
                $('#tabInfoRegistro').text('Registro conductor');
                $('#tituloTelefono').text('Teléfono de contacto'); 
            }
            
        } else if(data.id_tipo_persona == 2 || data.id_tipo_persona == 3){
            if($('#columnaFoto').hasClass('col-sm-3')){
                $('#columnaFoto').removeClass('col-sm-3');
                $('#columnaFoto').addClass('col-sm-2');
                $('#columnaInformacion').removeClass('col-sm-9');
                $('#columnaInformacion').addClass('col-sm-10');
            }
            if($('#columnaDescripcion').hasClass('col-sm-4')){
                $('#columnaDescripcion').removeClass('col-sm-4');
                $('#columnaDescripcion').addClass('col-sm-6');
            }
            $('#infoVisitanteConductor').css('display', 'none'); 
            $('#tabInfoRegistro').text('Registro colaborador');
            $('#tituloTelefono').text('Teléfono de contacto'); 
            $('#spanCorreo').text(data.email); 
            $('#spanEmpresaCol').text(data.empresa);
            $('#infoColaborador').css('display', '');

            var urlLogo = '/assets/imagenes/' + data.empresa.toLowerCase() +'.png';
            $('#divFotoPersona').css('display', 'none');
            $('#logoEmpresa').attr('src', urlLogo).on('load', function() {
                $('#divLogoEmpresa').css('display', 'block');
            }); 

            if(data.id_tipo_persona == 3){
                obtenerActivoActualizado(data.identificacion, data.codigo);
            }
        } 
        $('#informacionRegistro').css('display', 'block');   
        console.log(data);
        console.log(casoSalida);
    });

    function obtenerActivoActualizado(idColaborador, activoActual) {
        $.ajax({
            url: '/colaboradores/colaboradoridentificado',
            type: 'GET',
            data: {
                colaborador: idColaborador,
            },
            dataType: 'json',
            success: function(response) {
                $.ajax({
                    url: '/colaboradores/computador',
                    type: 'GET',
                    data: {
                        colaborador: response.id,
                    },
                    dataType: 'json',
                    success: function(activo) {
                        $('#spanCodigoActivo2').text(activo.name); 
                        if(activo.name != activoActual){
                            nuevoActivo = activo.name;
                            $('#tabDatosIngreso').removeClass('active');
                            $('#datosIngreso').removeClass('active show');
                            $('#tabDatosActivo').addClass('active');
                            $('#datosActivo').addClass('active show');
                            $('#tituloActivo').text('Cambio de activo'); 
                            $('#spanCodigoActivo2').text(activo.name);
                            $('#columnaActivo').css(
                                {'display': '',
                                'border-left': '5px solid red'
                                }
                            );
                        }
                    },
                    error: function() {
                        console.log('Error obteniendo los datos de GLPI');
                    }
                });
            },
            error: function() {
                console.log('Error obteniendo los datos de GLPI');
            }
        });
    }
    
    //Función que se activa cuando el usuario le da click al checkbox de verificar si una persona sale sin su vehículo, esto hace que a la variable casoSalida se le asigne información que será utilizada para no tener en cuenta la salida del vehículo 
    $('#checkVehiculo').on('click', function () {
        if ($('#checkVehiculo').is(':checked')) {
            if(casoSalida == 'salidaVehiculoActivo'){
                casoSalida = 'salidaPersonaActivo';
            } else if(casoSalida == 'salidaPersonaVehiculo'){
                casoSalida = 'salidaPersona';
            }
        } else {
            if(casoSalida == 'salidaPersonaActivo'){
                casoSalida = 'salidaVehiculoActivo';
            } else if(casoSalida == 'salidaPersona'){
                casoSalida = 'salidaPersonaVehiculo';
            }
        }
        console.log(casoSalida);
        console.log(datosRegistro)
    });

    //Función que se activa cuando el usuario le da click al checkbox de verificar si una persona sale sin su activo, esto hace que a la variable casoSalida se le asigne información que será utilizada para no tener en cuenta la salida del activo
    $('#checkActivo').on('click', function () {
        if ($('#checkActivo').is(':checked')) {
            if(casoSalida == 'salidaVehiculoActivo'){
                casoSalida = 'salidaPersonaVehiculo';
            } else if(casoSalida == 'salidaPersonaActivo'){
                casoSalida = 'salidaPersona';
            }
        } else {
            if(casoSalida == 'salidaPersonaVehiculo'){
                casoSalida = 'salidaVehiculoActivo';
            } else if(casoSalida == 'salidaPersona'){
                casoSalida = 'salidaPersonaActivo';
            }
        }
        console.log(casoSalida);
    });

    //Función que permite obtener el tipo de persona y el nombre de la persona que se haya seleccionado para realizar el registro de una nueva salida
    function obtenerNombrePersona() {
        var nombrePersona = '';
        if(datosRegistro.tipoPersona == 1){
            nombrePersona = 'visitante ' + datosRegistro.nombrePersona;
        } else if(datosRegistro.tipoPersona == 2 || datosRegistro.tipoPersona == 3){
            nombrePersona = 'colaborador ' + datosRegistro.nombrePersona;
        } else if(datosRegistro.tipoPersona == 4){
            nombrePersona = 'conductor ' + datosRegistro.nombrePersona;
        }
        return nombrePersona;
    }

    //Botón que permite desplegar un modal de confirmación cuando el usuario quiera realizar el registro de una salida en el sistema
    $('#botonGuardarSalida').on('click', function () {
        $('#textoSalida').text(obtenerNombrePersona());
        $('#modal-registrarSalida').modal('show');
    });
    
    //Botón que envía una petición Ajax al servidor para modificar la base de datos y registrar la salida de una persona dependiendo el caso, si el registro es exito muestra un modal con la información del registro
    $('#botonContinuarSalida').on('click', function () {
        $('#modal-registrarSalida').modal('hide');
        console.log(nuevoActivo);
        $.ajax({
            url: '/registros/salida_persona/' + idRegistro,
            type: 'PUT',
            data: {
                idPersona: datosRegistro.idPersona,
                registroSalida: casoSalida,
                codigo: nuevoActivo
            },
            success: function(res) {
                console.log(res);
                datatableRegistrosSalida();
                datatableRegistrosVehiculos();
                $('#informacionRegistro').css('display', 'none'); 

                $('.textoPersona').text(obtenerNombrePersona());
                if(casoSalida == 'salidaVehiculoActivo'){
                    $('.textoVehiculo').text(datosRegistro.vehiculo);
                    $('.textoActivo').text(datosRegistro.activo);
                    $('#modal-salida-personaVehiculoActivo').modal('show');                 
                } else if(casoSalida == 'salidaPersonaVehiculo'){
                    $('.textoVehiculo').text(datosRegistro.vehiculo);
                    $('#modal-salida-personaVehiculo').modal('show');
                } else if(casoSalida == 'salidaPersonaActivo'){
                    $('.textoActivo').text(datosRegistro.activo);
                    $('#modal-salida-personaActivo').modal('show');
                } else if(casoSalida == 'salidaPersona'){
                    $('#modal-salida-persona').modal('show');
                }
            },
            error: function() {
                console.log('Error al registrar la salida de la persona');
            }
        });
    });

    //Botón que permite ocultar el panel de información de la persona si selecciono para registrar su salida
    $('#botonCerrar').click(function(){
        $('#informacionRegistro').css('display', 'none'); 
    });

    //Botón que redirecciona a la vista donde se muestra los registros que se han completado totalmente
    $('.botonContinuar').click(function() {
        $(location).attr('href', '/registros/completados');
    });

});