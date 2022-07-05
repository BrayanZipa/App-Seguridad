@extends('themes.lte.layout')

@section('titulo')
    Registros
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
    <script src="{{ asset('js/registros/registrosCrear.js') }}"></script>
@endsection

@section('contenido')
    <div class="content mb-n2">
        @include('pages.registros.header')
    </div>

    <section class="content-header mb-n4">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Crear nuevo registro</h3>
                        <div class="card-tools">
                            <button id="botonComprimirVisitante" type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body mb-n4 mt-n1" >
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="selectTipoPersona">Seleccione el tipo de persona</label>
                                        <select id="selectTipoPersona" class="select2bs4 form-control" style="width: 100%;">
                                            <option selected="selected" value="" disabled>Tipo de persona</option>
                                            @foreach ($tipoPersonas as $tipo)
                                                <option value="{{ $tipo->id_tipo_personas }}" {{ $tipo->id_tipo_personas == old('tipoPersona') ? 'selected' : '' }}>{{ $tipo->tipo }}</option>
                                            @endforeach
                                        </select>  
                                </div>
                            </div>
                            <div id="buscarPersona" class="col-sm-6" style="display: none">
                                <input id="idPersona" type="hidden" value="">
                                <div class="form-group">
                                    <label for="selectPersona">Seleccione a la persona</label>
                                    <select id="selectPersona" class="select2bs4 form-control" style="width: 100%;" name="id_persona">
                                        <option selected="selected" value="" disabled></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="formVisitanteConductor" style="display: none">
                    @include('pages.registros.formularioVisitanteConductor')
                </div>

                <div id="formColaboradorSinActivo" style="display: none">
                    @include('pages.registros.formularioColaboradorSinActivo')
                </div>

                <div id="formColaboradorConActivo" style="display: none">
                    @include('pages.registros.formularioColaboradorConActivo')
                </div>
                
            </div>
        </div>

        @include('pages.registros.modales')
        @include('pages.modalError')

    </section>
@endsection