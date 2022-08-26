@extends('themes.lte.layout')

@section('titulo')
    Vehículos
@endsection

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('scripts')
    <!-- Select2 -->
    <script src="{{ asset('assets/lte/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- JavaScript propio -->
    <script src="{{ asset('js/vehiculos/vehiculosCrear.js') }}"></script>
@endsection

@section('contenido')
    <div class="content mb-n2">
        @include('pages.vehiculos.header')
    </div>

    <section class="content-header mb-n4">
        <div class="row">
            <div class="col-12">
                <form id="formularioVehiculo" action="{{ route('crearVehiculo') }}" method="POST" novalidate>
                    @csrf
                    <div>
                        @include('pages.vehiculos.formularioCrear')
                    </div>
                </form>
            </div>
        </div>

        @include('pages.vehiculos.modales')
        @include('pages.modalError')

    </section>
@endsection