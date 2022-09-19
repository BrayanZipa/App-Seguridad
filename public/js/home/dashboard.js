
$(function () {

    $('#bogota, #cartagena, #buenaventura').on('click', function() {
        console.log($(this).attr('id'));
        $('#dropdownSubMenu').text($(this).text());
        obtenerNumeroRegistros($(this).attr('id'));
        // $(this).val();
    });

    // $('#bogota, #cartagena, #buenaventura').click(function () {
    //     console.log('buenas');
    //     console.log($(this).val());
    // });

    function obtenerNumeroRegistros(ciudadSeleccionada) {
        $.ajax({
            url: 'prueba',
            type: 'GET',
            data: {
                ciudad: ciudadSeleccionada,
            },
            dataType: 'json',
            success: function(response) {
                $('#numVisitantes').text(response.visitantes);
                $('#numColaboradoresActivo').text(response.colaboradoresActivo);
                $('#numConductores').text(response.conductores);  
                $('#numVehiculos').text(response.vehiculos);
                console.log(response);
            },
            error: function() {
                console.log('Error obteniendo los datos de la base de datos');
            }
        });
    }

    // function count() {
    //     var counter = { var: 0 };
    //     TweenMax.to(counter, 3, {
    //       var: 100,
    //       onUpdate: function () {
    //         var number = Math.ceil(counter.var);
    //         $(".counter").html(number);
    //         if (number === counter.var) {
    //           count.kill();
    //         }
    //       },
    //       onComplete: function () {
    //         count();
    //       },
    //       ease: Circ.easeOut
    //     });
    //   }
    
    //   count();

    //https://www.youtube.com/watch?v=QvEtN0HCUlw

});