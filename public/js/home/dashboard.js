
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
    series: [{
      name: 'AVIOMAR',
      data: [44, 55, 41, 64, 22, 43]
    }, {
      name: 'SNIDER',
      data: [53, 32, 33, 52, 13, 44]
    }, {
      name: 'COLVAN',
      data: [53, 32, 33, 52, 13, 44]
    }],
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
    },
    xaxis: {
      categories: [2001, 2002, 2003, 2004, 2005, 2006],
    }
  };
  var grafico2 = new ApexCharts(document.querySelector("#grafico2"), options2);
  grafico2.render();

  //Opciones del gráfico de porcentaje de ingreso de visitantes al año
  var options3 = {
    series: [30, 45, 30],
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
              label: 'TOTAL 2022',
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
        fontSize: '15px',
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
    
  //Función Ajax que hace una petición al servidor para traer el número de registros de visitantes, colaboradores con activo, conductores y vehículos realizados en el mes actual y los cinco meses anteriores a este, una vez obtenidos los registros se organizan en el gráfico de ingresos individuales por mes
  function obtenerTotalRegistrosPorMes(ciudadSeleccionada = null) {
    $.ajax({
      url: 'home/registros_mes',
      type: 'GET',
      data: {
        ciudad: ciudadSeleccionada,
      },
      dataType: 'json',
      success: function (response) {
        grafico1.updateOptions({
          series: [{
            name: 'VISITANTES',
            data: response.totalRegistrosPorMes[0]
          }, {
            name: 'COLABORADORES ACTIVO',
            data: response.totalRegistrosPorMes[1]
          }, {
            name: 'CONDUCTORES',
            data: response.totalRegistrosPorMes[2]
          }, {
            name: 'VEHÍCULOS',
            data: response.totalRegistrosPorMes[3]
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
  obtenerTotalRegistrosPorMes();

  //Al seleccionar alguna ciudad se toma el id del elemento seleccionado y se envia a otra función para realizar la consulta de información y poder actualizar los gráficos dependiendo de la ciudad seleccionada
  $('#bogota, #cartagena, #buenaventura').on('click', function () {
    $('#dropdownSubMenu').text($(this).text());
    obtenerNumeroRegistros($(this).attr('id'));
    obtenerTotalRegistrosPorMes($(this).attr('id'));
  });

    

    // console.log(<?php  {{$visitantes}} ?>);



      
  //   var options = {
  //     series: [{
  //     data: [30,40,35,50,49,60,70]
  //   }],
  //     chart: {
  //     id: 'barYear',
  //     height: 400,
  //     width: '100%',
  //     type: 'bar',
  //     events: {
  //       dataPointSelection: function (e, chart, opts) {
  //         var quarterChartEl = document.querySelector("#chart-quarter");
  //         var yearChartEl = document.querySelector("#chart2");
    
  //         if (opts.selectedDataPoints[0].length === 1) {
  //           if (quarterChartEl.classList.contains("active")) {
  //             updateQuarterChart(chart, 'barQuarter')
  //           } else {
  //             yearChartEl.classList.add("chart-quarter-activated")
  //             quarterChartEl.classList.add("active");
  //             updateQuarterChart(chart, 'barQuarter')
  //           }
  //         } else {
  //           updateQuarterChart(chart, 'barQuarter')
  //         }
    
  //         if (opts.selectedDataPoints[0].length === 0) {
  //           yearChartEl.classList.remove("chart-quarter-activated")
  //           quarterChartEl.classList.remove("active");
  //         }
    
  //       },
  //       updated:  function (chart) {
  //         updateQuarterChart(chart, 'barQuarter')
  //       }
  //     }
  //   },
  //   plotOptions: {
  //     bar: {
  //       distributed: true,
  //       horizontal: true,
  //       barHeight: '75%',
  //       dataLabels: {
  //         position: 'bottom'
  //       }
  //     }
  //   },
  //   dataLabels: {
  //     enabled: true,
  //     textAnchor: 'start',
  //     style: {
  //       colors: ['#fff']
  //     },
  //     formatter: function (val, opt) {
  //       return opt.w.globals.labels[opt.dataPointIndex]
  //     },
  //     offsetX: 0,
  //     dropShadow: {
  //       enabled: true
  //     }
  //   },
    
  //   // colors: colors,
    
  //   states: {
  //     normal: {
  //       filter: {
  //         type: 'desaturate'
  //       }
  //     },
  //     active: {
  //       allowMultipleDataPointsSelection: true,
  //       filter: {
  //         type: 'darken',
  //         value: 1
  //       }
  //     }
  //   },
  //   tooltip: {
  //     x: {
  //       show: false
  //     },
  //     y: {
  //       title: {
  //         formatter: function (val, opts) {
  //           return opts.w.globals.labels[opts.dataPointIndex]
  //         }
  //       }
  //     }
  //   },
  //   title: {
  //     text: 'Yearly Results',
  //     offsetX: 15
  //   },
  //   subtitle: {
  //     text: '(Click on bar to see details)',
  //     offsetX: 15
  //   },
  //   yaxis: {
  //     labels: {
  //       show: false
  //     }
  //   }
  //   };

  //   var chart = new ApexCharts(document.querySelector("#chart2"), options);
  //   chart.render();
  
  //   var optionsQuarter = {
  //     series: [{
  //     data: []
  //   }],
  //     chart: {
  //     id: 'barQuarter',
  //     height: 400,
  //     width: '100%',
  //     type: 'bar',
  //     stacked: true
  //   },
  //   plotOptions: {
  //     bar: {
  //       columnWidth: '50%',
  //       horizontal: false
  //     }
  //   },
  //   legend: {
  //     show: false
  //   },
  //   grid: {
  //     yaxis: {
  //       lines: {
  //         show: false,
  //       }
  //     },
  //     xaxis: {
  //       lines: {
  //         show: true,
  //       }
  //     }
  //   },
  //   yaxis: {
  //     labels: {
  //       show: false
  //     }
  //   },
  //   title: {
  //     text: 'Quarterly Results',
  //     offsetX: 10
  //   },
  //   tooltip: {
  //     x: {
  //       formatter: function (val, opts) {
  //         return opts.w.globals.seriesNames[opts.seriesIndex]
  //       }
  //     },
  //     y: {
  //       title: {
  //         formatter: function (val, opts) {
  //           return opts.w.globals.labels[opts.dataPointIndex]
  //         }
  //       }
  //     }
  //   }
  //   };

  //   var chartQuarter = new ApexCharts(document.querySelector("#chart-quarter"), optionsQuarter);
  //   chartQuarter.render();
  
  
  //   chart.addEventListener('dataPointSelection', function (e, chart, opts) {
  //   var quarterChartEl = document.querySelector("#chart-quarter");
  //   var yearChartEl = document.querySelector("#chart2");
  
  //   if (opts.selectedDataPoints[0].length === 1) {
  //     if(quarterChartEl.classList.contains("active")) {
  //       updateQuarterChart(chart, 'barQuarter')
  //     }
  //     else {
  //       yearChartEl.classList.add("chart-quarter-activated")
  //       quarterChartEl.classList.add("active");
  //       updateQuarterChart(chart, 'barQuarter')
  //     }
  //   } else {
  //       updateQuarterChart(chart, 'barQuarter')
  //   }
  
  //   if (opts.selectedDataPoints[0].length === 0) {
  //     yearChartEl.classList.remove("chart-quarter-activated")
  //     quarterChartEl.classList.remove("active");
  //   }
  
  // })
  
  // chart.addEventListener('updated', function (chart) {
  //   updateQuarterChart(chart, 'barQuarter')
  // })
  
  // document.querySelector("#model").addEventListener("change", function (e) {
  //   chart.updateSeries([{
  //     data: [30,40,35,50,49,60,70]
  //   }])
  // })



    // var options = {
    //     chart: {
    //       type: 'line',
    //       height: 450,
    //     },
    //     series: [{
    //       name: 'sales',
    //       data: [30,40,35,50,49,60,70,91,125]
    //     }],
    //     xaxis: {
    //       categories: [1991,1992,1993,1994,1995,1996,1997, 1998,1999]
    //     }
    //   }
      
    //   var chart = new ApexCharts(document.querySelector("#chart2"), options);
    //   chart.render();

});