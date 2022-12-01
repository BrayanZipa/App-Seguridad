$(function () {

    const fecha = new Date();

    //Permite establecer en el input de filtrar por año un lista de años que van desde el año 2022 hasta el año actual
    for (let i= 2022; i <= fecha.getFullYear(); i++) {
        $('#selectAnio').append(`<option value="${i}">${i}</option>`);
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
    });

    // $.ajax({
    //     url: 'listado_por_persona',
    //     type: 'GET',
    //     data: {
    //         persona: idPersona,
    //         anio: $('#selectAnio option:selected').val(),
    //         mes: $('#selectMes option:selected').val(),
    //     },
    //     dataType: 'json',
    //     success: function(response) {   
    //         if('registros' in response){
    //             $('#totalRegistros').val(response.totalRegistros);
    //             if(response.totalRegistros != 0){ 
    //                 $('#tablaRegistros').css('display', '');     
    //                 $.each(response.registros, function(key, value){   
    //                     if(value.identificador == null){
    //                         value.identificador = 'No';
    //                     }
    //                     if(value.codigo_activo == null){
    //                         value.codigo_activo = 'No';
    //                     }

    //                     $('#tablaRegistrosFilas').append(
    //                         `<tr>
    //                         <td>${moment(value.ingreso_persona).format('DD-MM-YYYY')}</td>
    //                         <td>${moment(value.ingreso_persona).format('h:mm:ss a')}</td>
    //                         <td>${moment(value.salida_persona).format('DD-MM-YYYY')}</td>
    //                         <td>${moment(value.salida_persona).format('h:mm:ss a')}</td>
    //                         <td>${value.identificador}</td>
    //                         <td>${value.codigo_activo}</td>
    //                         </tr>`
    //                     );
    //                 }); 

    //                 if($('#tablaRegistros')[0].clientHeight > 300){
    //                     $('thead > tr > th').css({ 
    //                         'position': 'sticky',
    //                         'top': '0',
    //                         'z-index': '10',
    //                         'background-color': '#fff'   
    //                     });

    //                     $('#tablaRegistros').css('height', '300px');
    //                     $('#tablaRegistrosFilas').css('overflow-y', 'scroll');
    //                 } else {
    //                     $('#tablaRegistros').css('height', 'auto');
    //                 }                     
    //             } 
    //         }
    //     },
    //     error: function() {
    //         console.log('Error obteniendo los datos de la base de datos');
    //     }
    // });

    //Uso de DataTables para mostrar los registros realizados en donde se completo tanto las entradas como salidas de todos los tipos de persona (visitantes, conductores, colaboradores con y sin activo)
    // var estado = false;
    // if($('#thCiudad').length){ 
    //     estado = true;
    // } 

    // var tablaRegistros = $('#tablaReportes').DataTable({
    //     'dom': "<'row'<'col-sm-12 col-md-6'l>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
    //     'destroy': true,
    //     'processing': true,
    //     'responsive': true,
    //     'autoWidth': false,
    //     // 'serverSide': true,
    //     // 'scrollY': '300px',
    //     'ajax': 'informacion',
    //     'dataType': 'json',
    //     'type': 'GET',
    //     'columns': [
    //         {
    //             'data': 'id_registros',
    //             'name': 'id_registros'
    //         },
    //         {
    //             'data': 'tipopersona',
    //             'name': 'tipopersona'
    //         },
    //         {  
    //             'data': null, 
    //             'name': 'nombre',
    //             render: function ( data, type, row ) {
    //                 return data.nombre+' '+data.apellido;
    //             }
    //         },
    //         {
    //             'data': 'identificacion',
    //             'name': 'identificacion',
    //         },
    //         {
    //             'data': 'ingreso_persona',
    //             render: function (data) {
    //                 return moment(data).format('DD-MM-YYYY');
    //             } 
    //         },
    //         {
    //             'data': 'ingreso_persona',
    //             render: function (data) {
    //                 return moment(data).format('h:mm:ss a');
    //             } 
    //         },
    //         {
    //             'data': 'salida_persona',
    //             render: function (data) {
    //                 return moment(data).format('DD-MM-YYYY');
    //             } 
    //         },
    //         {
    //             'data': 'salida_persona',
    //             render: function (data) {
    //                 return moment(data).format('h:mm:ss a');
    //             } 
    //         }, 
    //         {
    //             'data': 'ingreso_activo',
    //             render: function (data, type, row) {
    //                 if(data != null){ return row.codigo_activo; }
    //                 return 'No';
    //             } 
    //         },
    //         {
    //             'data': 'ingreso_vehiculo',
    //             render: function (data, type, row ) {
    //                 if(data != null){ return row.identificador; }
    //                 return 'No';
    //             }
    //         },   
    //         {
    //             'data': 'city',
    //             'name': 'city',
    //             'visible': estado
    //         },   
    //         {
    //             'data': 'name',
    //             'name': 'name',
    //             // 'searchable': false,
    //             // 'orderable': false
    //         },
    //         {
    //             'class': 'consultar_registro',
    //             'orderable': false,
    //             'data': null,
    //             'defaultContent': '<td>' +
    //                 '<div class="action-buttons text-center">' +
    //                 '<a href="#" class="btn btn-primary btn-icon btn-sm">' +
    //                 '<i class="fa-solid fa-eye"></i>' +
    //                 '</a>' +
    //                 '</div>' +
    //                 '</td>',
    //         }],
    //     'order': [[0, 'desc']],  
    //     'lengthChange': true,
    //     'lengthMenu': [
    //         [6, 10, 25, 50, 75, 100, -1],
    //         [6, 10, 25, 50, 75, 100, 'ALL']
    //     ],
    //     'language': {
    //         'lengthMenu': 'Mostrar _MENU_ registros por página',
    //         'zeroRecords': 'No hay registros',
    //         'info': 'Mostrando página _PAGE_ de _PAGES_',
    //         'infoEmpty': 'No hay registros disponibles',
    //         'infoFiltered': '(filtrado de _MAX_ registros totales)',
    //         'search': 'Buscar:',
    //         'paginate': {
    //             'next': 'Siguiente',
    //             'previous': 'Anterior'
    //         }
    //     },
    // });
    // $('#inputBuscar').focus();

    //Función que permite esrablecer el año y el mes actual en el input de filtrar por año y en el input de filtrar por mes respectivamente
    function establecerAnioMes() {
        $('#selectAnio').val(fecha.getFullYear());
        $('#selectMes').val(fecha.getMonth() + 1);
    }

    //Al seleccionar un tipo de reporte se muestran los diferentes inputs para realizar filtros de información, esto dependiendo del tipo de reporte que el usuario seleccione
    $('#selectTipoReporte').on('change', function () { 
        if ($('#columnaBoton').is(':hidden')) {
            $('#columnaBoton').css('display', '');
        }
        $('.requerido').prop('required', false);
        $('#btnLimpiar').trigger('click');
        
        if(this.value == 1){
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
        } else if(this.value == 2) {
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
        } else {
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
    });

    //Al selecionar un tipo de persona, si este es un visitante se muestra en pantalla el input de filtar por empresa, de lo contrario se oculta
    $('#selectTipoPersona').on('change', function () { 
        if(this.value == 1){
            $('#columnaEmpresa').css('display', '');
        } else {
            $('#selectEmpresa').val('');
            $('#columnaEmpresa').css('display', 'none');
        }
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

    //
    $('#btnExcel').click(function() {
        if(validarInputs()){
            $('#inputFormato').val('excel');
            document.getElementById('formulario').submit();
            // console.log($('#formulario').serialize() + '&formato=excel');
            // descargarReporte('&formato=excel');
        }
    });

    //
    $('#btnPdf').click(function() {
        if(validarInputs()){
            $('#inputFormato').val('pdf');
            document.getElementById('formulario').submit();
            // console.log($('#formulario').serializeArray());
            // descargarReporte('&formato=pdf');
        }
    });

    function descargarReporte(formato) {
        $.ajax({
            xhrFields:{
                responseType: 'blob'
            },
            url: 'reportes/exportar',
            type: 'GET',
            data: $('#formulario').serialize() + formato,
            // dataType: 'json',
            success: function(data) {
                var url = window.URL || window.webkitURL;
                var link = document.createElement('a');
                link.href = url.createObjectURL(data);
                link.download = 'reporte.xlsx';
                link.click();
                a.remove();

                // window.open(objectUrl);

            },
            error: function() {
                console.log('Error obteniendo los datos de la base de datos');
            }
        });
    }


    //Función anónima que se ejecuta si el botón mencionado se crea en la interfaz debido a errores cometidos en el ingreso del formulario crear vehículo
    (function () {
        if($('#selectTipoReporte').val() != ''){

        }        
    })();


    // function cargar_años() {
    //     // $('#anio1').empty();
    //     // $('#anio1').append('<option value="">---</option>');
    //     for (let i= 2021; i <= fecha.getFullYear(); i++) {
    //         $('#selectAnio').append(`<option value="${i}">${i}</option>`);
    //     }
    //     // $('#anio1').val(dt.getFullYear()).trigger('change')
    //     $('#selectAnio').val(fecha.getFullYear());
    // }
    
    // cargar_años()

        // (function () {
    //     'use strict'
    //     var form = document.getElementById('formulario');
    //     form.addEventListener('submit', function (event) {
    //         if (!form.checkValidity()) {
    //             event.preventDefault();
    //             event.stopPropagation();

    //             $('.filtros').each(function (index) {
    //                 if (!this.checkValidity()) {
    //                     $(this).addClass('is-invalid');
    //                 }
    //             });
    //         }
    //     }, false);
    // })();

});