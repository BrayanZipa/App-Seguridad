@extends('themes.lte.layout')

@section('titulo')
    Dashboard
@endsection

@section('css')
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endsection

@section('scripts')

@endsection

@section('contenido')

    <div class="content mb-n2">
        @include('pages.home.header')
    </div>

    <section class="content-header">
        <div class="row">

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $visitantes }}</h3>
                        <p>Visitantes en la empresa</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-people"></i>
                    </div>
                    @can('registrarIngreso')
                        <a href="{{ route('formCrearRegistro', ['tipoPersona' => 1]) }}" class="small-box-footer">Registrar nuevo ingreso <i class="fas fa-arrow-circle-right"></i></a>
                    @endcan
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ $colaboradoresActivo }}</h3>
                        <p>Colaboradores con activo</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-laptop"></i>
                    </div>
                    @can('registrarIngreso')
                        <a href="{{ route('formCrearRegistro', ['tipoPersona' => 3]) }}" class="small-box-footer">Registrar nuevo ingreso <i class="fas fa-arrow-circle-right"></i></a>
                    @endcan
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $conductores }}</h3>
                        <p>Conductores en la empresa</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                    @can('registrarIngreso')
                        <a href="{{ route('formCrearRegistro', ['tipoPersona' => 4]) }}" class="small-box-footer">Registrar nuevo ingreso <i class="fas fa-arrow-circle-right"></i></a>
                    @endcan
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-orange">
                    <div class="inner">
                        <h3>{{ $vehiculos }}</h3>
                        <p>Vehículos en la empresa</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-model-s"></i>
                    </div>
                    @can('registrarIngreso')
                        <a href="{{ route('formCrearRegistro') }}" class="small-box-footer">Registrar nuevo ingreso  <i class="fas fa-arrow-circle-right"></i></a>
                    @endcan
                </div>
            </div>
            
        </div>
    </section>
    
@endsection