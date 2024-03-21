@component('componentes.table')
    @slot('thead')
        <th>Stratecsa ID</th>
        <th>OTP</th>
        <th>ID Servicio Cliente</th>
        <th>Proyecto - Contrato - Subcliente</th>
        <th>Descripción</th>
    @if (!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
        @if($provider)
            <th>Proveedor</th>
        @endif
        @if($customer)
            <th>Cliente</th>
        @endif
    @endif
        <th>Tipo de servicio</th>
        <th>Ciudad</th>
        <th>Fecha</th>
    @if(!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
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
                    
                    {{ $service->description }}
                </a>
                
                </td>
                @if (!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
                    @if($provider)
                        <td>{{ $service->provider ? $service->provider->name : '' }}</td>
                    @endif
                    @if($customer)
                        <td>{{ $service->customer->name }}</td>
                    @endif
                @endif
                <td>{{ $service->service->name }}</td>
                <td>{{ $service->city->name }}</td>
                <td>{{ $service->date_service }}</td>
                @if (!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
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
                                            action="{{ route($module.'.services.destroy', $service->id) }}"
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


