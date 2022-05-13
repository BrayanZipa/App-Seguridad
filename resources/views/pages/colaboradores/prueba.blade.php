@extends('themes.lte.layout')

@section('titulo')
    GLPI
@endsection

@section('css')

@endsection

@section('scripts')
@endsection

@section('contenido')

    <div class="content mb-n2">
        @include('pages.colaboradores.header')
    </div>

    <section class="content-header">
        <div class="row">
            <div class="col-md-12">
                
                <div class="card card-primary mb-n1">
                    <div class="card-header ">
                        <h3 class="card-title">Prueba GLPI</h3>
                        <div class="card-tools">
                            <button id="botonComprimirColaborador" type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">

                                <select name="glpi" id="prueba" class="colaborador form-control" style="width: 100%;" required>
                                    <option selected="selected" value="" disabled></option>
                                    @foreach ($colaboradores as $colaborador)
                                        <option value="{{ $colaborador['id'] }}"> {{ $colaborador['name'] }}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="col-6">
                                <input type="text" class="colaborador form-control" placeholder="Activo">
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>

@endsection