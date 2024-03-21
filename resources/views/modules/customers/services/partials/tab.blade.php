<div class="tabs-menu d-flex justify-content-between align-items-center">
    <!-- Tabs -->
        <ul class="nav panel-tabs">
            <li>
                    <a class="nav-link info
                        {{ (Session::get('tab') == 'service' ? 'active' : '') }}
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
                        {{ (Session::get('tab') == 'config' ? 'active' : '') }}
                        loading"
                        href="{{ $urlConfig }}">
                        <span class="d-block">
                            <i class="fab fa-sellsy text-white"></i>&nbsp;
                            Configuración
                        </span>
                    </a>
                </li>
        </ul>

        @if( Session::get('tab') == 'service' )
            <!-- Boton de editar el servicio -->
            <div>
                <a class="btn btn-success btn-sm mb-1 loading"
                    href="{{ route('customers.services.edit', $service->id) }}"
                    bd-toggle="tooltip"
                    bd-placement="top"
                    title="Editar Servicio">
                    <i class="fas fa-edit"> Editar</i>
                </a>
            </div>
        @elseif (Session::get('tab') == 'config')
            <!-- Boton de editar la configuración-->
            <div>
                <a class="btn btn-success btn-sm mb-1 loading"
                    href="{{ route('customers.services.editConfig', $service->id) }}"
                    bd-toggle="tooltip"
                    bd-placement="top"
                    title="Editar Configuración">
                    <i class="fas fa-edit"> Editar</i>
                </a>
            </div>
        @endif
    </div>


