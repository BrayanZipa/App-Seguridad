@extends('themes.lte.layout')

@section('titulo')
    Visitantes
@endsection

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- icheck-bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection

@section('scripts')
    <!-- Select2 -->
    <script src="{{ asset('assets/lte/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- JavaScript propio -->
    <script src="{{ asset('js/visitantes/visitantesCrear.js') }}"></script>
@endsection

@section('contenido')
    <div class="content mb-n2">
        @include('pages.visitantes.header')
    </div>

    <section class="content-header mb-n4">
        <div class="row">
            <div class="col-md-12">
                <form id="formularioVisitante" action="{{ route('crearVisitante') }}" method="POST" novalidate>
                    @csrf
                    <div>
                        @include('pages.visitantes.formularioCrear')
                    </div>

                    <div id="crearVehiculo" style="display:none">
                        @include('pages.visitantes.formularioCrearVehiculo')
                    </div>

                    <div id="crearActivo" style="display: none">
                        @include('pages.visitantes.formularioCrearActivo')
                    </div>
                </form>
            </div>
        </div>

        <input type="text" id="lector" placeholder="Enfoca este input y usa el lector" autofocus>

        @include('pages.visitantes.modales')
        @include('pages.modalError')

    </section>
@endsection