<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{asset('assets/lte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Control de seguridad</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('assets/lte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block text-wrap">{{auth()->user()->name}}</a>
            </div>
        </div>
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">      
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-block btn-info">
                    <i class="nav-icon fa fa-power-off"></i>
                    Logout                 
                </button>
            </form>     
        </div>
        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
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
                    <a href="{{ route('mostrarRegistros') }}" class="nav-link {{ Request::is('registros*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-calendar-days"></i>
                        <p>
                            Registros
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
