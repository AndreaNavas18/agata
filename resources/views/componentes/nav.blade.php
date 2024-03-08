<nav class="navbar navbar-light navbar-expand-lg topnav-menu">
    <div class="collapse navbar-collapse" id="topnav-menu-content">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link dropdown-toggle arrow-none" href="{{  route('home') }}" id="topnav-dashboard" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-home-circle icon"></i>
                    <span data-key="t-dashboard">Inicio</span>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                    <i class="bx bx-customize icon"></i>
                    <span data-key="t-apps">Administración</span> <div class="arrow-down"></div>
                </a>
                <div class="dropdown-menu" aria-labelledby="topnav-pages">
                    <div class="dropdown">
                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-ecommerce"
                            role="button">
                            <span data-key="t-ecommerce">Parametros</span> <div class="arrow-down"></div>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="topnav-ecommerce">
                            <a href="{{  route('params.employees') }}" class="dropdown-item" data-key="t-products">Empleados</a>
                            <a href="{{  route('params.general') }}" class="dropdown-item" data-key="t-products">General</a>

                            {{-- <a href="{{  route('params.general') }}" class="dropdown-item" data-key="t-products">General</a> --}}

                            <div class="dropdown-divider"></div>
                            <h6 class="dropdown-header">Control de Acceso</h6>

                            @can('permissions.index')
                                <a class="dropdown-item loading" href="{{ route('permissions.index') }}">Permisos</a>
                            @endcan
                            @can('roles_ver')
                                <a class="dropdown-item loading" href="{{ route('roles.index') }}">Roles</a>
                            @endcan
                            @can('submodules_ver')
                                <a class="dropdown-item loading" href="{{ route('submodules.index') }}">Submodulos</a>
                            @endcan
                            @can('users_ver')
                                <a class="dropdown-item loading" href="{{ route('users.index') }}">Usuarios</a>
                            @endcan
                        </div>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link dropdown-toggle arrow-none loading"
                    href="{{ route('customers.index') }}"
                    id="topnav-dashboard"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false">
                    <i class="bx bx-command icon"></i>
                    <span data-key="t-dashboard">Clientes</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link dropdown-toggle arrow-none loading"
                    href="{{ route('employees.index') }}"
                    id="topnav-dashboard"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false">
                    <i class="bx bx-wallet icon"></i>
                    <span data-key="t-dashboard">Empleados</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link dropdown-toggle arrow-none loading"
                    href="{{ route('providers.index') }}"
                    id="topnav-dashboard"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false">
                    <i class="bx bx-command icon"></i>
                    <span data-key="t-dashboard">Proveedores</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link dropdown-toggle arrow-none loading"
                    href="{{ route('tickets.index') }}"
                    id="topnav-dashboard"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false">
                    <i class="bx bx-ball icon"></i>
                    <span data-key="t-dashboard">Tickets</span>
                </a>
            </li>

        </ul>
    </div>
</nav>
