$(function() {

    //Permite que a los select de selección de EPS y ARL se les asigne una barra de búsqueda haciendolos más dinámicos
    function activarSelect2Conductor() {
        $('#selectEps').select2({
            theme: 'bootstrap4',
            placeholder: 'Seleccione EPS',
            language: {
                noResults: function() {
                    return 'No hay resultado';
                }
            }
        });
        $('#selectArl').select2({
            theme: 'bootstrap4',
            placeholder: 'Seleccione ARL',
            language: {
                noResults: function() {
                    return 'No hay resultado';
                }
            }
        });
    }

    //Permite que a los select de selección Tipo de vehículo y Marca de vehículo se les asigne una barra de búsqueda haciendolos más dinámicos            
    function activarSelect2Vehiculo() {
        $('#selectVehiculo').select2({
            theme: 'bootstrap4',
            placeholder: 'Seleccione el vehículo',
            language: {
                noResults: function() {
                    return 'No hay resultado';
                }
            }
        });
        $('#selectTipoVehiculo').select2({
            theme: 'bootstrap4',
            placeholder: 'Seleccione el tipo',
            language: {
                noResults: function() {
                    return 'No hay resultado';
                }
            }
        });
        $('#selectMarcaVehiculo').select2({
            theme: 'bootstrap4',
            placeholder: 'Seleccione la marca',
            language: {
                noResults: function() {
                    return 'No hay resultado';
                }
            }
        });
    }

    activarSelect2Conductor();
    activarSelect2Vehiculo();

    //Botón que limpia la información del formulario de Conductor
    $('#botonLimpiar').click(function() {
        document.getElementById('inputFotoVehiculo').setAttribute('value', '');
        $('#botonActivar').trigger('click');
        $('#botonActivar2').trigger('click');
        $('.conductor').each(function(index) {
            $(this).val('');
            if($(this).hasClass('is-invalid')){
                $(this).removeClass('is-invalid');
            } 
        });
        activarSelect2Conductor();
        activarSelect2Vehiculo();
    });




    //Al hacel click en el checkBox se oculta el formulario de creación de nuevo vehículo y se muestra un select donde se listan todos los vehículos ingresados en la aplicación, esto para asignar al conductor a un vehículo ya creado en el sistema
    $('#checkVehiculo').click(function() {
        if ($('#checkVehiculo').is(':checked')) {
            if ($('.vehiculo').hasClass('is-invalid')) {
                $('.vehiculo').removeClass('is-invalid');
            }
            $('#botonActivar2').trigger('click');
            $('.vehiculo').val('');
            $('#selectMarcaVehiculo').val('');
            activarSelect2Vehiculo();
            $('.vehiculo').prop('required', false);
            $('#selectVehiculo').prop('required', true);
            $('#filaVehiculoNuevo').css('display', 'none');
            $('#filaVehiculoExistente').css('display', '');
        } else {
            if ($('#selectVehiculo').hasClass('is-invalid')) {
                $('#selectVehiculo').removeClass('is-invalid');
            }
            $('#selectVehiculo').val('');
            activarSelect2Vehiculo();
            $('.vehiculo').prop('required', true);
            $('#selectVehiculo').prop('required', false);
            $('#filaVehiculoExistente').css('display', 'none');
            $('#filaVehiculoNuevo').css('display', '');
        }
    });




    //Botón que da acceso a la cámara web del computador donde este abierta la aplicación desde el formulario crear conductor
    $('#botonActivar').click(function() {
        document.getElementById('canvas').style.display = 'none';
        document.getElementById('inputFoto').setAttribute('value', '');
        const video = document.getElementById('video');

        if (!tieneSoporteUserMedia()) {
            alert('Lo siento. Tu navegador no soporta esta característica');
            return;
        }

        const constraints = {
            audio: false,
            video: { width: 640, height: 500 }
        }

        const navegador = navigator.userAgent;
        if (navegador.match(/Android/i) || navegador.match(/webOS/i) || navegador.match(/iPhone/i) || navegador.match(/iPad/i) || navegador.match(/iPod/i) || navegador.match(/BlackBerry/i) || navegador.match(/Windows Phone/i)) {    
            constraints.video.facingMode = {
                exact: 'environment'
            }
        }

        navigator.mediaDevices.getUserMedia(constraints)
            .then((stream) => {
                video.style.display = 'block';
                video.style.borderStyle = 'solid';
                video.style.borderWidth = '1px';
                video.style.borderColor = '#007bff';

                video.srcObject = stream;
                video.play();
                document.getElementById('botonActivar').style.display = 'inline';
                document.getElementById('botonCapturar').style.display = 'inline';
            })
            .catch((err) => console.log(err))
    });
    if($('#inputFoto').val() == ''){
        $('#botonActivar').trigger('click');
    }
    
    //Botón que da acceso a la cámara web del computador donde este abierta la aplicación desde el formulario ingresar vehículo
    $('#botonActivar2').click(function() {
        document.getElementById('canvas2').style.display = 'none';
        document.getElementById('inputFotoVehiculo').setAttribute('value', '');
        const video2 = document.getElementById('video2');

        if (!tieneSoporteUserMedia()) {
            alert('Lo siento. Tu navegador no soporta esta característica');
            return;
        }

        const constraints = {
            audio: false,
            video: { width: 640, height: 500 }
        }

        const navegador = navigator.userAgent;
        if (navegador.match(/Android/i) || navegador.match(/webOS/i) || navegador.match(/iPhone/i) || navegador.match(/iPad/i) || navegador.match(/iPod/i) || navegador.match(/BlackBerry/i) || navegador.match(/Windows Phone/i)) {    
            constraints.video.facingMode = {
                exact: 'environment'
            }
        }

        navigator.mediaDevices.getUserMedia(constraints)
            .then((stream) => {                       
                video2.style.display = 'block';
                video2.style.borderStyle = 'solid';
                video2.style.borderWidth = '1px';
                video2.style.borderColor = '#fd7e14';

                video2.srcObject = stream;
                video2.play(); 

                document.getElementById('botonCapturar2').style.backgroundColor = 'rgb(255, 115, 0)'; 
                document.getElementById('botonActivar2').style.display = 'inline';  
                document.getElementById('botonCapturar2').style.display = 'inline';                      
            })
            .catch((err) => console.log(err))            
    });
    if($('#inputFotoVehiculo').val() == ''){
        $('#botonActivar2').trigger('click');
    }
    
    // Función que permite saber si el navegador que se esta utilizando soporta características audio visuales
    function tieneSoporteUserMedia() {
        return !!(navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia)
    }

    //Botón que captura una fotografía desde el formulario de crear visitante con la cámara web del computador donde este abierta la aplicación
    $('#botonCapturar').click(function() {
        var inputFoto = document.getElementById('inputFoto');
        if(inputFoto.classList.contains( 'is-invalid' )){
            inputFoto.classList.remove('is-invalid');
        }
        var video = document.getElementById('video');
        video.pause();
        var canvas = document.getElementById('canvas');
        var contexto = canvas.getContext('2d');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        contexto.drawImage(video, 0, 0, canvas.width, canvas.height);

        var foto = canvas.toDataURL();
        document.getElementById('inputFoto').setAttribute('value', foto);
    });

    //Botón que captura una fotografía desde el formulario de crear vehículo con la cámara web del computador donde este abierta la aplicación
    $('#botonCapturar2').click(function() {
        var inputFotoVehiculo = document.getElementById('inputFotoVehiculo');
        if(inputFotoVehiculo.classList.contains( 'is-invalid' )){
            inputFotoVehiculo.classList.remove('is-invalid');
        }
        var video2 = document.getElementById('video2');
        video2.pause();
        var canvas2 = document.getElementById('canvas2');
        var contexto2 = canvas2.getContext('2d');
        canvas2.width = video2.videoWidth;
        canvas2.height = video2.videoHeight;
        contexto2.drawImage(video2, 0, 0, canvas2.width, canvas2.height); 

        var foto = canvas2.toDataURL();
        document.getElementById('inputFotoVehiculo').setAttribute('value', foto);  
    });

    // Función que permite que al momento que el usuario seleccione Bicicleta en el formulario de ingreso de vehículo se desabilite el select de marca de vehículo
    function selectMarcaVehiculo() {
        var tipo = $('#selectTipoVehiculo option:selected').text();
        var tipoVehiculo = tipo.replace(/\s+/g, '');

        if( tipoVehiculo == 'Bicicleta'){
            $('#selectMarcaVehiculo').val('');
            $('#selectMarcaVehiculo').prop('disabled', true);
            $('#selectMarcaVehiculo').select2({
                theme: 'bootstrap4',
                placeholder: 'Seleccione la marca',
                language: {
                    noResults: function() {
                        return 'No hay resultado';
                    }
                }
            });        
        } else {
            $('#selectMarcaVehiculo').prop('disabled', false);
        } 
    }

    //Función que se activa cuando el usuario selecciona alguna opción del select de tipo de vehículo
    $('#selectTipoVehiculo').change(function() {
        selectMarcaVehiculo();
    });

    // Función anónima que genera mensajes de error cuando el usuario intenta enviar algún formulario del módulo visitantes sin los datos requeridos, es una primera validación del lado del cliente
    (function () {
        'use strict'
        var form = document.getElementById('formularioConductor');
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();

            $('.conductor, .vehiculo').each(function(index) {
                if (!this.checkValidity()) {
                    $(this).addClass('is-invalid');
                }
            });
            }
        }, false);
    })();

    //Si en un input del cualquier formulario del módulo conductores esta la clase is-invalid al escribir en el mismo input se elimina esta clase 
    $('input.conductor, textarea.conductor, input.vehiculo').keydown(function(event){
        if($(this).hasClass('is-invalid')){
            $(this).removeClass('is-invalid');
        }     
    });

   //Si en un select del cualquier formulario del módulo conductores esta la clase is-invalid al seleccionar algo en el mismo select se elimina esta clase 
    $( 'select.conductor, select.vehiculo' ).change(function() {
        if($(this).hasClass('is-invalid')){
            $(this).removeClass('is-invalid');
        }  
    }); 

    // Función que permite mantener la fotografía tomada previamente al conductor en caso de que haya errores al enviar el formulario crear conductor
    function retornarFotoConductor () {
        var inputFoto = document.getElementById('inputFoto').value;
        var canvas = document.getElementById('canvas');
        var contexto = canvas.getContext('2d');

        canvas.setAttribute('width', '640');
        canvas.setAttribute('height', '500');

        canvas.style.borderStyle = 'solid';
        canvas.style.borderWidth = '1px';
        canvas.style.borderColor = '#007bff';

        var imagen = new Image();
        imagen.src = inputFoto;

        imagen.onload=function() {
            document.getElementById('canvas').style.display = 'block';           
            contexto.drawImage(imagen, 0, 0, imagen.width, imagen.height);
        }
    }

    //Función que permite mantener la fotografía tomada previamente al vehículo en caso de que haya errores al enviar el formulario crear vehículo
    function retornarFotoVehiculo () {
        var inputFotoVehiculo = document.getElementById('inputFotoVehiculo').value;              
        var canvas2 = document.getElementById('canvas2');
        var contexto2 = canvas2.getContext('2d');

        canvas2.setAttribute('width', '640');
        canvas2.setAttribute('height', '500');

        canvas2.style.borderStyle = 'solid';
        canvas2.style.borderWidth = '1px';
        canvas2.style.borderColor = '#fd7e14';

        var imagen2 = new Image();;
        imagen2.src = inputFotoVehiculo;

        imagen2.onload=function() {
            document.getElementById('canvas2').style.display = 'block';
            contexto2.drawImage(imagen2, 0, 0, imagen2.width, imagen2.height);
        }
    } 

    //Función anónima que se ejecuta si alguno de los elementos mencionados se crea en la interfaz debido a errores cometidos en el ingreso de los formularios del módulo de conductores
    (function () {
        if(!!document.getElementById('botonRetorno') || !!document.getElementById('botonRetorno2')){
            if($('#inputFoto').val() != ''){
                retornarFotoConductor();
                $('#botonActivar').css('display', '');
            }
            if($('#inputFotoVehiculo').val() != ''){
                retornarFotoVehiculo();
                $('#botonActivar2').css('display', '');
            }
            selectMarcaVehiculo();
        }
    })();

    // Muestra el modal de creación de conductor exitoso y redirecciona en caso de que se oprima el botón continuar
    $('#modal-crear-conductor').modal('show');

    $('.botonContinuar').click(function() {
        $(location).attr('href', '../conductores');
    });
    
});