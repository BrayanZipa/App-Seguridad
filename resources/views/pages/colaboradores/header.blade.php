<nav class="navbar navbar-expand navbar-black navbar-dark m-0">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('mostrarColaboradores')}}" class="nav-link {{ Route::is('mostrarColaboradores') ? 'active' : '' }}">Colaboradores sin activo</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('formCrearColaborador')}}" class="nav-link {{ Route::is('formCrearColaborador') ? 'active' : '' }}">Nuevo colaborador</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('computadores')}}" class="nav-link {{ Route::is('computadores') ? 'active' : '' }}">Nuevo colaborador por activo</a>
        </li>
    </ul>
</nav>