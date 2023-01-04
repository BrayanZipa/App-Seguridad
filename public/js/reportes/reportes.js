$(function () {

    const fecha = new Date();

    //Permite establecer en el input de filtrar por año un lista de años que van desde el año 2022 hasta el año actual
    for (let i= 2022; i <= fecha.getFullYear(); i++) {
        $('#selectAnio').append(`<option value="${i}">${i}</option>`);
    }
    
    //Función que permite esrablecer el año y el mes actual en el input de filtrar por año y en el input de filtrar por mes respectivamente
    function establecerAnioMes() {
        $('#selectAnio').val(fecha.getFullYear());
        $('#selectMes').val(fecha.getMonth() + 1);
    }

    //Función propia del plugin de DateRangePicker con el cual se da formato y funcionamiento al input de fecha específica
    $('#inputFecha').daterangepicker({
        singleDatePicker: true,
        autoUpdateInput: false,
        showDropdowns: true,
        minYear: 2021,
        opens: 'center',
        locale: {
            applyLabel: 'Aplicar',
            cancelLabel: 'Cancelar'
        } 
    });

    //Botón que se forma mediante los estilos del plugin de DateRangePicker y que al oprimirse permite guardar la fecha seleccionada en una cadena de string como value del input de fecha específica
    $('#inputFecha').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY'));
        tablaReportes.ajax.reload();
    });

    //Función que permite establecer que elementos se van a mostrar en la vista dependiendo del tipo de reporte que el usuario haya elegido para visualizar
    function parametrosReporteElegido(tipoReporte) {
        if(tipoReporte == 1){
            $('#selectAnio').prop('required', true);
            $('#selectMes').prop('required', true);

            if ($('#columnaFecha').is(':visible')) {
                $('#columnaFecha').css('display', 'none');
            }
            if ($('#columnaIdentificacion').is(':visible')) {
                $('#columnaIdentificacion').css('display', 'none');
            }
            if ($('#columnaAnio').is(':hidden')) {
                $('#columnaAnio').css('display', '');
            }
            if ($('#columnaMes').is(':hidden')) {
                $('#columnaMes').css('display', '');
            }
            if ($('#columnaTipoPersona').is(':hidden')) {
                $('#columnaTipoPersona').css('display', '');
            }
            if ($('#columnaCiudad').is(':hidden')) {
                $('#columnaCiudad').css('display', '');
            }
        } else if(tipoReporte == 2) {
            $('#inputFecha').prop('required', true);

            if ($('#columnaAnio').is(':visible')) {
                $('#columnaAnio').css('display', 'none');
            }
            if ($('#columnaMes').is(':visible')) {
                $('#columnaMes').css('display', 'none');
            }
            if ($('#columnaIdentificacion').is(':visible')) {
                $('#columnaIdentificacion').css('display', 'none');
            }
            if ($('#columnaFecha').is(':hidden')) {
                $('#columnaFecha').css('display', '');
            }
            if ($('#columnaTipoPersona').is(':hidden')) {
                $('#columnaTipoPersona').css('display', '');
            }
            if ($('#columnaCiudad').is(':hidden')) {
                $('#columnaCiudad').css('display', '');
            }
        } else if(tipoReporte == 3) {
            $('#selectAnio').prop('required', true);
            $('#selectMes').prop('required', true);
            $('#inputIdentificacion').prop('required', true);

            if ($('#columnaFecha').is(':visible')) {
                $('#columnaFecha').css('display', 'none');
            }
            if ($('#columnaTipoPersona').is(':visible')) {
                $('#columnaTipoPersona').css('display', 'none');
            }
            if ($('#columnaCiudad').is(':visible')) {
                $('#columnaCiudad').css('display', 'none');
            }
            if ($('#columnaAnio').is(':hidden')) {
                $('#columnaAnio').css('display', '');
            }
            if ($('#columnaMes').is(':hidden')) {
                $('#columnaMes').css('display', '');
            }
            if ($('#columnaIdentificacion').is(':hidden')) {
                $('#columnaIdentificacion').css('display', '');
            }
        }
    }

    //Al seleccionar un tipo de reporte se muestran los diferentes inputs para realizar filtros de información, esto dependiendo del tipo de reporte que el usuario seleccione
    $('#selectTipoReporte').on('change', function () { 
        if ($('#botones').is(':hidden')) {
            $('#botones').css('display', '');
        }
        if ($('#columnaBoton').is(':hidden')) {
            $('#columnaBoton').css('display', '');
        }
        $('.requerido').prop('required', false);
        $('#btnLimpiar').trigger('click');
        parametrosReporteElegido(this.value);
    });

    //Función anónima que se ejecuta al cargar inicialmente la página y permite detectar si hay datos mal ingresados en los filtros devolviendo la información previamente ingresada, de lo contrario se caragan automáticamente el año y mes actual en su correpondientes inputs
    (function () {
        if($('#selectTipoReporte').val() != null){
            if ($('#selectTipoPersona').val() != null) {
                $('#columnaEmpresa').css('display', '');
            }
            $('#selectAnio').val($('#retornoAnio').val());
            $('#botones').css('display', '');
            $('#columnaBoton').css('display', '');
            parametrosReporteElegido($('#selectTipoReporte').val());
        }  else {
            establecerAnioMes();   
        }      
    })();

    //Uso de DataTables para mostrar la información de los registros realizados dependiendo de la información que este seleccionada en los filtros de generación de reportes
    var tablaReportes = $('#tablaReportes').DataTable({
        'destroy': true,
        'processing': true,
        'responsive': true,
        'autoWidth': false,
        'ajax': {
            'url': 'reportes/informacion',
            'data': function ( d ) {
                d.tipoReporte = $('#selectTipoReporte').val();
                d.anio = $('#selectAnio').val();
                d.mes = $('#selectMes').val();
                d.tipoPersona = $('#selectTipoPersona').val();
                d.empresa = $('#selectEmpresa').val();
                d.ciudad = $('#selectCiudad').val();
                d.fecha = $('#inputFecha').val();
                d.identificacion = $('#inputIdentificacion').val();
            }
        },
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
                render: function (data) {
                    return data.nombre+' '+data.apellido;
                }
            },
            {
                'data': 'identificacion',
                'name': 'identificacion',
            },
            {
                'data': null, 
                'name': 'empresa',
                render: function (data) {
                    if(data.id_tipo_persona == 1 || data.id_tipo_persona == 4){ return data.empresavisitada; }
                    return data.empresa;
                }
            },
            {
                'data': null, 
                'name': 'colaborador',
                render: function (data) {
                    if(data.id_tipo_persona == 1 || data.id_tipo_persona == 4){ return data.colaborador; }
                    return '';
                }
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
                    if(data != null){ return moment(data).format('DD-MM-YYYY'); }
                    return 'Sin salida';
                } 
            },
            {
                'data': 'salida_persona',
                render: function (data) {
                    if(data != null){ return moment(data).format('h:mm:ss a'); }
                    return 'Sin salida';
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
            },   
            {
                'data': 'name',
                'name': 'name',
            },
        ],
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

    //Al selecionar alguno de los filtros de año, mes, empresa o ciudad se actualiza la tabla donde se muestra la información de los registros con la nueva información solicitada
    $('#selectAnio, #selectMes, #selectEmpresa, #selectCiudad').on('change', function () { 
        tablaReportes.ajax.reload();
    });

    //Al selecionar un tipo de persona, si este es un visitante se muestra en pantalla el input de filtar por empresa, de lo contrario se oculta, también se actualiza la tabla donde se muestra la información de los registros con la nueva información solicitada
    $('#selectTipoPersona').on('change', function () { 
        tablaReportes.ajax.reload();
        if(this.value == 1){
            $('#columnaEmpresa').css('display', '');
        } else {
            $('#selectEmpresa').val('');
            $('#columnaEmpresa').css('display', 'none');
        }
    });

    //Al escribir un número en el filtro de indentificación se actualiza la tabla donde se muestra la información de los registros con la nueva información solicitada
    $('#inputIdentificacion').on('keyup', function () { 
        tablaReportes.ajax.reload();
    });

    //Función que permite validar los filtros para verificar que se este poniendo la información necesaria antes de que esta se envie al servidor
    function validarInputs() {
        var form = document.getElementById('formulario');
        if (!form.checkValidity()) {
            $('.filtros').each(function (index) {
                if (!this.checkValidity()) {
                    $(this).addClass('is-invalid');
                }
            });
            return false;
        } else {
            return true;
        }
    }

    //Si en un input de cualquiera de los filtros esta la clase is-invalid al escribir en el mismo input se elimina esta clase 
    $('input.filtros').keydown(function () {
        if ($(this).hasClass('is-invalid')) {
            $(this).removeClass('is-invalid');
        }
    });

    //Si en el input de fecha específica esta la clase is-invalid al posicionarse en el mismo input se elimina esta clase 
    $('#inputFecha').focus(function() {
        if ($(this).hasClass('is-invalid')) {
            $(this).removeClass('is-invalid');
        }
    });

    //Si en un select de cualquiera de los filtros esta la clase is-invalid al seleccionar algo en el mismo select se elimina esta clase 
    $('select.filtros').change(function () {
        if ($(this).hasClass('is-invalid')) {
            $(this).removeClass('is-invalid');
        }
    });

    //Botón que permite limpiar los filtros de información de los datos que se hayan puesto previamente, además se restablece el año y el mes actual en los filtros correspondientes
    $('#btnLimpiar').click(function() {
        if ($('#columnaEmpresa').is(':visible')) {
            $('#columnaEmpresa').css('display', 'none');
        }
        if ($('.filtros').hasClass('is-invalid')) {
            $('.filtros').removeClass('is-invalid');
        }
        $('.filtros').val('');
        establecerAnioMes();
    });

    //Botón que al ser seleccionado permite validar la información seleccionada en los filtros, si esta validación es correcta se envían los datos al servidor para solicitar el reporte seleccionado en formato Excel
    $('#btnExcel').click(function() {
        if(validarInputs()){
            $('#inputFormato').val('excel');
            document.getElementById('formulario').submit();
        }
    });

    //Botón que al ser seleccionado permite validar la información seleccionada en los filtros, si esta validación es correcta se envían los datos al servidor para solicitar el reporte seleccionado en formato PDF
    $('#btnPdf').click(function() {
        if(validarInputs()){
            $('#inputFormato').val('pdf');
            document.getElementById('formulario').submit();
        }
    });
});