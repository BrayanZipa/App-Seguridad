$(function() {

    //Token de Laravel
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var casoSalida = '';
    var idRegistro = '';
    var datosRegistro = {};

    //Uso de DataTables para mostrar los registros realizados de las entradas y salidas de todas las personas creadas
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
    datatableRegistrosSalida();

    //Uso de DataTables para mostrar los registros realizados de las entradas y salidas de todas las personas creadas
    function datatableRegistros() {
        $('#tabla_registros').DataTable({
            'destroy': true,
            'processing': true,
            'responsive': true,
            'autoWidth': false,
            // 'serverSide': true,
            // 'scrollY': '300px',
            'ajax': '/registros/informacion',
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
                    'data': 'tel_contacto',
                    'name': 'tel_contacto',
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
    }
    datatableRegistros();

    //Uso de DataTables para mostrar los registros realizados de las entradas y salidas de todas las personas creadas
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

    // $('#tabInfoVehiculo').on('click', function () {
        
    //     // var data = $('#tabla_registros_salida').DataTable().row('.registrar_salida').data();
    //     // console.log(data);

    //     var alto = $('#fotoPersona')[0].height;
    //     $('#cardVehiculo').css('height', alto);
        
    // });

    //Se elije una fila de la tabla de registros sin salida y se toma la información del registro para mostrarla en un panel de pestañas de selección de manera organizada
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
            tipoPersona: data.id_tipo_persona,
            nombrePersona: data.nombre + ' ' + data.apellido,
            vehiculo: data.identificador,
            activo: data.codigo_activo, 
        }

        if(data.ingreso_vehiculo != null){
            if($('#checkVehiculo').prop('checked')){
                $('#checkVehiculo').prop('checked', false);
            } 
            $('#fotoVehiculo').attr('src', data.foto_vehiculo)
            .on('load', function() {
                // console.log(this.width);
                // $('#fotoVehiculo').css('height', );
            });
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
            $('#fotoPersona').attr('src', data.foto)
            // .on('load', function() {
            //     // $('#cardPersona').css('height', this.height);
            //     $('#fotoPersona').css('height', $('#cardPersona')[0].clientHeight);
            //     console.log($('#cardPersona'));
            // });
            $('#spanEmpresa').text(data.empresavisitada); 
            $('#spanColaborador').text(data.colaborador);

            if(data.id_tipo_persona == 1 ){
                $('#tabInfoRegistro').text('Registro visitante');
                $('#tituloTelefono').text('Teléfono de emergencia'); 
            } else {
                $('#tabInfoRegistro').text('Registro conductor');
                $('#tituloTelefono').text('Teléfono de contacto'); 
            }

            // console.log($('#fotoPersona').css("height"));
            // var image = document.getElementById("fotoPersona");
            // var image = $('#fotoPersona');
            // console.log(image);
            // console.log(image.naturalHeight);

            

            // setTimeout(() => {
            //     console.log($('#fotoPersona')[0].height);
            //     $('#cardPersona').css('height', $('#fotoPersona')[0].height);
            // }, 1000);

            

            // $('#bodymenu').css('height', image.height);
        } else if(data.id_tipo_persona == 2){

        } else if(data.id_tipo_persona == 3){

        } else if(data.id_tipo_persona == 4){

        }

        // $('#form_registroSalida').attr('action', '/registros/salida_persona' + data.id_registros);    

        $('#informacionRegistro').css('display', 'block');   
        console.log(data);
        console.log(casoSalida);
        
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
    
    // (function () {
    //     'use strict'
    //     // console.log($('#fotoVehiculo')[0].height);
    //     $('#cardVehiculo').css('height', $('#fotoVehiculo')[0].height);
    //     $('#cardPersona').css('height', $('#fotoPersona')[0].height);

    // })();

    // $('#fotoVehiculo').change(function () {
    //     $('#cardVehiculo').css('height', $('#fotoVehiculo')[0].height);
    // });


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

    //Función que se activa cuando el usuario hace click en el botón de registar salida, esto envia una petición Ajax al servidor para modificar la base de datos y registrar la salida de una persona dependiendo el caso
    $('#botonGuardarSalida').on('click', function () {
        $.ajax({
            url: '/registros/salida_persona/' + idRegistro,
            type: 'PUT',
            data: {
                registroSalida: casoSalida
            },
            success: function(res) {
                console.log(res);
                datatableRegistrosSalida();
                datatableRegistros();
                datatableRegistrosVehiculos();
                $('#informacionRegistro').css('display', 'none'); 
                // if($('#checkVehiculo').prop('checked')){
                //     $('#checkVehiculo').prop('checked', false);
                //     $('#inputVehiculo').val('');
                // }

                if(datosRegistro.tipoPersona == 1){
                    datosRegistro.nombrePersona = 'visitante ' + datosRegistro.nombrePersona;
                } else if(datosRegistro.tipoPersona == 2 || datosRegistro.tipoPersona == 3){
                    datosRegistro.nombrePersona = 'colaborador ' + datosRegistro.nombrePersona;
                } else if(datosRegistro.tipoPersona == 4){
                    datosRegistro.nombrePersona = 'conductor ' + datosRegistro.nombrePersona;
                }

                $('.textoPersona').text(datosRegistro.nombrePersona);
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

});