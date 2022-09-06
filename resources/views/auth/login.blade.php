@extends('layouts.app')

@section('content')
    {{-- <div class="login-box p-0" style="margin-top: -100px">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <div class="mb-4">
                    <img src="{{ asset('assets/imagenes/aviomar.png') }}" height="62px" alt="">
                    <img class="ml-4" src="{{ asset('assets/imagenes/snider.png') }}" height="62px" alt="">
                    <img class="ml-4" src="{{ asset('assets/imagenes/colvan.png') }}" height="62px" alt="">
                </div>
                <h2><b>VISIÓN</b></h2>
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
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="text-center form-image">
                    <img  src="{{ asset('assets/imagenes/logo.png') }}" id="imagen" alt="Logo Visión">
                </div>
                <div class="form-login">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="form-group text-white mt-n4">
                            <h5 class="text-center"><p>Ingresa para iniciar sesión</p></h5>
                        </div>
                        <div class="input-group">
                            <label for="username" class="col-md-12 col-form-label text-white">{{ __('Correo empresarial') }}</label>
                            <input id="username" type="text" class="inputLogin form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @error('username')
                                <span class="invalid-feedback mensaje-error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group pt-5 mt-n2">
                            <label for="password" class="col-md-12 col-form-label text-white">{{ __('Contraseña') }}</label>
                            <input id="password" type="password" class="inputLogin form-control  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="invalid-feedback mensaje-error" role="alert">
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
                            <div class="col-5">
                                <div class="form-group text-white mt-5 pt-3">
                                    <button type="submit" class="btn btn-primary btn-block ingresar">Ingresar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var inputs = document.querySelectorAll('.inputLogin');
        inputs.forEach( function(input) {
            input.addEventListener('keydown', function() {
                if (input.classList.contains('is-invalid')){ 
                    input.classList.remove('is-invalid');
                }
            });
        });
    </script>
@endsection