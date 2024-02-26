<ul class="side-menu toggle-menu">
    <li>
        <a class="side-menu__item loading" href="{{  route('home') }}">
            <i class="side-menu__icon typcn typcn-device-desktop"></i>
            <span class="side-menu__label">Dashboard</span>
        </a>
    </li>

    <li class="slide">
        <a class="side-menu__item"  data-toggle="slide" href="#">
            <i class="side-menu__icon fas fa-clipboard-check"></i>
            <span class="side-menu__label">
                Control acceso
            </span>
            <i class="angle fa fa-angle-right"></i>
        </a>
        <ul class="slide-menu">
            <li><a class="slide-item loading"  href="{{ route('permissions.index') }}"><span>Permisos</span></a></li>
            <li><a class="slide-item loading" href="{{ route('roles.index') }}"><span>Roles</span></a></li>
            <li><a class="slide-item loading" href="{{ route('submodules.index') }}"><span>Submodulos</span></a></li>
            <li><a class="slide-item loading" href="{{ route('users.index') }}"><span>Usuarios</span></a></li>
        </ul>
    </li>

    <li class="slide">
        <a class="side-menu__item"  data-toggle="slide" href="#">
            <i class="side-menu__icon fas fa-cog"></i>
            <span class="side-menu__label">
                Parametros
            </span>
            <i class="angle fa fa-angle-right"></i>
        </a>
        <ul class="slide-menu">
            <li><a class="slide-item loading"  href="{{  route('params.employees') }}"><span>Empleados</span></a></li>
            <li><a class="slide-item loading" href="{{  route('params.general') }}"><span>General</span></a></li>
        </ul>
    </li>

    <li>
        <a class="side-menu__item loading" href="{{ route('customers.index') }}">
            <i class="side-menu__icon fas fa-user-friends"></i>
            <span class="side-menu__label"> Clientes </span>
        </a>
    </li>

    <li>
        <a class="side-menu__item loading" href="{{ route('employees.index') }}">
            <i class="side-menu__icon  fas fa-user-tie"></i>
            <span class="side-menu__label"> Empleados</span>
        </a>
    </li>

    <li>
        <a class="side-menu__item loading" href="{{ route('providers.index') }}">
            <i class="side-menu__icon fas fa-broadcast-tower"></i>
            <span class="side-menu__label"> Proveedores</span>
        </a>
    </li>

    <li>
        <a class="side-menu__item loading" href="{{ route('providers.index') }}">
            <i class="side-menu__icon fas fa-network-wired"></i>
            <span class="side-menu__label"> Proyectos</span>
        </a>
    </li>

    <li>
        <a class="side-menu__item loading" href="{{ route('customers.services.index.all') }}">
            <i class="side-menu__icon fas fa-list-alt"></i>
            <span class="side-menu__label"> Servicios</span>
        </a>
    </li>

    <li>
        <a class="side-menu__item loading" href="{{ route('tickets.index') }}">
            <i class="side-menu__icon fas fa-ticket-alt"></i>
            <span class="side-menu__label">Tickets</span>
        </a>
    </li>
   

</ul>



