@extends('themes.lte.layout')

@section('titulo')
    Conductores
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
    <script src="{{ asset('js/conductores/conductoresCrear.js') }}"></script>
@endsection

@section('contenido')
    <div class="content mb-n2">
        @include('pages.conductores.header')
    </div>

    <section class="content-header mb-n4">
        <div class="row">
            <div class="col-12">
                <form id="formularioConductor" action="{{ route('crearConductor') }}" method="POST" novalidate>
                    @csrf
                    <div class="card">
                        <div>
                            @include('pages.conductores.formularioCrear')
                        </div>

                        <div class="mt-n2 mb-n3">
                            @include('pages.conductores.formCrearVehiculo')
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @include('pages.conductores.modales')
        @include('pages.modalError')

    </section>
@endsection