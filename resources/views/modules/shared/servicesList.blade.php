@component('componentes.table')
    @slot('thead')
    @if (!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
    <th>Stratecsa ID</th>
    <th>OTP</th>
    @endif
        <th>ID Servicio Cliente</th>
        <th>Proyecto - Contrato - Subcliente</th>
        <th>Nombre</th>
        @if (!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
        <th>Descripción</th>
        @endif

    @if (!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
        @if($provider)
            <th>Proveedor</th>
        @endif
        @if($customer)
            <th>Cliente</th>
        @endif
    @endif
        <th>Tipo de servicio</th>

        @if (!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
        <th>Pais</th>
        <th>Departamento</th>
        @endif

        <th>Ciudad</th>
        <th>Fecha</th>
    @if(!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
        <th>Latitud de cordenadas</th>
        <th>Longitud de cordenadas</th>
        <th>Tipo Instalación</th>
        <th>IP</th>
        <th>vlan</th>
        <th>Mascara</th>
        <th>Gateway</th>
        <th>MAC</th>
        <th>BW_Download</th>
        <th>Bw_upload</th>
        <th>Ip_vpn</th>
        <th>Tipo vpn</th>
        <th>User vpn</th>
        <th>Password vpn</th>
        <th>User tunel</th>
        <th>Id Tunel</th>
        <th>Tecnología</th>
        <th>Equipo</th>
        <th>Modelo</th>
        <th>Serial</th>
        <th>Activo Fijo</th>
        <th>Estado</th>
    @endif
        @if ($showActions)
        @if (!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
            <th></th>
        @else
            <th>Crear ticket</th>
        @endif
    @endif
    @endslot
    @slot('tbody')
        @foreach($services as $service)
            <tr>
                @if (!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
                <td>
                    <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d" >
                        {{ $service->stratecsa_id }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">
                    {{ $service->otp }}
                    </a>
                </td>
                @endif
                <td>
                    <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">
                    
                    {{ $service->id_serviciocliente }}
                </a>
                
                </td>
                <td>
                    <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">
                    
                    {{ $service->proyecto ? $service->proyecto->name : ''}}
                </a>
                
                </td>
                <td>
                    <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">
                    
                    {{ $service->name }}
                </a>
                
                </td>
                @if (!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
                <td>
                    <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">
                    
                    {{ $service->description }}
                </a>
                
                </td>

                    @if($provider)
                    
                        <td>
                            <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">

                            {{ $service->provider ? $service->provider->name : '' }}
                        </td>
                    @endif
                    @if($customer)
                        <td>
                            <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">
                                {{ $service->customer->name }}
                            </a>
                        </td>
                    @endif
                @endif
                <td>
                    <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">
                        {{ $service->service->name }}
                    </a>
                </td>

                @if (!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
                <td>
                    <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">
                        {{ $service->country->name }}
                    </a>
                </td>

                <td>
                    <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">
                        {{ $service->department->name }}
                    </a>
                </td>
                @endif

                <td>{{ $service->city->name }}</td>


                <td>{{ $service->date_service }}</td>
                @if (!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
                <td>
                    <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">
                        {{ $service->latitude_coordinates }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">
                        {{ $service->longitude_coordinates }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">
                        {{ $service->installation_type }}
                    </a>
                </td>

                <td>
                    <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">
                        {{ $service->ip }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">
                        {{ $service->vlan }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">
                        {{ $service->mascara }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">
                        {{ $service->gateway }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">
                        {{ $service->mac }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">
                        {{ $service->BW_Download }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">
                        {{ $service->Bw_upload }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">
                        {{ $service->ip_vpn }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">
                        {{ $service->tipo_vpn }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">
                        {{ $service->user_vpn }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">
                        {{ $service->password_vpn }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">
                        {{ $service->user_tunel }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">
                        {{ $service->id_tunel }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">
                        {{ $service->tecnologia }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">
                        {{ $service->equipo }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">
                        {{ $service->modelo }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">
                        {{ $service->serial }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('customers.services.show.service', $service->id) }}" style="color: #2e384d">
                        {{ $service->activo_fijo }}
                    </a>
                </td>
                <td>
                    <span class="badge {{ ($service->state  == 'Activo') ? 'bg-danger' : 'bg-success' }}">
                        {{ $service->state}}
                    </span>
                </td>

                @endif
                @if ($showActions)
                    <td>
                        @if (!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
                                @can('services.index')
                                    {{-- <a class="btn btn-info btn-sm loading mb-1"
                                        @if( isset($viewShowService) && $viewShowService)
                                            href="{{ route('customers.services.show.service', $service->id) }}"
                                        @else
                                        href="{{ route('customers.services.show.service', $service->id) }}" --}}

                                            {{-- href="{{route($module.'.show', $service->id) }}" --}}
                                        {{-- @endif
                                        bs-bs-toggle="tooltip"
                                        bs-bs-placement="top"
                                        title="Ver">
                                        <i class="far fa-eye"></i> --}}
                                    {{-- </a> --}}
                                @endcan
                                    
                                    {{-- <button class="btn btn-success btn-sm editService mb-1"
                                        bs-toggle="tooltip"
                                        bs-placement="top"
                                        title="Editar"
                                        dataUrl="{{ route($module.'.services.update',$service->id) }}"
                                        dataService="{{ $service }}">
                                        <i class="fas fa-edit"></i>
                                    </button> --}}

                                    @can('services.destroy')
                                        <form class="d-inline frmDestroy mb-1"
                                            action="{{ route($module.'.destroy', $service->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"
                                                type="submit"
                                                bs-toggle="tooltip"
                                                bs-placement="top"
                                                title="Destroy">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    @endcan
                        @endif
                                @if(in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
                                <a class="btn btn-success btn-sm loading mb-1 createforservice"
                                    href="{{ route('tickets.create') }}"
                                    data-id="{{ $service->id }}"
                                    @if(isset($newTab) && $newTab)
                                        target="'_blank"
                                    @endif
                                    bs-toggle="tooltip"
                                    bs-placement="top"
                                    title="Crear ticket para este servicio">
                                    <i class="fas fa-regular fa-land-mine-on"></i>
                                    {{-- @php
                                        echo $service->id;
                                    @endphp --}}
                                </a>
                                @endif
                                
                    </td>
                @endif
            </tr>

        @endforeach
    @endslot

    @if(!isset($data))
        {{ $services->links() }}
    @else
        {{ $services->appends($data)->links() }}
    @endif
@endcomponent


