@extends('layouts.app')

@section('content')
{{-- <div class="row justify-content-center"> --}}
    <div class="login-box p-0" style="margin-top: -100px">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                {{-- <div class="mb-4">
                    <img src="{{ asset('assets/imagenes/aviomar.png') }}" height="62px" alt="">
                    <img class="ml-4" src="{{ asset('assets/imagenes/snider.png') }}" height="62px" alt="">
                    <img class="ml-4" src="{{ asset('assets/imagenes/colvan.png') }}" height="62px" alt="">
                </div>
                <h2><b>VISIÓN</b></h2> --}}
                <img  src="{{ asset('assets/imagenes/logo.png') }}"  alt="">

            </div>
            <div class="card-body">
                <p class="login-box-msg">Ingresa para iniciar sesión</p>

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-2">
                        <label for="username" class="col-md-12 col-form-label">{{ __('Correo empresarial') }}</label>
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-4">
                        <label for="password" class="col-md-12 col-form-label">{{ __('Contraseña') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row justify-content-center">
                        {{-- <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div> --}}
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
@endsection