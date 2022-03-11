@extends('themes.lte.layout')

@section('titulo')
    Visitantes
@endsection

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('scripts')
    <script>
        $(function() {

            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Muestra el modal y redirecciona en caso de que se oprima el botón
            $('#modal-crear').modal("show");
            $('#botonContinuar').click(function() {
                $(location).attr('href', 'http://app-seguridad.test/visitantes');
            });

            //Manejo de los checkbox y control de la vista de formularios   
            $('input[type=checkbox]').on('change', function() {
                if ($('#checkVehiculo').is(":checked") && ($('#checkActivo').prop("checked") == false)) {
                    $('#crearVehiculo').css("display", "block");
                    $('#crearActivo').css("display", "none");
                    $('#botonCrear').css("display", "none");
                    $('#botonCrear2').css("display", "inline");

                } else if ($('#checkActivo').is(":checked") && ($('#checkVehiculo').prop("checked") ==
                        false)) {
                    $('#crearActivo').css("display", "block");
                    $('#crearVehiculo').css("display", "none");
                    $('#botonCrear').css("display", "none");

                } else if ($('#checkVehiculo').is(":checked") && $('#checkActivo').is(":checked")) {
                    $('#botonComprimirVisitante').trigger("click");
                    $('#crearVehiculo').css("display", "block");
                    $('#crearActivo').css("display", "block");
                    $('#botonCrear2').css("display", "none");

                } else {
                    $('#crearVehiculo').css("display", "none");
                    $('#crearActivo').css("display", "none");
                    $('#botonCrear').css("display", "inline");
                }
            });

            //Manejo de los botones de eliminar de los formularios
            $('#botonCerrar2').click(function() {
                if($('#crearActivo').is(":visible")){
                    $('#botonComprimirVisitante').trigger("click");                                  
                } else {
                    $('#botonCrear').css("display", "inline");
                }
                $('#crearVehiculo').css("display", "none");
                $('#botonLimpiar2').trigger("click");
                $('#checkVehiculo').prop("checked", false);
            });

            $('#botonCerrar3').click(function() {              
                if($('#crearVehiculo').is(":visible")){
                    $('#botonComprimirVisitante').trigger("click"); 
                    $('#botonCrear2').css("display", "inline");                 
                } else {
                    $('#botonCrear').css("display", "inline");
                }
                $('#crearActivo').css("display", "none");
                $('#botonLimpiar3').trigger("click");
                $('#checkActivo').prop("checked", false);
            });



            //Toma la información del formulario del visitante y del vehículo y los envia al backend
            // $('#botonCrear2').click(function() {
            //     var formObject = {};
            //     var formArray = $("#formularioVisitante").serializeArray();
            //     $.each(formArray,function(i,item){
            //         formObject[item.name] = item.value;
            //     });
            //     var allData = JSON.stringify(formObject);

            //     $.ajax({       
            //         url:   "{{ route('crearVisitanteVehiculo') }}",
            //         data: formObject,         
            //         type:  'post',
            //         success:  function (response) { 
            //             //    alert("Funciona");
            //         },
            //         error:function(x,xs,xt){
            //             // window.open(JSON.stringify(x));
            //             alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
            //         }
            //     });
            // });

            $('#botonCrear2').click(function() {
                /*Evita que se recargue la página*/
                // event.preventDefault();
                /* Serializamos en una sola variable ambos formularios*/
                // var formObject = {};
                // var formArray = $("#formularioVisitante").serializeArray();
                // $.each(formArray,function(i,item){
                //     formObject[item.name] = item.value;
                // });

                // var allData = $('#formularioVisitante').serializeArray();
                // var allData = JSON.stringify(formObject);
                //serializeArray
                // console.log(formObject);
                // console.log(allData);
                //#formularioVehiculo"
                // $.ajaxSetup({
                //     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                // });


            //     $.ajax({       
            //         url:   "{{ route('crearVisitanteVehiculo') }}",
            //         data: {'name':"luis"},
            //             // '_token': '{{ csrf_token() }}',
                        
            //         type:  'post',
            //         // dataType: 'json',
            //         // beforeSend: function () {
            //         //         // $("#resultado").html("Procesando, espere por favor...");
            //         // },
            //         success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
            //             //    alert("Funciona");
            //         },
            //         error:function(x,xs,xt){
            //             // window.open(JSON.stringify(x));
            //             alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
            //         }
            //     });
            // });


        });
    </script>
@endsection

@section('contenido')
    <div class="content mb-n2">
        @include('pages.visitantes.header')
    </div>

    <section class="content-header">
        <div class="row">
            <div class="col-md-12">
                {{-- <form id="formularioVisitante" action="{{ route('crearVisitante') }}" method="POST">
                    @csrf --}}
                <div>
                    @include('pages.visitantes.formularioCrear')
                </div>

                <div id="crearVehiculo" style="display: none">
                    @include('pages.formCrearVehiculo')
                </div>

                <div id="crearActivo" style="display: none">
                    @include('pages.formCrearActivo')
                </div>
                {{-- </form> --}}
            </div>
        </div>

        @include('pages.visitantes.modales')

    </section>
@endsection
