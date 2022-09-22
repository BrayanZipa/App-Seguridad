
$(function () {

    //Función que permite realizar un contador que va desde cero hasta el número que se le pase como parámetro y a medida que va contando se va mostrando en la vista 
    function contar(elemento, totalRegistros) {
        var cantidad = 0;
        var tiempo = setInterval( () => {
            if(totalRegistros === 0){
                $(elemento).text(cantidad);
                clearInterval(tiempo);
            } else {
                cantidad += 1;
                $(elemento).text(cantidad);

                if(cantidad === totalRegistros){
                    clearInterval(tiempo);
                }
            }
        }, 80);
    }
    contar('#numVisitantes', parseInt($('#numVisitantes').text()));
    contar('#numColaboradoresActivo', parseInt($('#numColaboradoresActivo').text()));
    contar('#numConductores', parseInt($('#numConductores').text()));
    contar('#numVehiculos', parseInt($('#numVehiculos').text()));

    //Al seleccionar alguna ciudad se toma el id del elemento seleccionado y se envia a otra función para realizar la consulta de información
    $('#bogota, #cartagena, #buenaventura').on('click', function() {
        $('#dropdownSubMenu').text($(this).text());
        obtenerNumeroRegistros($(this).attr('id'));
    });

    //Función Ajax que hace una petición al servidor para traer el número de registros de visitantes, colaboradores con activo, conductores y vehículos realizados el día actual 
    function obtenerNumeroRegistros(ciudadSeleccionada) {
        $.ajax({
            url: 'home/total_registros',
            type: 'GET',
            data: {
                ciudad: ciudadSeleccionada,
            },
            dataType: 'json',
            success: function(response) {
                contar('#numVisitantes', response.visitantes);
                contar('#numColaboradoresActivo', response.colaboradoresActivo);
                contar('#numConductores', response.conductores);
                contar('#numVehiculos', response.vehiculos);
            },
            error: function() {
                console.log('Error obteniendo los datos de la base de datos');
            }
        });
    }

    // console.log(<?php  {{$visitantes}} ?>);

    var options = {
        series: [{
        name: 'VISITANTES',
        data: [44, 55, 41, 67, 22, 43]
      }, {
        name: 'COLABORADORES ACTIVO',
        data: [13, 23, 20, 8, 13, 27]
      }, {
        name: 'CONDUCTORES',
        data: [11, 17, 15, 15, 21, 14]
      }, {
        name: 'VEHÍCULOS',
        data: [21, 7, 25, 13, 22, 8]
      }],
        chart: {
        type: 'bar',
        height: 400,
        stacked: true,
        toolbar: {
          show: true
        },
        zoom: {
          enabled: true
        }
      },
      responsive: [{
        breakpoint: 480,
        options: {
          legend: {
            position: 'bottom',
            offsetX: -10,
            offsetY: 0
          }
        }
      }],
      plotOptions: {
        bar: {
          horizontal: false,
          borderRadius: 10
        },
      },
      xaxis: {
        type: 'datetime',
        categories: ['01/01/2011 GMT', '01/02/2011 GMT', '01/03/2011 GMT', '01/04/2011 GMT',
          '01/05/2011 GMT', '01/06/2011 GMT'
        ],
      },
      legend: {
        position: 'right',
        offsetY: 40
      },
      fill: {
        opacity: 1
      }
      };

      var chart = new ApexCharts(document.querySelector("#chart1"), options);
      chart.render();





    var options = {
        chart: {
          type: 'line'
        },
        series: [{
          name: 'sales',
          data: [30,40,35,50,49,60,70,91,125]
        }],
        xaxis: {
          categories: [1991,1992,1993,1994,1995,1996,1997, 1998,1999]
        }
      }
      
      var chart = new ApexCharts(document.querySelector("#chart2"), options);
      chart.render();

});