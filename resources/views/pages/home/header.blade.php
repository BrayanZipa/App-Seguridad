<nav class="navbar navbar-expand navbar-black navbar-dark m-0">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        @hasanyrole('Admin|Seguridad')
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Ciudad</a>
                <ul aria-labelledby="dropdownSubMenu" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
                    <li><a href="#" id="bogota" class="dropdown-item">Bogotá</a></li>
                    <li><a href="#" id="cartagena" class="dropdown-item">Cartagena</a></li>
                    <li><a href="#" id="buenaventura" class="dropdown-item">Buenaventura</a></li>
                </ul>
            </li>
        @endhasanyrole
</nav>