<nav class="navbar navbar-expand navbar-black navbar-dark m-0">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('mostrarRegistros') }}" class="nav-link {{ Route::is('mostrarRegistros') ? 'active' : '' }}">Registros sin salida</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('mostrarRegistros') }}" class="nav-link {{ Route::is('mostrarRegistros') ? '' : '' }}">Registros completados</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('formCrearRegistro') }}" class="nav-link {{ Route::is('formCrearRegistro') ? 'active' : '' }}">Nuevo registro</a>
        </li>
    </ul>
</nav>
