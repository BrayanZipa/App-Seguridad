<aside class="main-sidebar sidebar-dark-primary elevation-4 mb-5">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{asset('assets/imagenes/logo_sidebar.png')}}" alt="Logo" class="brand-image">
        <span class="brand-text font-weight-light">VISIÓN - SEGURIDAD</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image ml-2">
                {{-- <img src="{{asset('assets/lte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="Usuario"> --}}
                <i class="nav-icon fa fa-user-shield" style="color: rgba(255, 255, 255, 0.801)"></i>
            </div>
            <div class="info">
                <a href="#" class="d-block text-wrap">{{auth()->user()->name}}</a>
            </div>
        </div>
        <div class="user-panel mt-n2">  
            <nav class="mb-1">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="nav-icon fa fa-power-off" style="color: rgba(255, 0, 0, 0.795)"></i>  
                            <p class="ml-1">
                                Logout
                            </p>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
            {{-- <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-block btn-info">
                    <i class="nav-icon fa fa-power-off"></i>
                    <div id="botonOff" class="ml-1" style="display: inline">
                        Logout 
                    </div>                
                </button>
            </form>   --}}
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('mostrarVisitantes') }}" class="nav-link {{ Request::is('visitantes*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-user"></i>
                        <p>
                            Visitantes
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('mostrarColaboradores') }}" class="nav-link {{ Request::is('colaboradores*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-address-card"></i>
                        <p>
                            Colaboradores 
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('mostrarConductores') }}" class="nav-link {{ Request::is('conductores*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-truck-moving"></i>
                        <p>
                            Conductores
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('mostrarVehiculos') }}" class="nav-link {{ Request::is('vehiculos*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-car-side"></i>
                        <p>
                            Vehículos
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('mostrarRegistrosSinSalida') }}" class="nav-link {{ Request::is('registros*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-calendar-days"></i>
                        <p>
                            Registros
                        </p>
                    </a>
                </li>
                @can('mostrarUsuarios')
                    <li class="nav-item">
                        <a href="{{ route('mostrarUsuarios') }}" class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-check"></i>
                            <p>
                                Usuarios
                            </p>
                        </a>
                    </li> 
                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>