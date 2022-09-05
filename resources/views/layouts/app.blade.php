<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Visión - Control de seguridad') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/imagenes/icono.png') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free-6.1.1-web/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/lte/dist/css/adminlte.min.css') }}">
    <!-- Estilos del Login -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
</head>
<body>
    {{-- <div id="app"> --}}
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-md">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Control de seguridad') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        
                    </ul>    
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
                <div>
                    <img class="ml-3" src="../assets/imagenes/aviomar.png" height="62px" alt="">
                    <img class="ml-3" src="../assets/imagenes/snider.png" height="62px" alt="">
                    <img class="ml-3" src="../assets/imagenes/colvan.png" height="62px" alt="">
                </div>
            </div>
        </nav> --}}
        
        {{-- <main class="py-4 hold-transition login-page">
            @yield('content')
        </main> --}}

        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-lg-6 col-md-8 col-sm-10">
                    <div class="text-center form-image">
                        <img  src="{{ asset('assets/imagenes/logo.png') }}" width="150px" alt="Logo Visión">
                    </div>
                    <div class="form-login">
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="form-group text-white mt-n4">
                                <h5 class="text-center"><p>Ingresa para iniciar sesión</p></h5>
                            </div>
                            <div class="input-group">
                                <label for="username" class="col-md-12 col-form-label text-white">{{ __('Correo empresarial') }}</label>
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
                            <div class="input-group pt-5 mt-n2">
                                <label for="password" class="col-md-12 col-form-label text-white">{{ __('Contraseña') }}</label>
                                <input id="password" type="password" class="form-control  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
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
                                <div class="col-5">
                                    <div class="form-group text-white mt-5 pt-3">
                                        <button type="submit" class="btn btn-primary btn-block ingresar">Ingresar</button>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    {{-- </div> --}}
</body>
</html>
