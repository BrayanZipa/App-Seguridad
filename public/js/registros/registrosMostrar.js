$(function() { 
    
    const fecha = new Date();
    var idPersona = '';

    //Uso de DataTables para mostrar los registros realizados en donde se completo tanto las entradas como salidas de todos los tipos de persona (visitantes, conductores, colaboradores con y sin activo)
    var estado = false;
    if($('#thCiudad').length){ 
        estado = true;
    } 

    var tablaRegistros = $('#tabla_registros').DataTable({
        'dom': "<'row'<'col-sm-12 col-md-6'l>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        'destroy': true,
        'processing': true,
        'responsive': true,
        'autoWidth': false,
        // 'serverSide': true,
        // 'scrollY': '300px',
        'ajax': 'informacion',
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
                // 'searchable': false,
                // 'orderable': false
            },
            {
                'class': 'consultar_registro',
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
    $('#inputBuscar').focus();

    //Al escribir sobre el input se realiza una búsqueda en todos los campos la tabla registros y se filtra la información que coincida con lo escrito
    $('#inputBuscar').on( 'keyup', function () {
        tablaRegistros.search( this.value ).draw();
    });

    //Al seleccionar permite filtrar la información de la tabla registros por el tipo de persona ingresada
    $('#selectTipoPersona').on( 'change', function () {
        tablaRegistros.columns( 1 ).search( this.value ).draw();
    });

    //Al seleccionar permite filtrar la información de la tabla registros por la ciudad ingresada
    $('#selectCiudad').on( 'change', function () {
        tablaRegistros.columns( 10 ).search( this.value ).draw();
    });

    //Al seleccionar permite filtrar la información de la tabla registros dependiendo si se ingreso o no un activo
    $('#selectIngresoActivo').on( 'change', function () {
        if($('#selectIngresoActivo').val() == 'Si'){
            tablaRegistros.column( 8 ).search('[a-zñA-ZÑ0-9]{3,}', true, false).draw();
        } else {
            tablaRegistros.columns( 8 ).search('No').draw();
        }
    });

     //Al seleccionar permite filtrar la información de la tabla registros dependiendo si se ingreso o no un vehículo
    $('#selectIngresoVehiculo').on( 'change', function () {
        if($('#selectIngresoVehiculo').val() == 'Si'){
            tablaRegistros.column( 9 ).search('[a-zñA-ZÑ0-9]{3,}', true, false).draw();
        } else {
            tablaRegistros.columns( 9 ).search('No').draw();
        }
    });

    //Función propia del plugin de DateRangePicker con el cual se da formato y funcionamiento al input donde se filtra la información de la tabla registros por fecha de ingreso 
    $('#inputFechaIngreso').daterangepicker({
        autoUpdateInput: false,
        showDropdowns: true,
        minYear: 2021,
        opens: 'left',
        locale: {
            applyLabel: 'Aplicar',
            cancelLabel: 'Cancelar'
        },
    });

    //Botón que se forma mediante los estilos del plugin de DateRangePicker y que al oprimirse permite guardar el rango de fecha seleccionado en una cadena de string como value del input de filtro de fecha de ingreso
    $('#inputFechaIngreso').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
        tablaRegistros.draw();
    });

    //Función propia del plugin de DateRangePicker con el cual se da formato y funcionamiento al input donde se filtra la información de la tabla registros por fecha de salida
    $('#inputFechaSalida').daterangepicker({
        autoUpdateInput: false,
        showDropdowns: true,
        minYear: 2021,
        opens: 'right',
        locale: {
            applyLabel: 'Aplicar',
            cancelLabel: 'Cancelar'
        },
    });

    //Botón que se forma mediante los estilos del plugin de DateRangePicker y que al oprimirse permite guardar el rango de fecha seleccionado en una cadena de string como value del input de filtro de fecha de salida
    $('#inputFechaSalida').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
        tablaRegistros.draw();
    });

    //Función que permite obtener por separado las dos fechas de un rango de fechas elegido, estas fechas se comparan con las fechas que se muestran en la tabla registros para determinar que fechas hacen parte del rango seleccionado
    function obtenerRangoFechas(inputFecha, fechaDataTable) {
        var fechas = $(inputFecha).val().split('-');
        var fechaIngreso = fechaDataTable.split('-').reverse().join('-');
        var fechaInicial = fechas[0].trim().split('/').reverse().join('-');
        var fechaFinal = fechas[1].trim().split('/').reverse().join('-');
            
        if ((Date.parse(fechaInicial) <= Date.parse(fechaIngreso) && Date.parse(fechaIngreso) <= Date.parse(fechaFinal))){
            return true;
        }
        return false;
    }
    
    //Función propia del plugin DataTables que permite añadir filtros mediante condicionales, dentro de esta función se agrega el filtro que permite consultar la información de la tabla registros por un rango de fecha de ingreso seleccionado
    $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            if ($('#inputFechaIngreso').val() != '') {
                return obtenerRangoFechas('#inputFechaIngreso', data[4]);
            }
            return true;
        }
    );

    //Función propia del plugin DataTables que permite añadir filtros mediante condicionales, dentro de esta función se agrega el filtro que permite consultar la información de la tabla registros por un rango de fecha de salida seleccionado
    $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            if ($('#inputFechaSalida').val() != '') {
                return obtenerRangoFechas('#inputFechaSalida', data[6]);
            }
            return true;   
        }
    );

    //Botón que permite limpiar la información de los filtros de la tabla registros y reestablecer su información 
    $('#btnFiltros').click(function () {
        $('.filtros').val('');
        tablaRegistros.search('').columns().search('').draw();
    });

    //Función que permite reestablecer las pestañas de selección (Tabs) en la vista para que sea la pestaña inicial la primera que se muestre al momento en que se seleccione un nuevo registro para ser consultado
    function restablecerTabs() {
        if($('#tabDatosBasicos').hasClass('active') || $('#tabDatosActivo').hasClass('active') || $('#tabDatosVehiculo').hasClass('active') || $('#tabHistorial').hasClass('active')){
            function removerClases(idTab, idDatos) {
                $(idTab,).removeClass('active');
                $(idDatos).removeClass('active show');
            }
            
            if($('#tabDatosBasicos').hasClass('active')){
                removerClases('#tabDatosBasicos','#datosBasicos');
            } else if($('#tabDatosActivo').hasClass('active')){
                removerClases('#tabDatosActivo','#datosActivo');
            } else if($('#tabDatosVehiculo').hasClass('active')) {
                removerClases('#tabDatosVehiculo','#datosVehiculo');
            } else {
                removerClases('#tabHistorial', '#historial');
            }
            $('#tabDatosIngreso').addClass('active');
            $('#datosIngreso').addClass('active show');
        }
    }

    //Función que permite dar formato a un dato de tipo Datetime separando la fecha y hora en valores diferentes, estos valores se muestran en la vista en forma de texto
    function formatoFechaHora(spanFecha, spanHora, fechaHora) {
        $(spanFecha).text(moment(fechaHora).format('DD-MM-YYYY'));
        $(spanHora).text(moment(fechaHora).format('h:mm:ss a'));
    }

    //Se elije una fila de la tabla de registros completados y se toma la información del registro para mostrarla en un panel de pestañas de selección de manera organizada dependiendo del tipo de persona
    $('#tabla_registros tbody').on('click', '.consultar_registro', function () { 
        var data = $('#tabla_registros').DataTable().row(this).data(); 
        idPersona = data.id_persona;
        $('#selectAnio').val(fecha.getFullYear());
        $('#totalRegistros').val('');
        $('#tablaRegistrosFilas').empty();  
        $('#tablaRegistros').css('display', 'none');
        $('#selectMes').val('');
        restablecerTabs();

        if(data.ingreso_vehiculo != null){
            $('#divVehiculo').css('display', 'none');
            $('#fotoVehiculo').attr('src', '../' + data.foto_vehiculo);
            formatoFechaHora('#spanFechaVehiculo', '#spanHoraVehiculo', data.ingreso_vehiculo);
            if(data.salida_vehiculo != null){
                formatoFechaHora('#spanFechaSalidaVehiculo', '#spanHoraSalidaVehiculo', data.salida_vehiculo);
            }     
            $('#spanIdentificador').text(data.identificador);
            $('#spanTipo').text(data.tipo);  
            $('#spanMarca').text(data.marca);   
            $('#tabDatosVehiculo').css('display', 'block');
        } else {
            $('#tabDatosVehiculo').css('display', 'none');
        }

        if(data.ingreso_activo != null || (data.ingreso_activo == null && data.salida_activo != null)){
            $('#divActivo').css('display', 'none');
            $('#spanTipoActivo').text(data.activo);
            if(data.ingreso_activo != null){
                formatoFechaHora('#spanFechaActivo', '#spanHoraActivo', data.ingreso_activo);
                $('#spanCodigoActivo').text(data.codigo_activo);
            }
            if(data.salida_activo != null){
                formatoFechaHora('#spanFechaSalidaActivo', '#spanHoraSalidaActivo', data.salida_activo);
            }  
            if(data.codigo_activo_salida != null){
                if(data.ingreso_activo  == null){
                    $('#tituloActivo').text('Asignación de activo');
                    $('#spanFechaActivo').text('Sin ingreso');
                    $('#spanHoraActivo').text('Sin ingreso');
                    if(data.codigo_activo != null){ 
                        $('#spanCodigoActivo').text(data.codigo_activo);
                    } else {
                        $('#spanCodigoActivo').text('Sin activo inicial'); 
                    }
                } else {
                    $('#tituloActivo').text('Cambio de activo');
                }
                $('#spanCodigoActivo2').text(data.codigo_activo_salida); 
                $('#columnaActivo').css('display', '');
            }  else {
                $('#columnaActivo').css('display', 'none');
            }
            $('#tabDatosActivo').css('display', 'block');
        } else {
            $('#tabDatosActivo').css('display', 'none');
        }

        formatoFechaHora('#spanFecha', '#spanHora', data.ingreso_persona);
        formatoFechaHora('#spanFechaSalida', '#spanHoraSalida', data.salida_persona);
        $('#spanNombre').text(data.nombre);
        $('#spanApellido').text(data.apellido);
        $('#spanIdentificacion').text(data.identificacion);
        $('#spanTelefono').text(data.tel_contacto);
        $('#spanEps').text(data.eps);
        $('#spanArl').text(data.arl); 
        $('#parrafoDescripcion').text(data.descripcion);

        if(data.id_tipo_persona == 1 || data.id_tipo_persona == 4){
            if($('#columnaFoto').hasClass('col-md-2')){
                $('#columnaFoto').removeClass('col-md-2');
                $('#columnaFoto').addClass('col-md-3');
                $('#columnaInformacion').removeClass('col-md-10');
                $('#columnaInformacion').addClass('col-md-9'); 
            }     
            $('#infoColaborador').css('display', 'none');            
            $('#spanEmpresa').text(data.empresavisitada); 
            $('#spanColaborador').text(data.colaborador);
            $('#spanFicha').text(data.ficha); 
            $('#infoVisitanteConductor').css('display', '');  
            
            $('#divLogoEmpresa').css('display', 'none');
            $('#fotoPersona').attr('src', '../' + data.foto).on('load', function() {
                $('#divFotoPersona').css('display', 'block');
            });

            if(data.id_tipo_persona == 1 ){
                $('#tabInfoRegistro').text('Registro visitante');
                $('#tituloTelefono').text('Teléfono de emergencia'); 
            } else {
                $('#tabInfoRegistro').text('Registro conductor');
                $('#tituloTelefono').text('Teléfono de contacto'); 
            }

        } else if(data.id_tipo_persona == 3 || data.id_tipo_persona == 2){
            if($('#columnaFoto').hasClass('col-md-3')){
                $('#columnaFoto').removeClass('col-md-3');
                $('#columnaFoto').addClass('col-md-2');
                $('#columnaInformacion').removeClass('col-md-9');
                $('#columnaInformacion').addClass('col-md-10');
            }
            $('#infoVisitanteConductor').css('display', 'none'); 
            $('#tabInfoRegistro').text('Registro colaborador');
            $('#tituloTelefono').text('Teléfono de contacto'); 
            $('#spanCorreo').text(data.email); 
            $('#spanEmpresaCol').text(data.empresa);
            $('#infoColaborador').css('display', '');

            var urlLogo = '../assets/imagenes/' + data.empresa.toLowerCase() +'.png';
            $('#divFotoPersona').css('display', 'none');
            $('#logoEmpresa').attr('src', urlLogo).on('load', function() {
                $('#divLogoEmpresa').css('display', 'block');
            }); 
        }

        $('#footerPanel').css('display', 'none');  
        $('#informacionRegistro').css('display', 'block');  
    });

    //Función que envía una petición Ajax al servidor para consultar todos los registros de una persona en específico filtrados por el año y el mes que el usuario haya seleccionado, estos registros se organizan del más reciente al último en la vista
    $('#selectMes').on('change', function () { 
        $('#tablaRegistros').css('display', 'none');     
        $('#tablaRegistrosFilas').empty();   
        
        $.ajax({
            url: 'listado_por_persona',
            type: 'GET',
            data: {
                persona: idPersona,
                anio: $('#selectAnio option:selected').val(),
                mes: $('#selectMes option:selected').val(),
            },
            dataType: 'json',
            success: function(response) {   
                if('registros' in response){
                    $('#totalRegistros').val(response.totalRegistros);
                    if(response.totalRegistros != 0){ 
                        $('#tablaRegistros').css('display', '');     
                        $.each(response.registros, function(key, value){   
                            if(value.identificador == null){
                                value.identificador = 'No';
                            }
                            if(value.codigo_activo == null){
                                value.codigo_activo = 'No';
                            }
    
                            $('#tablaRegistrosFilas').append(
                                `<tr>
                                <td>${moment(value.ingreso_persona).format('DD-MM-YYYY')}</td>
                                <td>${moment(value.ingreso_persona).format('h:mm:ss a')}</td>
                                <td>${moment(value.salida_persona).format('DD-MM-YYYY')}</td>
                                <td>${moment(value.salida_persona).format('h:mm:ss a')}</td>
                                <td>${value.identificador}</td>
                                <td>${value.codigo_activo}</td>
                                </tr>`
                            );
                        }); 

                        if($('#tablaRegistros')[0].clientHeight > 300){
                            $('thead > tr > th').css({ 
                                'position': 'sticky',
                                'top': '0',
                                'z-index': '10',
                                'background-color': '#fff'   
                            });

                            $('#tablaRegistros').css('height', '300px');
                            $('#tablaRegistrosFilas').css('overflow-y', 'scroll');
                        } else {
                            $('#tablaRegistros').css('height', 'auto');
                        }                     
                    } 
                }
            },
            error: function() {
                console.log('Error obteniendo los datos de la base de datos');
            }
        });
    });

    //Botón que al ser seleccionado elimina el botón registrar salida si se encuentra creado en la vista
    $('#botonCollapse').click(function(){
        if($('#footerPanel').length){ $('#footerPanel').remove(); }      
    });

    //Botón que permite ocultar el panel de información del registro de la persona si selecciono para visualizar la información
    $('#botonCerrar').click(function(){
        $('#informacionRegistro').css('display', 'none'); 
    });

});