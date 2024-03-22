<!-- Nav tabs -->
<div class="tabs-menu d-flex justify-content-between align-items-center">
    <!-- Tabs -->
    <ul class="nav panel-tabs">
        <li class="nav-item">
            <a class="nav-link info
                {{ (Session::get('tab') == 'info' ? 'active' : '') }}
                loading"
                href="{{ $urlnfo }}">
                <span class="d-block">
                    <i class="fas fa-info-circle text-white"></i>
                    Datos personales
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link services
                {{ (Session::get('tab') == 'services' ? 'active' : '') }}
                loading"
                href="{{ $urlServices }}">
                <span class="d-block">
                    <i class="fab fa-sellsy text-white"></i>
                    Servicios
                </span>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link tickets
                {{ (Session::get('tab') == 'tickets' ? 'active' : '') }}
                loading"
                href="{{ $urlTickets }}">
                <span class="d-block">
                    <i class="fas fa-ticket-alt text-white"></i>
                    Tickets
                </span>
            </a>
        </li> --}}
        {{-- <li class="nav-item">
            <a class="nav-link"
                data-bs-toggle="tab"
                href="#profile2"
                role="tab"
                aria-selected="false">
                <span class="d-block">
                    <i class="fas fa-paste text-white"></i>
                    Documentos
                </span>
            </a>
        </li> --}}

        
    </ul>
    @can('providers.edit')
        @if (Session::get('tab') == 'info')
            <!-- Boton de editar la info -->
            <div>
                <a class="btn btn-success btn-sm mb-1 loading"
                    href="{{ route('providers.edit', $provider->id) }}"
                    bd-toggle="tooltip"
                    bd-placement="top"
                    title="Editar info">
                    <i class="fas fa-edit"> Editar</i>
                </a>
            </div>
        @elseif (Session::get('tab') == 'services')
            <!-- Boton de editar los servicios -->
            <div>
                <a class="btn btn-success btn-sm mb-1 loading"
                    href="{{ route('providers.services.index', $provider->id) }}"
                    bd-toggle="tooltip"
                    bd-placement="top"
                    title="Editar servicios">
                    <i class="fas fa-edit"> Editar</i>
                </a>
            </div>
        @endif
    @endcan
    </div>






