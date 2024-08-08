    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laptop-house"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Sis <sup>Sky</sup></div>
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
            <a class="nav-link" href="{{ route('equipos.index') }}">
                <i class="fas fa-laptop"></i>
                <span>Equipos</span>
            </a>
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
                <i class="fas fa-keyboard"></i>
                <span>Asignacion de Accesorios</span>
            </a>
        </li>
        <li class="nav-item {{ Request::routeIs('prestamos.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('prestamos.index') }}">
                <i class="fas fa-book"></i>
                <span>Prestamos</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Configuración
        </div>

        <!-- Nav Item -->
        <li class="nav-item {{ Request::routeIs('acciones.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('acciones.index') }}">
                <i class="fas fa-cogs"></i>
                <span>Acciones</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->
