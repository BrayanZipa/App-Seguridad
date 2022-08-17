$(function () {


    if($('#idTipoPersona').val() !== ''){
        if($('#idTipoPersona').val() == 1){
            console.log('visitantes');
        } else if($('#idTipoPersona').val() == 3){
            console.log('activos');
        } else if($('#idTipoPersona').val() == 4){
            console.log('conductores');
        }
        var URLactual = window.location.pathname;
        console.log(URLactual);
    }
    // var URLactual2 = window.location;
    // console.log(URLactual2);

    

    // var loc = window.location;
    // var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
    // var ruta = loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length))
    // console.log(loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length)));

    var URLactual3 = window.location.origin;
    var servidor = URLactual3


    //Función que permite que a los select de selección de EPS y ARL de todos los formularios se les asigne una barra de búsqueda haciendolos más dinámicos, también se le asigna select de persona
    function activarSelect2Registros() {
        $('#selectPersona').select2({
            theme: 'bootstrap4',
            placeholder: 'Seleccione a la persona',
            language: {
                noResults: function () {
                    return 'No hay resultado';
                }
            }
        });
        $('.select2EPS').select2({
            theme: 'bootstrap4',
            placeholder: 'Seleccione EPS',
            language: {
                noResults: function () {
                    return 'No hay resultado';
                }
            }
        });
        $('.select2ARL').select2({
            theme: 'bootstrap4',
            placeholder: 'Seleccione ARL',
            language: {
                noResults: function () {
                    return 'No hay resultado';
                }
            }
        });
    }
    activarSelect2Registros();

    //Función que permite que por medio de una solicitud Ajax se listen en un select todas las personas que pertenezcan a un tipo de persona que se haya seleccionado
    function listarPersonas() {
        $('#selectPersona').empty();   
        $('#selectPersona').append("<option value=''>Seleccione a la persona</option>");
        $.ajax({
            // 'personas'
            url: servidor + '/registros/personas',
            type: 'GET',
            data: {
                tipoPersona: $('#selectTipoPersona option:selected').val(),
            },
            dataType: 'json',
            success: function(response){
                $('#buscarPersona').css('display', 'block'); 
                $.each(response, function(key, value){                   
                    $('#selectPersona').append("<option value='" + value.id_personas + "'> C.C. " + value.identificacion + " - " + value.nombre + " " + value.apellido + "</option>");
                });                                              
            }, 
            error: function(){
                console.log('Error obteniendo los datos de las personas');
            }
        }); 
    }

    //Función que se activa cuando el usuario selecciona alguna opción del select tipo de persona
    $('#selectTipoPersona').change(function() { 
        listarPersonas();
    });
    
    //Función que permite que al seleccionar a una persona se traiga su información por medio de una solicitud Ajax y dependiendo del tipo de persona esta información se muestre en los diferentes formularios
    $('#selectPersona').change(function() { 
        if($('.registros').hasClass('is-invalid')){
            $('.registros').removeClass('is-invalid');
        }  
        $.ajax({
            url: 'persona',
            type: 'GET',
            data: {
                persona: $('#selectPersona option:selected').val(),
            },
            dataType: 'json',
            success: function(response){
                if($('#columnaActivo').css('display') != 'none'){$('#columnaAutorizacion').css('display', 'none');}
                $('#idPersona').val(response.id_personas);
                if($('#formVisitanteConductor').is(':visible')){
                    $('#formVisitanteConductor').css('display', 'none');
                } else if ($('#formColaboradorSinActivo').is(':visible')){
                    $('#formColaboradorSinActivo').css('display', 'none');
                }else if ($('#formColaboradorConActivo').is(':visible')){
                    $('#formColaboradorConActivo').css('display', 'none');
                }

                obtenerUltimoRegistroVehiculo(response.id_personas, response.id_tipo_persona);
                if(response.id_tipo_persona == 1 || response.id_tipo_persona == 4){
                    $('#formRegistros1').attr('action','../registros/editar_persona/' + response.id_personas); 
                    $('#inputId').val(response.id_personas);
                    $('#inputFoto').val(response.foto);
                    $('#fotografia').attr('src', '../' + response.foto);  
                    $('#inputNombre').val(response.nombre);
                    $('#inputApellido').val(response.apellido);
                    $('#inputIdentificacion').val(response.identificacion);
                    $('#inputTelefono').val(response.tel_contacto);
                    $('#selectEps').val(response.id_eps);
                    $('#selectArl').val(response.id_arl);
                    $('#inputColaborador').val('');
                    $('#selectEmpresa').val('');
                    $('#inputDescripcion').val('');

                    if(response.id_tipo_persona == 1){ 
                        if($('#checkActivo').prop('checked')){
                            $('#checkActivo').trigger('click');
                        }
                        if($('#checkVehiculo').prop('checked')){
                            $('#checkVehiculo').trigger('click');
                        } else {
                            $('#divVehiculo').css('display', 'none');
                            $('#selectVehiculo').prop('required', false);
                        }
                        $('#registro').val('visitante');
                        $('#inputActivo').val(response.activo);
                        $('#inputCodigo').val(response.codigo); 
                        $('#selectEps').prop('required', false);
                        $('#selectArl').prop('required', false);
                        $('#titulo').text('Información visitante');
                        $('#checkBox').css('display', ''); 
                        $('#formVisitanteConductor').css('display', 'block'); 
                    } else {
                        $('#registro').val('conductor');
                        obtenerVehiculos('#selectVehiculo');
                        $('#selectVehiculo').prop('required', true);
                        $('#divVehiculo').css('display', '');
                        $('#selectEps').prop('required', true);
                        $('#selectArl').prop('required', true);
                        $('#titulo').text('Información conductor');
                        $('.visitante').css('display', 'none');   
                        $('#formVisitanteConductor').css('display', 'block'); 
                    }

                }  else if(response.id_tipo_persona == 2){
                    if($('#checkVehiculo2').prop('checked')){
                        $('#checkVehiculo2').trigger('click');
                    } 
                    $('#formRegistros2').attr('action','../registros/editar_persona/' + response.id_personas);
                    $('#registro2').val('colaboradorSinActivo');
                    $('#inputId2').val(response.id_personas);
                    $('#inputNombre2').val(response.nombre);
                    $('#inputApellido2').val(response.apellido);
                    $('#inputIdentificacion2').val(response.identificacion);
                    $('#inputEmail2').val(response.email);
                    $('#inputTelefono2').val(response.tel_contacto);
                    $('#selectEps2').val(response.id_eps);
                    $('#selectArl2').val(response.id_arl);
                    $('#selectEmpresa2').val(response.id_empresa);
                    $('#inputDescripcion2').val('');
                    $('#formColaboradorSinActivo').css('display', 'block'); 
                    
                }  else if(response.id_tipo_persona == 3){
                    if($('#checkVehiculo3').prop('checked')){
                        $('#checkVehiculo3').trigger('click');
                    }
                    $('#formRegistros3 .registros').each(function(index) {
                        $(this).val('');
                    });
                    obtenerColaborador(response);
                    $('#formRegistros3').attr('action','../registros/editar_persona/' + response.id_personas);
                    $('#inputId3').val(response.id_personas);
                    $('#inputTelefono3').val(response.tel_contacto);
                    $('#selectEps3').val(response.id_eps);
                    $('#selectArl3').val(response.id_arl);
                    $('#formColaboradorConActivo').css('display', 'block'); 
                }   
                activarSelect2Registros();              
            }, 
            error: function(){
                console.log('Error obteniendo los datos de la persona');
            }
        }); 
    }); 

    //Función que permite que al seleccionar una persona de tipo colaborador con activo se traiga su información directamente desde el API de GLPI por medio de una solicitud Ajax, también se traer la información del último registro que haya tenido del colaborador donde se haya registrado su ingreso, así como el ingreso de un activo, pero se haya registrado la salida de la persona y no la del activo. Si este registro existe no se realiza la búsqueda del activo y se muestra un mensaje informativo
    function obtenerColaborador(data){      
        if($('#mensajeError').length){ $('#mensajeError').remove(); }  
        if($('#mensajeCodigo').length){ $('#mensajeCodigo').remove(); } 
        if($('#mensajeActivo').css('display') != 'none'){ $('#mensajeActivo').css('display', 'none'); }
        
        $.ajax({
            url: '../colaboradores/colaboradoridentificado',
            type: 'GET',
            data: {
                colaborador: data.identificacion,
                tipoBusqueda: 1,
            },
            dataType: 'json',
            success: function(response) {
                if ('error' in response) {  
                    $('#inputCodigo3').addClass('is-invalid');                
                    $('#inputCodigo3').val('*El colaborador no esta registrado en el sistema GLPI');
                    $('#inputNombre3').val(data.nombre);
                    $('#inputApellido3').val(data.apellido);
                    $('#inputIdentificacion3').val(data.identificacion);
                    $('#inputEmail3').val(data.email);
                    $('#selectEmpresa3').val(data.id_empresa);

                } else {  
                    $('#inputIdentificacion3').val(response['registration_number']);
                    $('#inputNombre3').val(response['firstname']);
                    $('#inputApellido3').val(response['realname']);
                    $('#inputEmail3').val(response['email']);

                    if (response['phone2'].includes('Aviomar')) {
                        $('#selectEmpresa3').val(1);
                    } else if (response['phone2'].includes('Snider')) {
                        $('#selectEmpresa3').val(2);
                    } else if (response['phone2'].includes('Colvan')) {
                        $('#selectEmpresa3').val(3);
                    }  
                    
                    $.ajax({
                        url: 'activo_sin_salida',
                        type: 'GET',
                        data: {
                            persona: data.id_personas
                        },
                        dataType: 'json',
                        success: function(activoSinSalida) {             
                            if('ingreso_activo' in activoSinSalida){  
                                var fecha = moment(activoSinSalida.ingreso_activo).format('DD-MM-YYYY');
                                var mensaje = 'El colaborador tiene en las intalaciones el activo ' + activoSinSalida.codigo_activo + ' ingresado el ' + fecha;
            
                                $('#mensajeActivo').css(
                                    {
                                    'border': '1px solid #dc3545',
                                    'border-radius': '8px',
                                    'color': '#dc3545',
                                    'font-size': '82%',
                                    'font-weight': 'bold',
                                    'word-wrap': 'break-word',
                                    'display': ''
                                    }
                                );
                                $('#registro3').val('colaboradorSinActivo2');
                                $('#mensajeActivo').text(mensaje);
                                
                            } else {
                                $('#registro3').val('colaboradorConActivo');
                                $.ajax({
                                    url: '../colaboradores/computador',
                                    type: 'GET',
                                    data: {
                                        colaborador: response.id,
                                    },
                                    dataType: 'json',
                                    success: function(activo) {
                                        if ('error' in activo) {
                                            $('#inputCodigo3').addClass('is-invalid');
                                            $('#inputCodigo3').val('*Colaborador registrado en GLPI pero sin activo asignado');
                                        } else {
                                            $('#inputCodigo3').val(activo['name']); 
                                            if(data.codigo != activo['name']){
                                                $('#inputCodigo3').addClass('is-invalid');
                                                if($('#mensajeCodigo').length){ 
                                                    $('#mensajeCodigo').text('El colaborador tiene asignado un nuevo activo, debe actualizar');
                                                } else {
                                                    $('#inputCodigo3').after($('<div id="mensajeError" class="invalid-feedback">El colaborador tiene asignado un nuevo activo, debe actualizar</div>'));
                                                }     
                                            }
                                            if(activo['autorizacion'] == null){
                                                $('#autorizacion').css('color', '#dc3545');
                                                $('#autorizacion').text('El activo ' + activo['name'] + ' no tiene autorización para ser retirado de la empresa, por favor consultar con el área de Tecnología');
                                                $('#columnaAutorizacion').css('display', '');
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
                            console.log('Error obteniendo los datos de la base de datos');
                        }
                    });
                }         
            },
            error: function() {
                console.log('Error obteniendo los datos de GLPI');
            }
        });
    }

    //Función que hace una petición Ajax para traer la información del último registro que haya tenido una persona donde se haya registrado su ingreso, así como el ingreso de un vehículo, pero se haya registrado la salida de la persona y no la del vehículo. Si este registro existe se bloquea el select de ingreso de vehículo y se muestra un mensaje informativo
    function obtenerUltimoRegistroVehiculo(idPersona, tipoPersona) {
        $.ajax({
            url: 'vehiculo_sin_salida',
            type: 'GET',
            data: {
                persona: idPersona
            },
            dataType: 'json',
            success: function(response) {             
                if('ingreso_vehiculo' in response){  
                    var fecha = moment(response.ingreso_vehiculo).format('DD-MM-YYYY');
                    var mensaje = 'tiene en las intalaciones el vehículo ' + response.identificador + ' ingresado el ' + fecha;

                    $('.mensajeVehiculo').css(
                        {
                        'margin-top': '8px',
                        'border': '1px solid #dc3545',
                        'border-radius': '8px',
                        'color': '#dc3545',
                        'font-size': '82%',
                        'font-weight': 'bold',
                        'word-wrap': 'break-word',
                        }
                    );

                    if(tipoPersona == 1 || tipoPersona == 4){
                        $('#selectVehiculo').prop('disabled', true);
                        if(tipoPersona == 1){
                            $('#mensajeVehiculo').text('El visitante ' + mensaje);
                        } else if(tipoPersona == 4){
                            $('#mensajeVehiculo').text('El conductor ' + mensaje);
                        }
                        $('#colMensajeVehiculo').css('display', '');
                    } else if(tipoPersona == 2 || tipoPersona == 3){
                        if(tipoPersona == 2){
                            $('#selectVehiculo2').prop('disabled', true);
                            $('#mensajeVehiculo2').text('El colaborador ' + mensaje);
                            $('#colMensajeVehiculo2').css('display', '');
                        } else if(tipoPersona == 3){
                            if($('#colInputVehiculo').hasClass('col-sm-8')){
                                $('#colInputVehiculo').removeClass('col-sm-8');
                                $('#colInputVehiculo').addClass('col-sm-4');
                            }   
                            $('#selectVehiculo3').prop('disabled', true);
                            $('#mensajeVehiculo3').text('El colaborador ' + mensaje);
                            $('#colMensajeVehiculo3').css('display', '');
                        }
                    } 
                } else {
                    if(tipoPersona == 1 || tipoPersona == 4){
                        $('#selectVehiculo').prop('disabled', false);
                        $('#colMensajeVehiculo').css('display', 'none'); 
                    } else if(tipoPersona == 2){
                        $('#selectVehiculo2').prop('disabled', false);
                        $('#colMensajeVehiculo2').css('display', 'none'); 
                    } else if(tipoPersona == 3){
                        if($('#colInputVehiculo').hasClass('col-sm-4')){
                            $('#colInputVehiculo').removeClass('col-sm-4');
                            $('#colInputVehiculo').addClass('col-sm-8');
                        } 
                        $('#selectVehiculo3').prop('disabled', false);
                        $('#colMensajeVehiculo3').css('display', 'none');
                    } 
                    $('.mensajeVehiculo').text('');
                }     
            },
            error: function() {
                console.log('Error obteniendo los datos de la base de datos');
            }
        });
    }

    //Función que hace una petición Ajax para traer la información del último registro que haya tenido un colaborador donde se haya registrado su ingreso, así como el ingreso de un activo, pero se haya registrado la salida de la persona y no la del activo. Si este registro existe no se realiza la búsqueda del activo y se muestra un mensaje informativo
    function obtenerUltimoRegistroActivo(idPersona) {
        $.ajax({
            url: 'activo_sin_salida',
            type: 'GET',
            data: {
                persona: idPersona
            },
            dataType: 'json',
            success: function(activoSinSalida) {             
                if('ingreso_activo' in activoSinSalida){  
                    var fecha = moment(activoSinSalida.ingreso_activo).format('DD-MM-YYYY');
                    var mensaje = 'El colaborador tiene en las intalaciones el activo ' + activoSinSalida.codigo_activo + ' ingresado el ' + fecha;

                    $('#mensajeActivo').css(
                        {
                        'border': '1px solid #dc3545',
                        'border-radius': '8px',
                        'color': '#dc3545',
                        'font-size': '82%',
                        'font-weight': 'bold',
                        'word-wrap': 'break-word',
                        'display': ''
                        }
                    );
                    $('#mensajeActivo').text(mensaje);     
                }
            },
            error: function() {
                console.log('Error obteniendo los datos de la base de datos');
            }
        });
    }

    //Función que permite que al seleccionar un checkbox de ingreso de vehículo en cualquiera de los formularios se muestre o se oculte el select que lista los vehículos pertenecientes a una persona, también permite hacer o no requerido el ingreso de esta información
    function checkboxVehiculos(checkbox, select, div) {
        if ($(checkbox).is(':checked')) {
            obtenerVehiculos(select);
            $(select).prop('required', true);
            $(div).css('display', '');
        } else {
            if($(select).hasClass('is-invalid')){
                $(select).removeClass('is-invalid');
            }  
            $(select).prop('required', false);
            $(select).val('');
            $(div).css('display', 'none');
        }  
    }

    //Función que se activa cuando el usuario le da click al checkbox de ingresar vehículo en el formulario de visitanteConductor
    $('#checkVehiculo').on('change', function () {
        checkboxVehiculos('#checkVehiculo', '#selectVehiculo', '#divVehiculo');
    });

    //Función que se activa cuando el usuario le da click al checkbox de ingresar vehículo en el formulario de colaborador sin activo
    $('#checkVehiculo2').on('change', function () {
        checkboxVehiculos('#checkVehiculo2', '#selectVehiculo2', '#divVehiculo2');
    });

    //Función que se activa cuando el usuario le da click al checkbox de ingresar vehículo en el formulario de colaborador con activo
    $('#checkVehiculo3').on('change', function () {
        checkboxVehiculos('#checkVehiculo3', '#selectVehiculo3', '#divVehiculo3');
    });

    //Función que se activa cuando el usuario le da click al checkbox de ingresar activo en el formulario de visitanteConductor, permitiendo ocultar o mostrar la información, así como hacerla requerida o no
    $('#checkActivo').on('change', function () {
        if ($('#checkActivo').is(':checked')) {
            $('#registro').val('visitanteActivo');
            $('#inputActivo').prop('required', true);
            $('#inputCodigo').prop('required', true);
            if($('#inputActivo').val().length <= 0){
                $('#inputActivo').val('Computador');
            }
            $('#divActivo').css('display', '');         
        } else {
            if($('#inputActivo, #inputCodigo').hasClass('is-invalid')){
                $('#inputActivo, #inputCodigo').removeClass('is-invalid');
            } 
            $('#registro').val('visitante');
            $('#inputActivo').prop('required', false);
            $('#inputCodigo').prop('required', false);
            $('#divActivo').css('display', 'none');
            $('#inputActivo').val('');
            $('#inputCodigo').val('');
        }
    });

    //Función que permite que al seleccionar la opción de ingreso de vehículo en cualquiera de los formularios se haga una petención Ajax para consultar la información de los vehículos que esten asociados a la persona que se haya seleccionado previamente y estos se listen en un select
    function obtenerVehiculos(select) {
        $(select).empty();   
        $(select).append("<option selected='selected' value='' disabled>Seleccione el vehículo</option>");

        $.ajax({
            url: 'vehiculos',
            type: 'GET',
            data: {
                persona: $('#idPersona').val()
            },
            dataType: 'json',
            success: function(response){
                $.each(response, function(key, value){     
                    if(value.marca == null){
                        $(select).append("<option value='" + value.id_vehiculos + "'>" + value.tipo + " - " + value.identificador + "</option>");
                    }  else {
                        $(select).append("<option value='" + value.id_vehiculos + "'>" + value.tipo + " " + value.marca + " - " + value.identificador + "</option>");
                    }            
                });   
            }, 
            error: function(errores){
                console.log(errores);
            }
        }); 
    }

    //Función que genera mensajes de error cuando el usuario intenta enviar algún formulario del módulo registros sin los datos requeridos, es una primera validación del lado del cliente
    function validacion(form, event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            $('.registros').each(function (index) {
                if (!this.checkValidity()) {
                    $(this).addClass('is-invalid');
                }
            });
        }
    }

    //Función anónima que se activa cuando el usuario intenta enviar el formulario de visitanteConductor sin la información requerida
    (function () {
        'use strict'
        var form = document.getElementById('formRegistros1');
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                validacion(form, event);
            }
        }, false);
    })();

    //Función anónima que se activa cuando el usuario intenta enviar el formulario de colaborador sin activo sin la información requerida
    (function () {
        'use strict'
        var form = document.getElementById('formRegistros2');
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                validacion(form, event);
            }
        }, false);
    })();

    //Función anónima que se activa cuando el usuario intenta enviar el formulario de colaborador con activo sin la información requerida
    (function () {
        'use strict'
        var form = document.getElementById('formRegistros3');
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                validacion(form, event);
            }
        }, false);
    })();

    //Si en un input de cualquier formulario de la vista de ingreso de registros esta la clase is-invalid al escribir en el mismo input se elimina esta clase 
    $('input.registros, textarea.registros').keydown(function () {
        if ($(this).hasClass('is-invalid')) {
            $(this).removeClass('is-invalid');
        }
    });

    //Si en un select de cualquier formulario de la vista de ingreso de registros esta la clase is-invalid al seleccionar algo en el mismo select se elimina esta clase 
    $('select.registros').change(function () {
        if ($(this).hasClass('is-invalid')) {
            $(this).removeClass('is-invalid');
        }
    });

    //Función que se activa cuando el usuario hace click en el botón de cerrar en cualquiera de los formularios, esto hace que el formulario que se este mostrando en el momento se oculte
    $('.botonCerrar').click(function () {
        if($('#formVisitanteConductor').is(':visible')){
            $('#formVisitanteConductor').css('display', 'none');
        } else if ($('#formColaboradorSinActivo').is(':visible')){
            $('#formColaboradorSinActivo').css('display', 'none');
        }else if ($('#formColaboradorConActivo').is(':visible')){
            $('#formColaboradorConActivo').css('display', 'none');
        }
    });

    //Función que permite retornar información en común para todos los formularios en caso de que se generen errores al momento de enviar un formulario
    function retornoInformacion(tipoPersona, formulario, idPersona) {
        $(formulario).attr('action','../registros/editar_persona/' + $('#inputId').val()); 
        $('#selectTipoPersona').val(tipoPersona);
        listarPersonas();
        obtenerUltimoRegistroVehiculo($(idPersona).val(), tipoPersona);
        $('#idPersona').val($(idPersona).val());
        setTimeout(function(){
            $('#selectPersona').val($(idPersona).val());
            activarSelect2Registros();
        }, 1500);
    }

    //Función que permite retornar la información de un vehículo que haya sido seleccionado en cualquiera de los formularios si se generan errores al momento de enviar un formulario
    function retornoVehiculo(inputVehiculo, checkVehiculo, selectVehiculo) {
        $(checkVehiculo).prop('checked', true);
        $(checkVehiculo).trigger('change');
        setTimeout(function(){
            $(selectVehiculo).val($(inputVehiculo).val());
        }, 1500);
    }

    //Función anónima que se ejecuta si alguno de los elementos mencionados se crea en la interfaz debido a errores cometidos en el ingreso de los formularios del módulo de registros
    (function () {
        if (!!document.getElementById('botonRetorno') || !!document.getElementById('botonRetorno3')) {

            if($('#registro').val() == 'visitante' || $('#registro').val() == 'visitanteActivo'){
                retornoInformacion(1, '#formRegistros1', '#inputId');
                $('#titulo').text('Información visitante');
                $('#fotografia').attr('src', '../' + $('#inputFoto').val()); 
                $('#selectEps').prop('required', false);
                $('#selectArl').prop('required', false);

                if($('#registro').val() == 'visitanteActivo'){ $('#checkActivo').trigger('click');} 
                if($('#vehiculo').val().length > 0){ retornoVehiculo('#vehiculo', '#checkVehiculo', '#selectVehiculo');}
                $('#formVisitanteConductor').css('display', 'block');

            } else if($('#registro').val() == 'conductor'){
                retornoInformacion(4, '#formRegistros1', '#inputId');
                $('#titulo').text('Información conductor');
                $('#fotografia').attr('src', '../' + $('#inputFoto').val());  
                $('#divVehiculo').css('display', '');
                $('.visitante').css('display', 'none'); 
                obtenerVehiculos('#selectVehiculo');
                $('#selectVehiculo').prop('required', true);

                setTimeout(function(){
                    $('#selectVehiculo').val($('#vehiculo').val());
                }, 1500);
                $('#formVisitanteConductor').css('display', 'block');

            } else if($('#registro2').val() == 'colaboradorSinActivo'){
                retornoInformacion(2, '#formRegistros2', '#inputId2');
                if($('#vehiculo2').val().length > 0){ retornoVehiculo('#vehiculo2', '#checkVehiculo2', '#selectVehiculo2');}
                $('#formColaboradorSinActivo').css('display', 'block');   

            } else if($('#registro3').val() == 'colaboradorConActivo' || $('#registro3').val() == 'colaboradorSinActivo2'){
                if($('#registro3').val() == 'colaboradorSinActivo2'){
                    obtenerUltimoRegistroActivo($('#inputId3').val());
                }
                retornoInformacion(3, '#formRegistros3', '#inputId3');
                if($('#vehiculo3').val().length > 0){ retornoVehiculo('#vehiculo3', '#checkVehiculo3', '#selectVehiculo3');}
                $('#formColaboradorConActivo').css('display', 'block');    
            }
        }
    })();

    //Muestra los modales de ingreso correcto dependiendo de que formularios se hayan ingresado y redirecciona en caso de que se oprima el botón continuar
    $('#modal-crear-persona').modal('show');
    $('#modal-crear-personaVehiculo').modal('show');
    $('#modal-crear-personaActivo').modal('show');
    $('#modal-crear-personaVehiculoActivo').modal('show');

    $('.botonContinuar').click(function () {
        $(location).attr('href', '../registros/sin_salida');
    });

});  