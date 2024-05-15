<ul class="side-menu toggle-menu">
    <li>
        <a class="side-menu__item loading" href="{{  route('home') }}">
            <i class="side-menu__icon typcn typcn-device-desktop"></i>
            <span class="side-menu__label">Dashboard</span>
        </a>
    </li>
    <li>
        <a class="side-menu__item loading" href="{{  route('pqrs.index') }}">
            <i class="side-menu__icon fa-regular fa-comments"></i>
            <span class="side-menu__label">Pqrs</span>
        </a>
    </li>
    
    @if(auth()->user()->can('roles.index') || auth()->user()->can('submodules.index') || auth()->user()->can('users.index') )
        <li class="slide">
            <a class="side-menu__item"  data-toggle="slide" href="#">
                <i class="side-menu__icon fas fa-clipboard-check"></i>
                <span class="side-menu__label">
                    Control acceso
                </span>
                <i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                @can('permissions.index')
                <li><a class="slide-item loading"  href="{{ route('permissions.index') }}"><span>Permisos</span></a></li>
                @endcan
                @can('roles.index')
                <li><a class="slide-item loading" href="{{ route('roles.index') }}"><span>Roles</span></a></li>
                @endcan
                @can('submodules.index')
                <li><a class="slide-item loading" href="{{ route('submodules.index') }}"><span>Submodulos</span></a></li>
                @endcan
                @can('users.index')
                <li><a class="slide-item loading" href="{{ route('users.index') }}"><span>Usuarios</span></a></li>
                @endcan
            </ul>
        </li>
    @endif
    @if(auth()->user()->can('commercial.show'))
    <li class="slide">
       <a class="side-menu__item"  data-toggle="slide" href="#">
           <i class="side-menu__icon fas fa-clipboard-check"></i>
           <span class="side-menu__label">
               Comercial
           </span>
           <i class="angle fa fa-angle-right"></i>
       </a>
       <ul class="slide-menu">
           {{-- @can('permissions.index') --}}
           <li><a class="slide-item loading"  href="{{ route('tariff.index') }}"><span>Tarifario</span></a></li>
           {{-- @endcan --}}
       </ul>
    </li>
    @endif

    @if(auth()->user()->can('tickets.index'))
   
    <li>
        <a class="side-menu__item loading" href="{{ route('tickets.index') }}">
            <i class="side-menu__icon fas fa-ticket-alt"></i>
            <span class="side-menu__label">Tickets</span>
        </a>
    </li>
   @endif

   @if(auth()->user()->can('services.index'))
        <li>
            <a class="side-menu__item loading" href="{{ route('customers.services.index.all') }}">
                <i class="side-menu__icon fas fa-list-alt"></i>
                <span class="side-menu__label"> Servicios</span>
            </a>
        </li>
    @endif

    @if(auth()->user()->can('customers.index'))
    <li>
        <a class="side-menu__item loading" href="{{ route('customers.index') }}">
            <i class="side-menu__icon fas fa-user-friends"></i>
            <span class="side-menu__label"> Clientes </span>
        </a>
    </li>
    @endif
    
    @if(auth()->user()->can('providers.index'))
        <li>
            <a class="side-menu__item loading" href="{{ route('providers.index') }}">
                <i class="side-menu__icon fas fa-broadcast-tower"></i>
                <span class="side-menu__label"> Proveedores</span>
            </a>
        </li>
    @endif

    {{-- @if(auth()->user()->can('parametros.empleados.index') || auth()->user()->can('parametros.general.index')) --}}
    @if (in_array(Auth()->user()->role_id, [1, 2, 3, 6, 7, 8, 9, 11]))
        <li class="slide">
            <a class="side-menu__item"  data-toggle="slide" href="#">
                <i class="side-menu__icon fas fa-cog"></i>
                <span class="side-menu__label">
                    Parametros
                </span>
                <i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                @can('parametros.empleados.index')
                <li><a class="slide-item loading"  href="{{  route('params.employees') }}"><span>Empleados</span></a></li>
                @endcan
                @can('parametros.empleados.index')
                <li><a class="slide-item loading" href="{{  route('params.general') }}"><span>General</span></a></li>
                @endcan
            </ul>
        </li>
    @endif

    @if (in_array(Auth()->user()->role_id, [5, 10, 9]))
    {{-- @if(auth()->user()->can('parametros.general.soporte')) --}}
        <li class="slide">
            <a class="side-menu__item"  data-toggle="slide" href="#">
                <i class="side-menu__icon fa-brands fa-slack"></i>
                <span class="side-menu__label">
                    Parametros
                </span>
                <i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a class="slide-item loading" href="{{  route('params.general') }}"><span>General</span></a></li>
            </ul>
        </li>
    @endif
    
    @if(auth()->user()->can('employees.index'))    
        <li>
            <a class="side-menu__item loading" href="{{ route('employees.index') }}">
                <i class="side-menu__icon  fas fa-user-tie"></i>
                <span class="side-menu__label"> Empleados</span>
            </a>
        </li>
    @endif

    @if(auth()->user()->can('proyectos.index') || auth()->user()->can('customers.projects.index'))
        <li>
            <a class="side-menu__item loading" href="{{ route('customers.proyectos.index.all') }}">
                <i class="side-menu__icon fas fa-network-wired"></i>
                <span class="side-menu__label"> Proyectos</span>
            </a>
        </li>
    @endif
</ul>



