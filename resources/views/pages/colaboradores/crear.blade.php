@extends('themes.lte.layout')

@section('titulo')
    Colaboradores
@endsection

@section('css')
<!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('scripts')
    <!-- Select2 -->
    <script src="{{ asset('assets/lte/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(function() {

            $('#selectCodigo').select2({
                theme: 'bootstrap4',
                placeholder: 'Seleccione el código del computador',
                language: {
                noResults: function() {
                    return "No hay resultado";        
                }}
            });

            $('#selectCodigo').change(function() { 
                $.ajax({
                    url: '/colaboradores/persona',
                    type: 'GET',
                    data: {
                        colaborador: $('#selectCodigo option:selected').val(),
                    },
                    dataType: 'json',
                    success: function(response){                      
                        $('#inputNombre').val(response['firstname']);
                        $('#inputApellido').val(response['realname']);
                        $('#inputIdentificacion').val(response['registration_number']);
                        // $.each(response.data, function(key, value){                   
                        //     $('#selectPersona').append("<option value='" + value.id_personas + "'> C.C. " + value.identificacion + " - " + value.nombre + " " + value.apellido + "</option>");
                        // });                                                 
                    }, 
                    error: function(){
                        console.log('Error obteniendo los datos');
                    }
                }); 
            }); 

        });
    </script>
@endsection

@section('contenido')
    <div class="content mb-n2">
        @include('pages.colaboradores.header')
    </div>

    <section class="content-header">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('crearColaborador') }}" method="POST">
                    @csrf
                    <div>
                        @include('pages.colaboradores.formularioCrear')
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection