<div class="tabs-menu d-flex justify-content-between align-items-center">
    <!-- Tabs -->
    <ul class="nav panel-tabs">
            <li>
                    <a class="nav-link info
                        {{ (Session::get('tab') == 'info' ? 'active' : '') }}
                        loading"
                        href="{{ $urlnfo }}">
                        <span class="d-block">
                            <i class="fas fa-info-circle text-white"></i>&nbsp;
                            Datos
                        </span>
                    </a>
                </li>
                <li>
                <a class="nav-link info
                    {{ (Session::get('tab') == 'users' ? 'active' : '') }}
                    loading"
                    href="{{ $urlUsers }}">
                    <span class="d-block">
                        <i class="fas fa-users text-white"></i>&nbsp;
                        Usuarios
                    </span>
                </a>
            </li>
            <li>
                <a class="nav-link services
                    {{ (Session::get('tab') == 'servicesShow' ? 'active' : '') }}
                    loading"
                    href="{{ $urlServices }}">
                    <span class="d-block">
                        <i class="fab fa-sellsy text-white"></i>&nbsp;
                        Servicios
                    </span>
                </a>
            </li>
            <li>
                <a class="nav-link proyectos
                    {{ (Session::get('tab') == 'proyectos' ? 'active' : '') }}
                    loading"
                    href="{{ $urlProyectos }}">
                    <span class="d-block">
                        <i class="fab fa-sellsy text-white"></i>&nbsp;
                        Proyectos
                    </span>
                </a>
            </li>
            <li>
                <a class="nav-link tickets
                    {{ (Session::get('tab') == 'tickets' ? 'active' : '') }}
                    loading"
                    href="{{ $urlTickets }}">
                    <span class="d-block">
                        <i class="fas fa-ticket-alt text-white"></i>&nbsp;
                        Tickets
                    </span>
                </a>
            </li>
    </ul>
@can('customers.edit')
        @if( Session::get('tab') == 'info' )
            <!-- Boton de editar la información -->
            <div>
                <a class="btn btn-success btn-sm mb-1 loading"
                    href="{{ route('customers.edit', $customer->id) }}"
                    bd-toggle="tooltip"
                    bd-placement="top"
                    title="Editar información">
                    <i class="fas fa-edit"> Editar</i>
                </a>
            </div>
        @elseif (Session::get('tab') == 'users')
            <!-- Boton de editar el usuario -->
            <div>
                <a class="btn btn-success btn-sm mb-1 loading"
                    href="{{ route('customers.users.index', $customer->id) }}"
                    bd-toggle="tooltip"
                    bd-placement="top"
                    title="Editar usuarios">
                    <i class="fas fa-edit"> Editar</i>
                </a>
            </div>
        @elseif (Session::get('tab') == 'servicesShow')
            <!-- Boton de editar los servicios -->
            <div>
                <a class="btn btn-success btn-sm mb-1 loading"
                    href="{{ route('customers.services.index', $customer->id) }}"
                    bd-toggle="tooltip"
                    bd-placement="top"
                    title="Editar servicios">
                    <i class="fas fa-edit"> Editar</i>
                </a>
            </div>
        @elseif (Session::get('tab') == 'proyectos')
            <!-- Boton de editar los proyectos -->
            <div>
                <a class="btn btn-success btn-sm mb-1 loading"
                    href="{{ route('customers.proyectos.index', $customer->id) }}"
                    bd-toggle="tooltip"
                    bd-placement="top"
                    title="Editar proyectos">
                    <i class="fas fa-edit"> Editar</i>
                </a>
            </div>
        @elseif (Session::get('tab') == 'tickets')
             <!-- Boton de editar los tickets -->
             <div>
                <a class="btn btn-success btn-sm mb-1 loading"
                    href="{{ route('customers.tickets.edit', $customer->id) }}"
                    bd-toggle="tooltip"
                    bd-placement="top"
                    title="Editar tickets">
                    <i class="fas fa-edit"> Editar</i>
                </a>
            </div>
        @endif
@endcan
    </div>


