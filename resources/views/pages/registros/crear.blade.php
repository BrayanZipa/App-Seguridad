@extends('themes.lte.layout')

@section('titulo')
    Registros
@endsection

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('scripts')
@endsection

@section('contenido')

    <div class="row justify-content-center">
        <div class="col-sm-6">
            <form action="simple-results.html">

                <div class="form-group">
                    <div class="input-group">
                        <input type="search" class="form-control" placeholder="Buscar persona">
                        <div class="input-group-append">
                            <button  class="btn  btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

                
            </form>
        </div>
    </div>

@endsection