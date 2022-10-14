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
    var estado = false;
    var buscador = "<'col-sm-12 col-md-6'f>";

    //Uso de DataTables para mostrar los registros realizados en los cuales no se registra la salida de los diferentes tipos de persona (visitantes, conductores, colaboradores con y sin activo)
    function datatableRegistrosSalida(){
        if($('#thCiudad').length){ 
            estado = true;
            buscador = '';
            $('#inputBuscar').focus();
        }
        $('#tabla_registros_salida').DataTable({
            'dom': "<'row'<'col-sm-12 col-md-6'l>" + buscador + ">" +
                "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            'destroy': true,
            'processing': true,
            'responsive': true,
            'autoWidth': false,
            // 'serverSide': true,
            // 'scrollY': '300px',
            'ajax': 'informacion_sin_salida',
            'dataType': 'json',
            'type': 'GET',
            'columns': [
                {
                    'data': 'id_registros',
                    'name': 'id_registros',
                },
                {
                    'data': 'tipopersona',
                    'name': 'tipopersona',
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
                    'data': 'city',
                    'name': 'city',
                    'visible': estado
                }, 
                {
                    'data': 'name',
                    'name': 'name',
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
        
        if(!$('#thCiudad').length){ 
            $('div.dataTables_filter input', $('#tabla_registros_salida').DataTable().table().container()).focus();
        }
    }
    datatableRegistrosSalida();

    //Uso de DataTables para mostrar los registros realizados donde se ingresa un vehículo y se registra la salida del propietario pero no del vehículo
    function datatableRegistrosVehiculos() {
        if($('#thCiudad2').length){ 
            estado = true;
            buscador = '';   
            $('#inputBuscar2').focus(); 
        } 
        $('#tabla_registros_vehiculos').DataTable({
            'dom': "<'row'<'col-sm-12 col-md-6'l>" + buscador + ">" +
                "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            'destroy': true,
            'processing': true,
            'responsive': true,
            'autoWidth': false,
            // 'serverSide': true,
            // 'scrollY': '300px',
            'ajax': 'informacion_vehiculos',
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
                    'data': 'city',
                    'name': 'city',
                    'visible': estado
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

        if(!$('#thCiudad2').length){ 
            $('div.dataTables_filter input', $('#tabla_registros_vehiculos').DataTable().table().container()).focus();
        }
    }

    //Uso de DataTables para mostrar los registros realizados donde se ingresa un activo y se registra la salida del propietario pero no del activo
    function datatableRegistrosActivos() {
        if($('#thCiudad3').length){ 
            estado = true;
            buscador = '';  
            $('#inputBuscar3').focus(); 
        } 
        $('#tabla_registros_activos').DataTable({
            'dom': "<'row'<'col-sm-12 col-md-6'l>" + buscador + ">" +
                "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            'destroy': true,
            'processing': true,
            'responsive': true,
            'autoWidth': false,
            // 'serverSide': true,
            // 'scrollY': '300px',
            'ajax': 'informacion_activos',
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
                    'data': 'city',
                    'name': 'city',
                    'visible': estado
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

        if(!$('#thCiudad3').length){ 
            $('div.dataTables_filter input', $('#tabla_registros_activos').DataTable().table().container()).focus();
        }
    }

    //Al seleccionar permite filtrar la información de la tabla de registros sin salida por el tipo de persona ingresada
    $('#selectTipoPersona').on( 'change', function () {
        $('#tabla_registros_salida').DataTable().columns( 1 ).search( this.value ).draw();
    });

    //Al seleccionar permite filtrar la información de la tabla de registros sin salida por la ciudad ingresada
    $('#selectCiudad').on( 'change', function () {
        $('#tabla_registros_salida').DataTable().columns( 9 ).search( this.value ).draw();
    });

    //Al escribir sobre el input se realiza una búsqueda en todos los campos la tabla de registros sin salida y se filtra la información que coincida con lo escrito
    $('#inputBuscar').on( 'keyup', function () {
        $('#tabla_registros_salida').DataTable().search( this.value ).draw();
    });

    //Al seleccionar permite filtrar la información de la tabla registros vehículos por el tipo de persona ingresada
    $('#selectTipoPersona2').on( 'change', function () {
        $('#tabla_registros_vehiculos').DataTable().columns( 1 ).search( this.value ).draw();
    });

    //Al seleccionar permite filtrar la información de la tabla de registros vehículos por la ciudad ingresada
    $('#selectCiudad2').on( 'change', function () {
        $('#tabla_registros_vehiculos').DataTable().columns( 10 ).search( this.value ).draw();
    });

    //Al escribir sobre el input se realiza una búsqueda en todos los campos de la tabla registros vehículos y se filtra la información que coincida con lo escrito
    $('#inputBuscar2').on( 'keyup', function () {
        $('#tabla_registros_vehiculos').DataTable().search( this.value ).draw();
    });

    //Al seleccionar permite filtrar la información de la tabla registros activos por la ciudad ingresada
    $('#selectCiudad3').on( 'change', function () {
        $('#tabla_registros_activos').DataTable().columns( 9 ).search( this.value ).draw();
    });

    //Al escribir sobre el input se realiza una búsqueda en todos los campos de la tabla registros activos y se filtra la información que coincida con lo escrito
    $('#inputBuscar3').on( 'keyup', function () {
        $('#tabla_registros_activos').DataTable().search( this.value ).draw();
    });

    //Función que se activa cuando se le da click al Tab de Personas o al botón limpiar en los filtros, actualiza la información de la Datatable de los registros sin salida y limpia los filtros realizados
    $('#tabPersonasSinSalida, #btnFiltros').click(function () {
        $('.filtros').val('');
        datatableRegistrosSalida();
    });

    //Función que se activa cuando se le da click al Tab de Vehículos o al botón limpiar en los filtros, actualiza la información de la Datatable de los registros de vehículos sin salida y limpia los filtros realizados
    $('#tabVehiculosSinSalida, #btnFiltros2').click(function () {
        $('.filtros2').val('');
        datatableRegistrosVehiculos();
    });

    //Función que se activa cuando se le da click al Tab de Activos o al botón limpiar en los filtros, actualiza la información de la Datatable de los registros de activos sin salida y limpia los filtros realizados
    $('#tabActivosSinSalida, #btnFiltros3').click(function () {
        $('.filtros3').val('');
        datatableRegistrosActivos();
    });

    //Función que permite remover las clases de la pestaña (tab) que esta seleccionado para poder reestablecerla cada vez que se seleccione un registro diferente
    function removerClases(idTab, idDatos) {
        $(idTab,).removeClass('active');
        $(idDatos).removeClass('active show');
    }

    //Función que permite reestablecer las pestañas de selección (Tabs) en la vista de personas sin salida para que sea la pestaña de Datos de ingreso la primera que se muestre al momento en que se seleccione un nuevo registro para darle salida 
    function restablecerTabs() {
        if($('#tabDatosBasicos').hasClass('active') || $('#tabDatosActivo').hasClass('active') || $('#tabDatosVehiculo').hasClass('active')){
            if($('#tabDatosBasicos').hasClass('active')){
                removerClases('#tabDatosBasicos','#datosBasicos');
            } else if($('#tabDatosActivo').hasClass('active')){
                removerClases('#tabDatosActivo','#datosActivo');
            } else {
                removerClases('#tabDatosVehiculo','#datosVehiculo');
            }
        }
        $('#tabDatosIngreso').addClass('active');
        $('#datosIngreso').addClass('active show');
    }

    //Función que permite reestablecer las pestañas de selección (Tabs) en la vista de vehículos sin salida para que sea la pestaña de Vehículo la primera que se muestre al momento en que se seleccione un nuevo registro para darle salida 
    function restablecerTabsVehiculo() {
        if($('#tabDatosIngreso2').hasClass('active') || $('#tabDatosBasicos2').hasClass('active')){
            if($('#tabDatosIngreso2').hasClass('active')){
                removerClases('#tabDatosIngreso2', '#datosIngreso2');
            } else {
                removerClases('#tabDatosBasicos2', '#datosBasicos2');
            } 
        }
        $('#tabDatosVehiculo2').addClass('active');
        $('#datosVehiculo2').addClass('active show');
    }

    //Función que permite reestablecer las pestañas de selección (Tabs) en la vista de activos sin salida para que sea la pestaña de Activo la primera que se muestre al momento en que se seleccione un nuevo registro para darle salida 
    function restablecerTabsActivo() {
        if($('#tabDatosIngreso3').hasClass('active') || $('#tabDatosBasicos3').hasClass('active')){
            if($('#tabDatosIngreso3').hasClass('active')){
                removerClases('#tabDatosIngreso3', '#datosIngreso3');
            } else {
                removerClases('#tabDatosBasicos3', '#datosBasicos3');
            } 
        }
        $('#tabDatosActivo3').addClass('active');
        $('#datosActivo3').addClass('active show');
    }

    //Función que permite cambiar el tamaño del espacio que va a ocupar las imagenes en los registros, para los visitantes y conductores la fotografía ocupa más espacio y para los colaboradores la imagen del logo ocupa menos espacio
    function establecerImagen(tipoPersona, columnaFoto, columnaInformacion) {
        if(tipoPersona == 1 || tipoPersona == 4){
            if($(columnaFoto).hasClass('col-md-2')){
                $(columnaFoto).removeClass('col-md-2');
                $(columnaFoto).addClass('col-md-3');
                $(columnaInformacion).removeClass('col-md-10');
                $(columnaInformacion).addClass('col-md-9'); 
            }

        } else {
            if($(columnaFoto).hasClass('col-md-3')){
                $(columnaFoto).removeClass('col-md-3');
                $(columnaFoto).addClass('col-md-2');
                $(columnaInformacion).removeClass('col-md-9');
                $(columnaInformacion).addClass('col-md-10');
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

    //Función que permite dar formato a un dato de tipo Datetime separando la fecha y hora en valores diferentes, estos valores se muestran en la vista en forma de texto
    function formatoFechaHora(spanFecha, spanHora, fechaHora) {
        $(spanFecha).text(moment(fechaHora).format('DD-MM-YYYY'));
        $(spanHora).text(moment(fechaHora).format('h:mm:ss a'));
    }

    //Al momento en que se carga la página se ocultan elemetos al usuario para esta vista y se cambia el tamaño de varias columnas para mostar de mejor manera la información
    $('#tabHistorial').css('display', 'none');
    $('#infoSalidaPersona').css('display', 'none');
    $('#infoSalidaVehiculo').css('display', 'none');
    $('#infoSalidaActivo').css('display', 'none');
    $('.columnaPanel').removeClass('col-md-3');
    $('.columnaPanel').addClass('col-md-4');

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
            $('#fotoVehiculo').attr('src', '../' + data.foto_vehiculo);
            formatoFechaHora('#spanFechaVehiculo', '#spanHoraVehiculo', data.ingreso_vehiculo);
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
            $('#autorizacion').text('');
            $('#columnaActivo').css('display', 'none');
            $('#divActivo').css('display', '');
            formatoFechaHora('#spanFechaActivo', '#spanHoraActivo', data.ingreso_activo);
            $('#spanTipoActivo').text(data.activo);
            $('#spanCodigoActivo').text(data.codigo_activo);  
            $('#tabDatosActivo').css('display', 'block');
        } else {
            $('#tabDatosActivo').css('display', 'none');
        }
    
        formatoFechaHora('#spanFecha', '#spanHora', data.ingreso_persona);
        $('#spanNombre').text(data.nombre);
        $('#spanApellido').text(data.apellido);
        $('#spanIdentificacion').text(data.identificacion);
        $('#spanTelefono').text(data.tel_contacto);
        $('#spanEps').text(data.eps);
        $('#spanArl').text(data.arl); 
        $('#parrafoDescripcion').text(data.descripcion);

        if($('#botonGuardarSalida').prop('disabled')){
            $('#botonGuardarSalida').prop('disabled', false);
        }

        if(data.id_tipo_persona == 1 || data.id_tipo_persona == 4){
            establecerImagen(data.id_tipo_persona, '#columnaFoto', '#columnaInformacion');
            $('#divLogoEmpresa').css('display', 'none');
            $('#fotoPersona').attr('src', '../' + data.foto).on('load', function() {
                $('#divFotoPersona').css('display', 'block');
            });       
            $('#spanEmpresa').text(data.empresavisitada); 
            $('#spanColaborador').text(data.colaborador); 
            $('#spanFicha').text(data.ficha); 
            parametrosPanel(data.id_tipo_persona, '#infoColaborador', '#infoVisitanteConductor', '#tabInfoRegistro', '#tituloTelefono');
            if(data.id_tipo_persona == 1){
                $('#divActivo').css('display', 'none');
            }      

        } else if(data.id_tipo_persona == 2 || data.id_tipo_persona == 3){
            establecerImagen(data.id_tipo_persona, '#columnaFoto', '#columnaInformacion');
            var urlLogo = '../assets/imagenes/' + data.empresa.toLowerCase() +'.png';
            $('#divFotoPersona').css('display', 'none');
            $('#logoEmpresa').attr('src', urlLogo).on('load', function() {
                $('#divLogoEmpresa').css('display', 'block');
            }); 
            $('#spanCorreo').text(data.email); 
            $('#spanEmpresaCol').text(data.empresa);
            parametrosPanel(data.id_tipo_persona, '#infoColaborador', '#infoVisitanteConductor', '#tabInfoRegistro', '#tituloTelefono');
            if(data.id_tipo_persona == 2){
                $('#divActivo').css('display', 'none');
            } 
            if(data.id_tipo_persona == 3 && data.ingreso_activo !=  null){
                removerClases('#tabDatosIngreso', '#datosIngreso');
                $('#tabDatosActivo').addClass('active');
                $('#datosActivo').addClass('active show');
                obtenerActivoActualizado(data.identificacion, data.codigo_activo, '#botonGuardarSalida', 1);
            }
        } 
        $('#informacionRegistro').css('display', 'block');  
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

        formatoFechaHora('#spanFecha2', '#spanHora2', data.ingreso_persona);
        $('#spanNombre2').text(data.nombre);
        $('#spanApellido2').text(data.apellido);
        $('#spanIdentificacion2').text(data.identificacion);
        $('#spanTelefono2').text(data.tel_contacto);
        $('#spanEps2').text(data.eps);
        $('#spanArl2').text(data.arl); 
        $('#parrafoDescripcion2').text(data.descripcion);

        $('#fotoVehiculo2').attr('src', '../' + data.foto_vehiculo);
        formatoFechaHora('#spanFechaVehiculo2', '#spanHoraVehiculo2', data.ingreso_vehiculo);
        $('#spanIdentificador2').text(data.identificador);
        $('#spanTipo2').text(data.tipo);
        $('#spanMarca2').text(data.marca);

        if(data.id_tipo_persona == 1 || data.id_tipo_persona == 4){
            establecerImagen(data.id_tipo_persona, '#columnaFoto2', '#columnaInformacion2');
            $('#divLogoEmpresa2').css('display', 'none');
            $('#fotoPersona2').attr('src', '../' + data.foto).on('load', function() {
                $('#divFotoPersona2').css('display', 'block');
            });       
            $('#spanEmpresa2').text(data.empresavisitada); 
            $('#spanColaborador2').text(data.colaborador);
            $('#spanFicha2').text(data.ficha); 
            parametrosPanel(data.id_tipo_persona, '#infoColaborador2', '#infoVisitanteConductor2', '#tabInfoRegistro2', '#tituloTelefono2');

        } else if(data.id_tipo_persona == 2 || data.id_tipo_persona == 3){
            establecerImagen(data.id_tipo_persona, '#columnaFoto2', '#columnaInformacion2');
            var urlLogo = '../assets/imagenes/' + data.empresa.toLowerCase() +'.png';
            $('#divFotoPersona2').css('display', 'none');
            $('#logoEmpresa2').attr('src', urlLogo).on('load', function() {
                $('#divLogoEmpresa2').css('display', 'block');
            }); 
            $('#spanCorreo2').text(data.email); 
            $('#spanEmpresaCol2').text(data.empresa);
            parametrosPanel(data.id_tipo_persona, '#infoColaborador2', '#infoVisitanteConductor2', '#tabInfoRegistro2', '#tituloTelefono2');
        }        
        $('#infoRegistroVehiculo').css('display', 'block'); 
    });

    //Se elije una fila de la tabla de registros sin salida de vehículos y se toma la información del registro para mostrarla en un panel de pestañas de selección de manera organizada dependiendo del tipo de persona, se muestra primero la información del vehículo
    $('#tabla_registros_activos tbody').on('click', '.registrar_salidaActivo', function () { 
        var data = $('#tabla_registros_activos').DataTable().row(this).data(); 
        restablecerTabsActivo();
        $('#columnaActivo2').css('display', 'none');
        $('#autorizacion3').text('');
        obtenerActivoActualizado(data.identificacion, data.codigo_activo, '#botonGuardarSalida3', 2);

        datosRegistroActivo.idRegistro = data.id_registros;
        datosRegistroActivo.idPersona = data.id_persona; 
        datosRegistroActivo.tipoActivo = data.activo; 
        datosRegistroActivo.activo = data.codigo_activo;
        datosRegistroActivo.nuevoActivo = '';
        
        var urlLogo = '../assets/imagenes/' + data.empresa.toLowerCase() +'.png';
        $('#logoEmpresa3').attr('src', urlLogo);

        formatoFechaHora('#spanFecha3', '#spanHora3', data.ingreso_persona);
        $('#spanNombre3').text(data.nombre);
        $('#spanApellido3').text(data.apellido);
        $('#spanIdentificacion3').text(data.identificacion);
        $('#spanTelefono3').text(data.tel_contacto);
        $('#spanEps3').text(data.eps);
        $('#spanArl3').text(data.arl); 
        $('#spanCorreo3').text(data.email); 
        $('#spanEmpresaCol3').text(data.empresa);
        $('#parrafoDescripcion3').text(data.descripcion);

        formatoFechaHora('#spanFechaActivo3', '#spanHoraActivo3', data.ingreso_activo);
        $('#spanTipoActivo3').text(data.activo);
        $('#spanCodigoActivo3').text(data.codigo_activo); 
        
        $('#infoRegistroActivo').css('display', 'block'); 
    });

    //Función que envía una petición Ajax al servidor para consultar en el sistema GLPI si a un colaborador en específico se le ha cambiado el código del activo asignado, si esto sucede el sistema ubica al usuario en la pestaña de Activo y muestra cual es el nuevo código que tiene asignado el colaborador, así como si esta autorizado para salir o no
    function obtenerActivoActualizado(identificacion, codigoActual, botonSalida, num) {
        $(botonSalida).prop('disabled', true);
        $.ajax({
            url: '../colaboradores/colaboradoridentificado',
            type: 'GET',
            data: {
                colaborador: identificacion,
                tipoBusqueda: 0,
            },
            dataType: 'json',
            success: function(response) { 
                if('registration_number' in response){
                    $.ajax({
                        url: '../colaboradores/computador',
                        type: 'GET',
                        data: {
                            colaborador: response.id,
                        },
                        dataType: 'json',
                        success: function(activo) {
                            function mostrarAutorizacionConCambioActivo(spanActivo, autorizacion, columna) {
                                if(activo.autorizacion != null){
                                    $(spanActivo).text(activo.name);  
                                    $(autorizacion).css('color', '#4ae11e');
                                    $(autorizacion).text(activo.autorizacion);
                                    $(columna).css({
                                        'display': '',
                                        'border-left': '5px solid #4ae11e'
                                    });
                                    $(botonSalida).prop('disabled', false);
                                } else {
                                    $(spanActivo).text(activo.name);  
                                    $(autorizacion).css('color', '#dc3545');
                                    $(autorizacion).text('Sin autorización para ser retirado de la empresa');
                                    $(columna).css({
                                        'display': '',
                                        'border-left': '5px solid red'
                                    });
                                }
                            }

                            function mostrarAutorizacionSinCambioActivo(autorizacion) {
                                if(activo.autorizacion != null){
                                    $(autorizacion).css('color', '#4ae11e');
                                    $(autorizacion).text(activo.autorizacion);
                                    $(botonSalida).prop('disabled', false);
                                } else {  
                                    $(autorizacion).css('color', '#dc3545');
                                    $(autorizacion).text('Sin autorización para ser retirado de la empresa');
                                }
                            }

                            if(num == 1){
                                if(activo.name != codigoActual){
                                    datosRegistro.nuevoActivo = activo.name;
                                    mostrarAutorizacionConCambioActivo('#spanCodigoActivo2', '#autorizacion2', '#columnaActivo');
                                } else {
                                    mostrarAutorizacionSinCambioActivo('#autorizacion');
                                }
                            } else {
                                if(activo.name != codigoActual){
                                    datosRegistroActivo.nuevoActivo = activo.name;
                                    mostrarAutorizacionConCambioActivo('#spanCodigoActivo4', '#autorizacion4', '#columnaActivo2');
                                } else {
                                    mostrarAutorizacionSinCambioActivo('#autorizacion3');
                                }
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
    });

    //Función que se activa cuando el usuario le da click al checkbox de verificar si una persona sale sin su activo, esto hace que a la variable casoSalida se le asigne información que será utilizada para no tener en cuenta la salida del activo, también si el activo ha sido actualizado en GLPI al hacer click permite habilitar o desahabilitar el botón de guardar salida dependiendo si el activo tiene o no autorización para salir
    $('#checkActivo').on('click', function () {
        if ($('#checkActivo').is(':checked')) {
            if(casoSalida == 'salidaVehiculoActivo'){
                casoSalida = 'salidaPersonaVehiculo';
            } else if(casoSalida == 'salidaPersonaActivo'){
                casoSalida = 'salidaPersona';
            }
            if(($('#columnaActivo').css('display') != 'none' && $('#columnaActivo').css('border-left-color') == 'rgb(255, 0, 0)') || ($('#autorizacion').text() != '' && $('#autorizacion').css('color') == 'rgb(220, 53, 69)')){
                if($('#botonGuardarSalida').prop('disabled', true)){
                    $('#botonGuardarSalida').prop('disabled', false);
                }
            }         
        } else {
            if(casoSalida == 'salidaPersonaVehiculo'){
                casoSalida = 'salidaVehiculoActivo';
            } else if(casoSalida == 'salidaPersona'){
                casoSalida = 'salidaPersonaActivo';
            }
            if(($('#columnaActivo').css('display') != 'none' && $('#columnaActivo').css('border-left-color') == 'rgb(255, 0, 0)') || ($('#autorizacion').text() != '' && $('#autorizacion').css('color') == 'rgb(220, 53, 69)')){
                if($('#botonGuardarSalida').prop('disabled', false)){
                    $('#botonGuardarSalida').prop('disabled', true);
                }
            }
        }
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
            url: 'salida_persona/' + datosRegistro.idRegistro,
            type: 'PUT',
            data: {
                idPersona: datosRegistro.idPersona,
                activoActual: datosRegistro.activo,
                codigo: datosRegistro.nuevoActivo,
                registroSalida: casoSalida,      
            },
            success: function(res) {   
                $('#btnFiltros').trigger('click');
                $('#informacionRegistro').css('display', 'none'); 

                $('.textoPersona').text(obtenerNombrePersona());
                if(casoSalida == 'salidaVehiculoActivo' || casoSalida == 'salidaPersonaActivo'){
                    if(datosRegistro.nuevoActivo != ''){
                        $('.textoActivo').text(datosRegistro.tipoActivo + ' '  + datosRegistro.nuevoActivo);
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
            url: 'salida_persona/' + datosRegistroVehiculo.idRegistro,
            type: 'PUT',
            data: {
                registroSalida: 'salidaVehiculo',
            },
            success: function(response) {
                if('persona' in response) {
                    console.log(response);
                    if($('#parrafoPersona2').length){ $('#parrafoPersona2').remove(); }  
                    $('#parrafoVehiculo2').before(`<p id="parrafoPersona2">Se registro la salida del <b>${response.persona}</b> exitosamente.</p>`);
                } else {

                }
                
                $('#btnFiltros2').trigger('click');
                $('#infoRegistroVehiculo').css('display', 'none'); 
                $('#textoVehiculo').text(datosRegistroVehiculo.vehiculo);
                $('#modal-salida-vehiculo').modal('show');
            },
            error: function() {
                console.log('Error al registrar la salida del vehículo');
            }
        });
    });

    //Función que permite asignar un mensaje en los modales de los registros de salida de activos dependiendo si se ha hecho o no algún cambio en el sistema GLPI con respecto al activo que el colaborador tenga asignado
    function asiganarMensaje(elemento) {
        if(datosRegistroActivo.nuevoActivo != ''){
            $(elemento).text(datosRegistroActivo.tipoActivo + ' ' + datosRegistroActivo.nuevoActivo);
        } else {
            $(elemento).text(datosRegistroActivo.tipoActivo + ' ' + datosRegistroActivo.activo);
        }
    }

    //Botón que permite desplegar un modal de confirmación cuando el usuario quiera realizar el registro de una salida de un activo al cuál no se le habia hecho el registro antes
    $('#botonGuardarSalida3').on('click', function () {
        asiganarMensaje('#textoSalida3');
        $('#modal-registrarSalidaActivo').modal('show');
    });

    //Botón que envía una petición Ajax al servidor para modificar la base de datos y registrar la salida de un activo al cual no se le haya registrado su salida el día que ingreso, si el registro es exito muestra un modal con la información del registro
    $('#botonContinuarSalida3').on('click', function () {
        $('#modal-registrarSalidaActivo').modal('hide');
        $.ajax({
            url: 'salida_activo/' + datosRegistroActivo.idRegistro,
            type: 'PUT',
            dataType : 'json',
            data: {  
                idPersona: datosRegistroActivo.idPersona,           
                activoActual: datosRegistroActivo.activo,
                codigo: datosRegistroActivo.nuevoActivo,
            },
            success: function(response) {
                if('id_persona' in response){
                    $.ajax({
                        url: 'estado_vehiculo',
                        type: 'GET',
                        dataType : 'json',
                        data: {  
                            idPersona: response.id_persona
                        },
                        success: function(estadoVehiculo) {
                            if('vehiculo_ingresado' in estadoVehiculo || 'vehiculo_permutado' in estadoVehiculo){
                                if('vehiculo_ingresado' in estadoVehiculo){
                                    $('#mensajeVehiculo').html(`El colaborador ingreso con el vehículo <b>${estadoVehiculo.vehiculo_ingresado}</b>`);
                                    datosRegistroActivo.identificadorVehiculo = estadoVehiculo.vehiculo_ingresado; 
                                } else {
                                    $('#mensajeVehiculo').html(`El colaborador tiene en las instalaciones el vehículo <b>${estadoVehiculo.vehiculo_permutado}</b>`);
                                    datosRegistroActivo.identificadorVehiculo = estadoVehiculo.vehiculo_permutado; 
                                } 
                                datosRegistroActivo.idRegistroVehiculo = estadoVehiculo.registro; 
                                datosRegistroActivo.nombrePersona = response.persona; 
                                $('#modal-infoEstadoVehiculo').modal('show');
                            } else {
                                if($('#parrafoPersona').length){ $('#parrafoPersona').remove(); }  
                                if($('#parrafoVehiculo').length){ $('#parrafoVehiculo').remove(); } 
                                $('#parrafoActivo').before(`<p id="parrafoPersona">Se registro la salida del <b>colaborador ${response.persona}</b> exitosamente.</p>`);
                                asiganarMensaje('#textoActivo');
                                $('#modal-salida-activo').modal('show');
                            }   
                        },
                        error: function() {
                            console.log('Error obteniendo los datos de la base de datos');
                        }
                    }); 
                } else {
                    asiganarMensaje('#textoActivo');
                    $('#modal-salida-activo').modal('show');
                }
                $('#btnFiltros3').trigger('click');
                $('#infoRegistroActivo').css('display', 'none'); 
            },
            error: function() {
                console.log('Error al registrar la salida del activo');
            }
        }); 
    });

    //Botón que envía una petición Ajax al servidor para registrar la salida de un vehículo, esto solo si se esta registrando la salida desde la vista de Activos en los registros sin salida, si el registro es exito muestra un modal con la información del registro
    $('#btnSalidaVehiculo').click(function(){
        $.ajax({
            url: 'estado_vehiculo',
            type: 'PUT',
            data: {  
                idRegistro: datosRegistroActivo.idRegistroVehiculo
            },
            success: function() {
                if($('#parrafoPersona').length){ $('#parrafoPersona').remove(); }  
                if($('#parrafoVehiculo').length){ $('#parrafoVehiculo').remove(); } 
                $('#parrafoActivo').before(`<p id="parrafoPersona">Se registro la salida del <b>colaborador ${datosRegistroActivo.nombrePersona}</b> exitosamente.</p>`);
                $('#parrafoActivo').after(`<p id="parrafoVehiculo">Se registro la salida del vehículo <b>${datosRegistroActivo.identificadorVehiculo}</b> exitosamente.</p>`);
                asiganarMensaje('#textoActivo');
                $('#modal-salida-activo').modal('show');
            },
            error: function() {
                console.log('Error obteniendo los datos de la base de datos');
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
        $(location).attr('href', '../registros/completados');
    });

});