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
    <!-- JavaScript propio -->
    <script src="{{ asset('js/colaboradores/colaboradoresCrear.js') }}"></script>
@endsection

@section('contenido')
    <div class="content mb-n2">
        @include('pages.colaboradores.header')
    </div>

    <section class="content-header">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-dark card-tabs mt-n1 mb-n2">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a id="colaboradorConActivo" class="nav-link {{ old('casoIngreso2') == '' ? 'active' : '' }}" data-toggle="pill" href="#nuevo_colaboradorConActivo"
                                            role="tab" aria-controls="nuevo_colaboradorConActivo" aria-selected="true">Nuevo colaborador con activo</a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="colaboradorSinActivo" class="nav-link {{ old('casoIngreso2')  != '' ? 'active' : '' }}" data-toggle="pill"
                                            href="#nuevo_colaboradorSinActivo" role="tab" aria-controls="nuevo_colaboradorSinActivo"
                                            aria-selected="false">Nuevo colaborador sin activo</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content p-0" id="custom-tabs-one-tabContent" >
                                    <div class="tab-pane fade {{ old('casoIngreso2') == '' ? 'show active' : '' }} mb-n4" id="nuevo_colaboradorConActivo" role="tabpanel" aria-labelledby="nuevo_colaboradorConActivo-tab">
                                            
                                        <form id="formularioColaborador" action="{{ route('crearColaborador') }}" method="POST" novalidate>
                                            @csrf
                                            <div class="mt-n3 mx-n3">
                                                @include('pages.colaboradores.formularioCrear')
                                            </div>
                                        
                                            <div id="crearVehiculo" class="mt-n2 mx-n3" style="display: none">
                                                @include('pages.colaboradores.formularioCrearVehiculo')
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade {{ old('casoIngreso2') != ''  ? 'show active' : '' }}" id="nuevo_colaboradorSinActivo" role="tabpanel" aria-labelledby="nuevo_colaboradorSinActivo-tab">

                                        <form id="formularioColaborador2" action="{{ route('crearColaborador') }}" method="POST" novalidate>
                                            @csrf
                                            <div class="mt-n3 mx-n3">
                                                @include('pages.colaboradores.formularioCrear2')
                                            </div>

                                            <div id="crearVehiculo2" class="mt-4 mx-n3" style="display: none">
                                                    @include('pages.colaboradores.formularioCrearVehiculo2')
                                            </div> 
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>       
            </div>
        </div>

        @include('pages.colaboradores.modales')
        @include('pages.modalError')

    </section>
@endsection