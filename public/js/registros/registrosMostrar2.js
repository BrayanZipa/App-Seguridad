$(function() {

    //Token de Laravel
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var casoSalida = '';
    var datosRegistro = {};
    var datosRegistroVehiculo = {};  
    var datosRegistroActivo = {};

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
                    render: function (data, type, row) {
                        if(data != null){ return row.codigo_activo; }
                        return 'No';
                    } 
                },
                {
                    'data': 'ingreso_vehiculo',
                    render: function (data, type, row ) {
                        if(data != null){ return row.identificador; }
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
        $('div.dataTables_filter input', $('#tabla_registros_salida').DataTable().table().container()).focus();
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

    //Uso de DataTables para mostrar los registros realizados donde se ingresa un activo y se registra la salida del propietario pero no del activo
    function datatableRegistrosActivos() {
        $('#tabla_registros_activos').DataTable({
            'destroy': true,
            'processing': true,
            'responsive': true,
            'autoWidth': false,
            // 'serverSide': true,
            // 'scrollY': '300px',
            'ajax': '/registros/informacion_activos',
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
                    'data': 'activo',
                    'name': 'activo',
                },
                {
                    'data': 'codigo_activo',
                    'name': 'codigo_activo',
                }, 
                {
                    'data': 'ingreso_activo',
                    render: function (data) {
                        return moment(data).format('DD-MM-YYYY');
                    } 
                },
                {
                    'data': 'ingreso_activo',
                    render: function (data) {
                        return moment(data).format('h:mm:ss a');
                    } 
                },                     
                {
                    'data': 'name',
                    'name': 'name',
                },
                {
                    'class': 'registrar_salidaActivo',
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

    //Función que se activa cuando se le da click al Tab de Personas, actualiza la información de la Datatable de los registros sin salida
    $('#tabPersonasSinSalida').click(function () {
        datatableRegistrosSalida();
    });

    //Función que se activa cuando se le da click al Tab de Vehículos, actualiza la información de la Datatable de los registros de vehículos sin salida
    $('#tabVehiculosSinSalida').click(function () {
        datatableRegistrosVehiculos();
    });

    //Función que se activa cuando se le da click al Tab de Activos, actualiza la información de la Datatable de los registros de activos sin salida
    $('#tabActivosSinSalida').click(function () {
        datatableRegistrosActivos();
    });

    //Función que permite reestablecer las pestañas de selección (Tabs) en la vista de personas sin salida para que sea la pestaña de Datos de ingreso la primera que se muestre al momento en que se seleccione un nuevo registro para darle salida 
    function restablecerTabs() {
        // if($('#tabDatosVehiculo').hasClass('active')){
        //     $('#tabDatosVehiculo').removeClass('active');
        //     $('#datosVehiculo').removeClass('active show');
        //     $('#tabInfoRegistro').addClass('active');
        //     $('#infoRegistro').addClass('active show');
        // }

        if($('#tabDatosBasicos').hasClass('active') || $('#tabDatosActivo').hasClass('active') || $('#tabDatosVehiculo').hasClass('active')){
            if($('#tabDatosBasicos').hasClass('active')){
                $('#tabDatosBasicos').removeClass('active');
                $('#datosBasicos').removeClass('active show');

            } else if($('#tabDatosActivo').hasClass('active')){
                $('#tabDatosActivo').removeClass('active');
                $('#datosActivo').removeClass('active show');

            } else {
                $('#tabDatosVehiculo').removeClass('active');
                $('#datosVehiculo').removeClass('active show');
            }
            $('#tabDatosIngreso').addClass('active');
            $('#datosIngreso').addClass('active show');
        }
    }

    //Función que permite reestablecer las pestañas de selección (Tabs) en la vista de vehículos sin salida para que sea la pestaña de Vehículo la primera que se muestre al momento en que se seleccione un nuevo registro para darle salida 
    function restablecerTabsVehiculo() {
        if($('#tabDatosIngreso2').hasClass('active') || $('#tabDatosBasicos2').hasClass('active')){
            if($('#tabDatosIngreso2').hasClass('active')){
                $('#tabDatosIngreso2').removeClass('active');
                $('#datosIngreso2').removeClass('active show');

            } else {
                $('#tabDatosBasicos2').removeClass('active');
                $('#datosBasicos2').removeClass('active show');
            } 
        }
        $('#tabDatosVehiculo2').addClass('active');
        $('#datosVehiculo2').addClass('active show');
    }

    //Función que permite reestablecer las pestañas de selección (Tabs) en la vista de activos sin salida para que sea la pestaña de Activo la primera que se muestre al momento en que se seleccione un nuevo registro para darle salida 
    function restablecerTabsActivo() {
        if($('#tabDatosIngreso3').hasClass('active') || $('#tabDatosBasicos3').hasClass('active')){
            if($('#tabDatosIngreso3').hasClass('active')){
                $('#tabDatosIngreso3').removeClass('active');
                $('#datosIngreso3').removeClass('active show');

            } else {
                $('#tabDatosBasicos3').removeClass('active');
                $('#datosBasicos3').removeClass('active show');
            } 
        }
        $('#tabDatosActivo3').addClass('active');
        $('#datosActivo3').addClass('active show');
    }

    //Función que permite cambiar el tamaño del espacio que va a ocupar las imagenes en los registros, para los visitantes y conductores la fotografía ocupa más espacio y para los colaboradores la imagen del logo ocupa menos espacio
    function establecerImagen(tipoPersona, columnaFoto, columnaInformacion, columnaDescripcion) {
        if(tipoPersona == 1 || tipoPersona == 4){
            if($(columnaFoto).hasClass('col-sm-2')){
                $(columnaFoto).removeClass('col-sm-2');
                $(columnaFoto).addClass('col-sm-3');
                $(columnaInformacion).removeClass('col-sm-10');
                $(columnaInformacion).addClass('col-sm-9'); 
            }
            if($(columnaDescripcion).hasClass('col-sm-6')){
                $(columnaDescripcion).removeClass('col-sm-6');
                $(columnaDescripcion).addClass('col-sm-4');
            }

        } else {
            if($(columnaFoto).hasClass('col-sm-3')){
                $(columnaFoto).removeClass('col-sm-3');
                $(columnaFoto).addClass('col-sm-2');
                $(columnaInformacion).removeClass('col-sm-9');
                $(columnaInformacion).addClass('col-sm-10');
            }
            if($(columnaDescripcion).hasClass('col-sm-4')){
                $(columnaDescripcion).removeClass('col-sm-4');
                $(columnaDescripcion).addClass('col-sm-6');
            }
        } 
    }

    //Función que permite establecer ciertos parámetros en el panel que se despliega dependiendo del tipo de persona cuando se selecciona un registro, se ocultan o se muestran elementos y se estabalcen títulos 
    function parametrosPanel(tipoPersona, infoColaborador, infoVisiCon, infoRegistro, tituloTelefono) {
        if(tipoPersona == 1 || tipoPersona == 4){
            $(infoColaborador).css('display', 'none');  
            $(infoVisiCon).css('display', '');  
            if(tipoPersona == 1){
                $(infoRegistro).text('Registro visitante');
                $(tituloTelefono).text('Teléfono de emergencia'); 
            } else {
                $(infoRegistro).text('Registro conductor');
                $(tituloTelefono).text('Teléfono de contacto'); 
            }
        } else {
            $(infoVisiCon).css('display', 'none'); 
            $(infoColaborador).css('display', '');
            $(infoRegistro).text('Registro colaborador');
            $(tituloTelefono).text('Teléfono de contacto'); 
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

    $('#panel').addClass('mb-4 mx-n1');
    $('#cardHeader').addClass('pb-1');
    $('#botonCollapse').addClass('pb-3 mr-n1');
    $('#botonCerrar').addClass('pb-3 mr-n3');

    //Se elije una fila de la tabla de registros sin salida de Personas y se toma la información del registro para mostrarla en un panel de pestañas de selección de manera organizada dependiendo del tipo de persona
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
        
        datosRegistro.idRegistro = data.id_registros;
        datosRegistro.idPersona = data.id_persona;
        datosRegistro.tipoPersona = data.id_tipo_persona;
        datosRegistro.nombrePersona = data.nombre + ' ' + data.apellido;
        datosRegistro.vehiculo = data.identificador;
        datosRegistro.tipoActivo = data.activo;
        datosRegistro.activo = data.codigo_activo;
        datosRegistro.nuevoActivo = '';  

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
            $('#tabDatosVehiculo').css('display', 'block');
        } else {
            $('#tabDatosVehiculo').css('display', 'none');
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
            $('#spanCodigoActivo').text(data.codigo_activo); 
            // $('#spanCodigoActivo').text(data.codigo);  
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
            // if($('#columnaFoto').hasClass('col-sm-2')){
            //     $('#columnaFoto').removeClass('col-sm-2');
            //     $('#columnaFoto').addClass('col-sm-3');
            //     $('#columnaInformacion').removeClass('col-sm-10');
            //     $('#columnaInformacion').addClass('col-sm-9'); 
            // }  
            // if($('#columnaDescripcion').hasClass('col-sm-6')){
            //     $('#columnaDescripcion').removeClass('col-sm-6');
            //     $('#columnaDescripcion').addClass('col-sm-4');
            // }
            establecerImagen(data.id_tipo_persona, '#columnaFoto', '#columnaInformacion', '#columnaDescripcion');
            $('#divLogoEmpresa').css('display', 'none');
            $('#fotoPersona').attr('src', data.foto).on('load', function() {
                $('#divFotoPersona').css('display', 'block');
            });       
            $('#spanEmpresa').text(data.empresavisitada); 
            $('#spanColaborador').text(data.colaborador);
            // $('#infoColaborador').css('display', 'none');  
            // $('#infoVisitanteConductor').css('display', '');  

            parametrosPanel(data.id_tipo_persona, '#infoColaborador', '#infoVisitanteConductor', '#tabInfoRegistro', '#tituloTelefono');
            if(data.id_tipo_persona == 1){
                $('#divActivo').css('display', 'none');
                // $('#tabInfoRegistro').text('Registro visitante');
                // $('#tituloTelefono').text('Teléfono de emergencia'); 
            } else {
                // $('#tabInfoRegistro').text('Registro conductor');
                // $('#tituloTelefono').text('Teléfono de contacto'); 
            }        

        } else if(data.id_tipo_persona == 2 || data.id_tipo_persona == 3){
            // if($('#columnaFoto').hasClass('col-sm-3')){
            //     $('#columnaFoto').removeClass('col-sm-3');
            //     $('#columnaFoto').addClass('col-sm-2');
            //     $('#columnaInformacion').removeClass('col-sm-9');
            //     $('#columnaInformacion').addClass('col-sm-10');
            // }
            // if($('#columnaDescripcion').hasClass('col-sm-4')){
            //     $('#columnaDescripcion').removeClass('col-sm-4');
            //     $('#columnaDescripcion').addClass('col-sm-6');
            // }
            establecerImagen(data.id_tipo_persona, '#columnaFoto', '#columnaInformacion', '#columnaDescripcion');
            var urlLogo = '/assets/imagenes/' + data.empresa.toLowerCase() +'.png';
            $('#divFotoPersona').css('display', 'none');
            $('#logoEmpresa').attr('src', urlLogo).on('load', function() {
                $('#divLogoEmpresa').css('display', 'block');
            }); 
            // $('#tabInfoRegistro').text('Registro colaborador');
            // $('#tituloTelefono').text('Teléfono de contacto'); 
            $('#spanCorreo').text(data.email); 
            $('#spanEmpresaCol').text(data.empresa);
            // $('#infoVisitanteConductor').css('display', 'none'); 
            // $('#infoColaborador').css('display', '');
            parametrosPanel(data.id_tipo_persona, '#infoColaborador', '#infoVisitanteConductor', '#tabInfoRegistro', '#tituloTelefono');
            if(data.id_tipo_persona == 3){
                obtenerActivoActualizado(data.identificacion, data.codigo_activo);
            }
        } 
        $('#informacionRegistro').css('display', 'block');   
        console.log(data);
        console.log(casoSalida);
    });

    //Se elije una fila de la tabla de registros sin salida de vehículos y se toma la información del registro para mostrarla en un panel de pestañas de selección de manera organizada dependiendo del tipo de persona, se muestra primero la información del vehículo
    $('#tabla_registros_vehiculos tbody').on('click', '.registrar_salidaVehiculo', function () { 
        var data = $('#tabla_registros_vehiculos').DataTable().row(this).data(); 
        restablecerTabsVehiculo();

        datosRegistroVehiculo.idRegistro = data.id_registros;
        if(data.marca == null){
            datosRegistroVehiculo.vehiculo = data.tipo + ' ' + data.identificador;
        } else {
            datosRegistroVehiculo.vehiculo = data.tipo + ' ' + data.marca + ' ' + data.identificador;
        }

        $('#spanFecha2').text(moment(data.ingreso_persona).format('DD-MM-YYYY'));
        $('#spanHora2').text(moment(data.ingreso_persona).format('h:mm:ss a'));
        $('#spanNombre2').text(data.nombre);
        $('#spanApellido2').text(data.apellido);
        $('#spanIdentificacion2').text(data.identificacion);
        $('#spanTelefono2').text(data.tel_contacto);
        $('#spanEps2').text(data.eps);
        $('#spanArl2').text(data.arl); 
        $('#parrafoDescripcion2').text(data.descripcion);

        $('#fotoVehiculo2').attr('src', data.foto_vehiculo);
        $('#spanFechaVehiculo2').text(moment(data.ingreso_vehiculo).format('DD-MM-YYYY'));
        $('#spanHoraVehiculo2').text(moment(data.ingreso_vehiculo).format('h:mm:ss a'));
        $('#spanIdentificador2').text(data.identificador);
        $('#spanTipo2').text(data.tipo);
        $('#spanMarca2').text(data.marca);

        if(data.id_tipo_persona == 1 || data.id_tipo_persona == 4){
            establecerImagen(data.id_tipo_persona, '#columnaFoto2', '#columnaInformacion2', '#columnaDescripcion2');
            $('#divLogoEmpresa2').css('display', 'none');
            $('#fotoPersona2').attr('src', data.foto).on('load', function() {
                $('#divFotoPersona2').css('display', 'block');
            });       
            $('#spanEmpresa2').text(data.empresavisitada); 
            $('#spanColaborador2').text(data.colaborador);
            parametrosPanel(data.id_tipo_persona, '#infoColaborador2', '#infoVisitanteConductor2', '#tabInfoRegistro2', '#tituloTelefono2');

        } else if(data.id_tipo_persona == 2 || data.id_tipo_persona == 3){
            establecerImagen(data.id_tipo_persona, '#columnaFoto2', '#columnaInformacion2', '#columnaDescripcion2');
            var urlLogo = '/assets/imagenes/' + data.empresa.toLowerCase() +'.png';
            $('#divFotoPersona2').css('display', 'none');
            $('#logoEmpresa2').attr('src', urlLogo).on('load', function() {
                $('#divLogoEmpresa2').css('display', 'block');
            }); 
            $('#spanCorreo2').text(data.email); 
            $('#spanEmpresaCol2').text(data.empresa);
            parametrosPanel(data.id_tipo_persona, '#infoColaborador2', '#infoVisitanteConductor2', '#tabInfoRegistro2', '#tituloTelefono2');
        }        
        $('#infoRegistroVehiculo').css('display', 'block'); 
        console.log(data);
    });

    //Se elije una fila de la tabla de registros sin salida de vehículos y se toma la información del registro para mostrarla en un panel de pestañas de selección de manera organizada dependiendo del tipo de persona, se muestra primero la información del vehículo
    $('#tabla_registros_activos tbody').on('click', '.registrar_salidaActivo', function () { 
        var data = $('#tabla_registros_activos').DataTable().row(this).data(); 
        restablecerTabsActivo();

        datosRegistroActivo.idRegistro = data.id_registros;
        if(data.codigo_activo_salida != null){
            $('#spanCodigoActivo2').text(data.codigo_activo_salida); 
            $('#columnaActivo2').css('display', '');
            datosRegistroActivo.activo = data.activo + ' ' + data.codigo_activo_salida;
        } else {
            $('#columnaActivo2').css('display', 'none');
            datosRegistroActivo.activo = data.activo + ' ' + data.codigo_activo;
        }
        
        var urlLogo = '/assets/imagenes/' + data.empresa.toLowerCase() +'.png';
        $('#logoEmpresa3').attr('src', urlLogo);

        $('#spanFecha3').text(moment(data.ingreso_persona).format('DD-MM-YYYY'));
        $('#spanHora3').text(moment(data.ingreso_persona).format('h:mm:ss a'));
        $('#spanNombre3').text(data.nombre);
        $('#spanApellido3').text(data.apellido);
        $('#spanIdentificacion3').text(data.identificacion);
        $('#spanTelefono3').text(data.tel_contacto);
        $('#spanEps3').text(data.eps);
        $('#spanArl3').text(data.arl); 
        $('#spanCorreo3').text(data.email); 
        $('#spanEmpresaCol3').text(data.empresa);
        $('#parrafoDescripcion3').text(data.descripcion);

        $('#spanFechaActivo3').text(moment(data.ingreso_activo).format('DD-MM-YYYY'));
        $('#spanHoraActivo3').text(moment(data.ingreso_activo).format('h:mm:ss a'));
        $('#spanTipoActivo3').text(data.activo);
        $('#spanCodigoActivo3').text(data.codigo_activo); 
        
        $('#infoRegistroActivo').css('display', 'block'); 
        console.log(data);
    });

    //Función que envía una petición Ajax al servidor para consultar en el sistema GLPI si a un colaborador en específico se le ha cambiado el código del activo asignado, si esto sucede el sistema ubica al usuario en la pestaña de Activo y muestra cual es el nuevo código que tiene asignado el colaborador
    function obtenerActivoActualizado(idColaborador, codigoActual) {
        $.ajax({
            url: '/colaboradores/colaboradoridentificado',
            type: 'GET',
            data: {
                colaborador: idColaborador,
            },
            dataType: 'json',
            success: function(response) { 
                if('registration_number' in response){
                    $.ajax({
                        url: '/colaboradores/computador',
                        type: 'GET',
                        data: {
                            colaborador: response.id,
                        },
                        dataType: 'json',
                        success: function(activo) {
                            if(activo.name != codigoActual){
                                datosRegistro.nuevoActivo = activo.name;
                                $('#tabDatosIngreso').removeClass('active');
                                $('#datosIngreso').removeClass('active show');
                                $('#tabDatosActivo').addClass('active');
                                $('#datosActivo').addClass('active show');
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
                }
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
        $.ajax({
            url: '/registros/salida_persona/' + datosRegistro.idRegistro,
            type: 'PUT',
            data: {
                idPersona: datosRegistro.idPersona,
                activoActual: datosRegistro.activo,
                codigo: datosRegistro.nuevoActivo,
                registroSalida: casoSalida,      
            },
            success: function(res) {
                console.log(res);
                datatableRegistrosSalida();
                $('#informacionRegistro').css('display', 'none'); 

                $('.textoPersona').text(obtenerNombrePersona());
                if(casoSalida == 'salidaVehiculoActivo' || casoSalida == 'salidaPersonaActivo'){
                    if(datosRegistro.nuevoActivo != ''){
                        $('.textoActivo').text('Computador ' + datosRegistro.nuevoActivo);
                    } else {
                        $('.textoActivo').text(datosRegistro.tipoActivo + ' ' + datosRegistro.activo); 
                    }
                    if(casoSalida == 'salidaVehiculoActivo'){
                        $('.textoVehiculo').text(datosRegistro.vehiculo);
                        $('#modal-salida-personaVehiculoActivo').modal('show');  
                    } else if(casoSalida == 'salidaPersonaActivo'){
                        $('#modal-salida-personaActivo').modal('show');
                    }
                } else if(casoSalida == 'salidaPersonaVehiculo'){
                    $('.textoVehiculo').text(datosRegistro.vehiculo);
                    $('#modal-salida-personaVehiculo').modal('show');
                } else if(casoSalida == 'salidaPersona'){
                    $('#modal-salida-persona').modal('show');
                }
            },
            error: function() {
                console.log('Error al registrar la salida de la persona');
            }
        });
    });

    //Botón que permite desplegar un modal de confirmación cuando el usuario quiera realizar el registro de una salida de un vehículo al cuál no se le habia hecho el registro antes
    $('#botonGuardarSalida2').on('click', function () {
        $('#textoSalida2').text(datosRegistroVehiculo.vehiculo);
        $('#modal-registrarSalidaVehiculo').modal('show');
    });
    
    //Botón que envía una petición Ajax al servidor para modificar la base de datos y registrar la salida de un vehículo al cual no se le haya registrado su salida el día que ingreso, si el registro es exito muestra un modal con la información del registro
    $('#botonContinuarSalida2').on('click', function () {
        $('#modal-registrarSalidaVehiculo').modal('hide');
        $.ajax({
            url: '/registros/salida_persona/' + datosRegistroVehiculo.idRegistro,
            type: 'PUT',
            data: {
                registroSalida: 'salidaVehiculo',
            },
            success: function(res) {
                console.log(res);
                datatableRegistrosVehiculos();
                $('#infoRegistroVehiculo').css('display', 'none'); 
                $('#textoVehiculo').text(datosRegistroVehiculo.vehiculo);
                $('#modal-salida-vehiculo').modal('show');
            },
            error: function() {
                console.log('Error al registrar la salida del vehículo');
            }
        });
    });

    //Botón que permite desplegar un modal de confirmación cuando el usuario quiera realizar el registro de una salida de un activo al cuál no se le habia hecho el registro antes
    $('#botonGuardarSalida3').on('click', function () {
        $('#textoSalida3').text(datosRegistroActivo.activo);
        $('#modal-registrarSalidaActivo').modal('show');
    });

    //Botón que envía una petición Ajax al servidor para modificar la base de datos y registrar la salida de un activo al cual no se le haya registrado su salida el día que ingreso, si el registro es exito muestra un modal con la información del registro
    $('#botonContinuarSalida3').on('click', function () {
        $('#modal-registrarSalidaActivo').modal('hide');
        $.ajax({
            url: '/registros/salida_persona/' + datosRegistroActivo.idRegistro,
            type: 'PUT',
            data: {             
                registroSalida: 'salidaActivo',
            },
            success: function(res) {
                console.log(res);
                datatableRegistrosActivos();
                $('#infoRegistroActivo').css('display', 'none'); 
                $('#textoActivo').text(datosRegistroActivo.activo);
                $('#modal-salida-activo').modal('show');
            },
            error: function() {
                console.log('Error al registrar la salida del activo');
            }
        }); 
    });

    //Botón que permite ocultar el panel de información de la persona si selecciono para registrar su salida
    $('#botonCerrar').click(function(){
        $('#informacionRegistro').css('display', 'none'); 
    });

    //Botón que permite ocultar el panel de información de los vehículos si selecciono para registrar su salida
    $('#botonCerrar2').click(function(){
        $('#infoRegistroVehiculo').css('display', 'none'); 
    });

    //Botón que permite ocultar el panel de información de los activos si selecciono para registrar su salida
    $('#botonCerrar3').click(function(){
        $('#infoRegistroActivo').css('display', 'none'); 
    });

    //Botón que redirecciona a la vista donde se muestra los registros que se han completado totalmente
    $('.botonContinuar').click(function() {
        $(location).attr('href', '/registros/completados');
    });

});