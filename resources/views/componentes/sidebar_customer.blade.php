<ul class="side-menu toggle-menu">
    <li>
        <a class="side-menu__item loading" href="{{  route('customer.home') }}">
            <i class="side-menu__icon typcn typcn-device-desktop"></i>
            <span class="side-menu__label">Inicio</span>
        </a>
    </li>
    @if(Auth()->check() && Auth()->user()->role_id == 3)

    <li class="slide">
        <a class="side-menu__item"  data-toggle="slide" href="#">
            <i class="side-menu__icon fas fa-clipboard-check"></i>
            <span class="side-menu__label">
                Control acceso
            </span>
            <i class="angle fa fa-angle-right"></i>
        </a>
        <ul class="slide-menu">
            <li><a class="slide-item loading" href="{{ route('users.index') }}"><span>Usuarios</span></a></li>
        </ul>
    </li>
    @endif

    <li>
        <a class="side-menu__item loading" href="{{ route('customers.proyectos.index.all') }}">
            <i class="side-menu__icon fas fa-list-alt"></i>
            <span class="side-menu__label"> Proyectos</span>
        </a>
    </li>
    {{-- karen --}}

    <li>
        <a class="side-menu__item loading" href="{{ route('tickets.index') }}">
            <i class="side-menu__icon fas fa-ticket-alt"></i>
            <span class="side-menu__label">Tickets</span>
        </a>
    </li>
</ul>



