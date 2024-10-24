    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-cubes"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Sis <sup>Infra</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ Request::routeIs('home') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Inventario
        </div>

        <!-- Nav Items -->
        <li class="nav-item {{ Request::routeIs('empleados.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('empleados.index') }}">
                <i class="fas fa-users"></i>
                <span>Empleados</span>
            </a>
        </li>

        <li class="nav-item {{ Request::routeIs('equipos.index') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ColpaseEquipos"
                aria-expanded="true" aria-controls="ColpaseEquipos">
                <i class="fas fa-desktop"></i>
                <span>Equipos</span>
            </a>
            <div id="ColpaseEquipos" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('equipos.index') }}">Todos los equipos</a>
                    <a class="collapse-item" href="{{ route('equipos.baja') }}">Equipos Baja</a>
                </div>
            </div>
        </li>
        <li class="nav-item {{ Request::routeIs('accesorios.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('accesorios.index') }}">
                <i class="fas fa-keyboard"></i>
                <span>Accesorios</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Asignaciones
        </div>

        <!-- Nav Items -->
        <li class="nav-item {{ Request::routeIs('asignacionesequipos.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('asignacionesequipos.index') }}">
                <i class="fas fa-laptop"></i>
                <span>Asignacion de Equipo</span>
            </a>
        </li>
        <li class="nav-item {{ Request::routeIs('asignacionaccesorios.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('asignacionaccesorios.index') }}">
                <i class="fas fa-mouse"></i>
                <span>Asignacion de Accesorios</span>
            </a>
        </li>
        <li class="nav-item {{ Request::routeIs('prestamos.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('prestamos.index') }}">
                <i class="fas fa-hand-holding"></i>
                <span>Prestamos</span>
            </a>
        </li>
        <li class="nav-item {{ Request::routeIs('salidas.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('salidas.index') }}">
                <i class="fas fa-laptop-house"></i>
                <span>Salida de equipo</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Ajustes
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-tools"></i>
                <span>Configuracion</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('acciones.index') }}">Acciones</a>
                    <a class="collapse-item" href="{{ route('empresas.index') }}">Nueva Empresas</a>
                    <a class="collapse-item" href="{{ route('tiposequipos.index') }}">Nuevo Tipo de Equipo</a>
                    <a class="collapse-item" href="{{ route('marcas.index') }}">Nueva Marca de Equipo</a>
                    <a class="collapse-item" href="{{ route('marcasaccesorios.index') }}">Nueva Marca de Accesorio</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->
