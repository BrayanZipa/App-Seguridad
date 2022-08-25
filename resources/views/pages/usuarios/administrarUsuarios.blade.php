@extends('themes.lte.layout')

@section('titulo')
    Usuarios
@endsection

@section('css')
    <!-- Ionicons -->
    {{-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/select2/css/select2.min.css') }}"> --}}
    <!-- Select2 -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}"> --}}
@endsection

@section('scripts')
    <!-- Select2 -->
    {{-- <script src="{{ asset('assets/lte/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- JavaScript propio -->
    <script src="{{ asset('js/colaboradores/colaboradoresCrear.js') }}"></script> --}}
@endsection

@section('contenido')

    <div class="content mb-n2">
        @include('pages.usuarios.header')
    </div>

    <section class="content-header">
        <div class="row">
            <div class="col">
                
            </div>
        </div>
    </section>
    
@endsection