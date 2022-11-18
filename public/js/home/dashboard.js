
$(function () {

  //Opciones del gráfico de ingresos individuales por mes
  var options = {
    series: [],
    chart: {
      type: 'bar',
      height: 450,
      stacked: true,
      redrawOnParentResize: true,
      redrawOnWindowResize: true,
      toolbar: {
        show: false
      }
    },
    title: {
      text: 'Ingresos individuales por mes',
      align: 'center',
      margin: 20,
      style: {
        fontSize: '16px',
        fontWeight: 'bold',
        color: '#787878'
      },
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
    dataLabels: {
      enabled: true,
      offsetY: 2,
      style: {
        fontSize: '14px',
        colors: ['#fff']
      }
    },
    legend: {
      position: 'right',
      offsetY: 50
    },
    fill: {
      opacity: 1
    }
  };
  var grafico1 = new ApexCharts(document.querySelector('#grafico1'), options);
  grafico1.render();

  //Opciones del gráfico de ingreso de visitantes por empresa
  var options2 = {
    series: [],
    chart: {
      type: 'bar',
      height: 450,
      redrawOnParentResize: true,
      redrawOnWindowResize: true,
      toolbar: {
        show: false
      },
    },
    title: {
      text: 'Ingreso de visitantes por empresa',
      align: 'center',
      margin: 20,
      style: {
        fontSize: '16px',
        fontWeight: 'bold',
        color: '#787878'
      },
    },
    colors: ['#008FFB', '#FF9800', '#00E396'],
    plotOptions: {
      bar: {
        horizontal: true,
        dataLabels: {
          position: 'top',
        },
      }
    },
    dataLabels: {
      enabled: true,
      offsetX: -6,
      style: {
        fontSize: '14px',
        colors: ['#fff']
      }
    },
    tooltip: {
      shared: true,
      intersect: false
    }
  };
  var grafico2 = new ApexCharts(document.querySelector("#grafico2"), options2);
  grafico2.render();

  //Opciones del gráfico de porcentaje de ingreso de visitantes al año
  var options3 = {
    series: [],
    chart: {
      height: 350,
      type: 'donut',
      redrawOnParentResize: true,
      redrawOnWindowResize: true,
    },
    labels: ['AVIOMAR', 'SNIDER', 'COLVAN'],
    colors: ['#008FFB', '#FF9800', '#00E396'],
    title: {
      text: 'Porcentaje de ingreso de visitantes al año',
      align: 'center',
      margin: 40,
      style: {
        fontSize: '16px',
        fontWeight: 'bold',
        color: '#787878'
      },
    },
    responsive: [{
      breakpoint: 480,
      options: {
        chart: {
          width: 300
        },
        legend: {
          position: 'bottom'
        }
      }
    }],
    plotOptions: {
      pie: {
        dataLabels: {
          offset: 4,
        },
        donut: {
          size: '60%',
          labels: {
            show: true,
            value: {
              show: true,
              fontSize: '16px',
              fontWeight: 'bold',
              color: '#787878'
            },
            total: {
              showAlways: true,
              show: true,
              fontSize: '15px',
              fontWeight: 'bold',
              color: '#787878',
            }
          }
        }
      }
    },
    dataLabels: {
      style: {
        fontSize: '14px',
        fontWeight: 'normal',
        colors: ['#fff']
      }
    },
    legend: {
      position: 'right',
      offsetY: 45,
    }
  };
  var grafico3 = new ApexCharts(document.querySelector("#grafico3"), options3);
  grafico3.render();

  //Función que permite realizar un contador que va desde cero hasta el número que se le pase como parámetro y a medida que va contando se va mostrando en la vista 
  function contar(elemento, totalRegistros) {
    var cantidad = 0;
    var tiempo = setInterval(() => {
      if (totalRegistros === 0) {
        $(elemento).text(cantidad);
        clearInterval(tiempo);
      } else {
        cantidad += 1;
        $(elemento).text(cantidad);
        if (cantidad === totalRegistros) {
          clearInterval(tiempo);
        }
      }
    }, 80);
  }
  contar('#numVisitantes', parseInt($('#numVisitantes').text()));
  contar('#numColaboradoresActivo', parseInt($('#numColaboradoresActivo').text()));
  contar('#numConductores', parseInt($('#numConductores').text()));
  contar('#numVehiculos', parseInt($('#numVehiculos').text()));

  //Función Ajax que hace una petición al servidor para traer el número de registros de visitantes, colaboradores con activo, conductores y vehículos realizados el día actual 
  function obtenerNumeroRegistros(ciudadSeleccionada) {
    $.ajax({
      url: 'home/total_registros',
      type: 'GET',
      data: {
        ciudad: ciudadSeleccionada,
      },
      dataType: 'json',
      success: function (response) {
        contar('#numVisitantes', response.visitantes);
        contar('#numColaboradoresActivo', response.colaboradoresActivo);
        contar('#numConductores', response.conductores);
        contar('#numVehiculos', response.vehiculos);
      },
      error: function () {
        console.log('Error obteniendo los datos de la base de datos');
      }
    });
  }
    
  //Función Ajax que hace una petición al servidor para traer el número de registros de visitantes, colaboradores con activo, conductores y vehículos realizados en el mes actual y los cinco meses anteriores a este, una vez obtenidos los valores se organizan en el gráfico de ingresos individuales por mes
  function obtenerTotalIngresosPorMes(ciudadSeleccionada = null) {
    $.ajax({
      url: 'home/ingresos_mes',
      type: 'GET',
      data: {
        ciudad: ciudadSeleccionada,
      },
      dataType: 'json',
      success: function (response) {
        grafico1.updateOptions({
          series: [{
            name: 'VISITANTES',
            data: response.totalIngresosPorMes[0]
          }, {
            name: 'COLABORADORES ACTIVO',
            data: response.totalIngresosPorMes[1]
          }, {
            name: 'CONDUCTORES',
            data: response.totalIngresosPorMes[2]
          }, {
            name: 'VEHÍCULOS',
            data: response.totalIngresosPorMes[3]
          }],
          xaxis: {
            categories: response.meses
          },
        });
      },
      error: function () {
        console.log('Error obteniendo los datos de la base de datos');
      }
    });
  }
  obtenerTotalIngresosPorMes();

  //Función Ajax que hace una petición al servidor para traer el número de registros de visitantes realizados en el mes actual y los cinco meses anteriores a este divididos por la empresa a la que ingreso, una vez obtenidos los valores se organizan en el gráfico de ingreso de visitantes por empresa
  function obtenerTotalIngresosVisitantes(ciudadSeleccionada = null) {
    $.ajax({
      url: 'home/ingresos_visitantes',
      type: 'GET',
      data: {
        ciudad: ciudadSeleccionada,
      },
      dataType: 'json',
      success: function (response) {
        grafico2.updateOptions({
          series: [{
            name: 'AVIOMAR',
            data: response.totalIngresosVisitantesPorMes[0],
          }, {
            name: 'SNIDER',
            data: response.totalIngresosVisitantesPorMes[1],
          }, {
            name: 'COLVAN',
            data: response.totalIngresosVisitantesPorMes[2],
          }],
          xaxis: {
            categories: response.meses,
          }
        }, true);
      },
      error: function () {
        console.log('Error obteniendo los datos de la base de datos');
      }
    });
  }
  obtenerTotalIngresosVisitantes();

  //Función Ajax que hace una petición al servidor para traer el número total de registros de visitantes realizados en lo corrido del año actual dividido por la empresa a la que se ingreso, una vez obtenidos los valores se organizan en el gráfico de porcentaje de ingreso de visitantes al año
  function obtenerTotalIngresosVisitantesAnio(ciudadSeleccionada = null) {
    $.ajax({
      url: 'home/ingresos_visitantes_anio',
      type: 'GET',
      data: {
        ciudad: ciudadSeleccionada,
      },
      dataType: 'json',
      success: function (response) {
        grafico3.updateOptions({
          series: response.totalIngresosVisitantesAnio,
          plotOptions: {
            pie: {
              donut: {
                labels: {
                  total: {
                    label: `TOTAL ${response.anio}`,
                  }
                }
              }
            }
          }
        }, true);
      },
      error: function () {
        console.log('Error obteniendo los datos de la base de datos');
      }
    });
  }
  obtenerTotalIngresosVisitantesAnio();

  //Al seleccionar alguna ciudad se toma el id del elemento seleccionado y se envia a otra función para realizar la consulta de información y poder actualizar los gráficos dependiendo de la ciudad seleccionada
  $('#bogota, #cartagena, #buenaventura').on('click', function () {
    $('#dropdownSubMenu').text($(this).text());
    obtenerNumeroRegistros($(this).attr('id'));
    obtenerTotalIngresosPorMes($(this).attr('id'));
    obtenerTotalIngresosVisitantes($(this).attr('id'));
    obtenerTotalIngresosVisitantesAnio($(this).attr('id'));
  });

});