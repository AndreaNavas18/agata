@component('componentes.table')
    @slot('thead')
        <th>Stratecsa ID</th>
        <th>OTP</th>
        <th>ID Servicio Cliente</th>
        <th>Proyecto - Contrato - Subcliente</th>
        <th>Descripción</th>
    @if(Auth()->user()->role_id!=2)
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
    @if(Auth()->user()->role_id!=2)
        <th>Estado</th>
    @endif
        @if ($showActions)
        @if(Auth()->user()->role_id!=2)
            <th></th>
        @else
            <th>Crear ticket</th>
        @endif
    @endif
    @endslot
    @slot('tbody')
        @foreach($services as $service)
            <tr>
                <td>{{ $service->stratecsa_id }}</td>
                <td>{{ $service->otp }}</td>
                <td>{{ $service->id_serviciocliente }}</td>
                <td>{{ $service->proyecto ? $service->proyecto->name : ''}}</td>
                <td>{{ $service->description }}</td>
                @if(Auth()->user()->role_id!=2)
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
                @if(Auth()->user()->role_id!=2)
                <td>
                    <span class="badge {{ ($service->state  == 'Activo') ? 'bg-success' : 'bg-danger' }}">
                        {{ $service->state}}
                    </span>
                </td>
                @endif
                @if ($showActions)
                    <td>
                        @if(Auth()->user()->role_id!=2)
                                @can('users_ver')
                                    <a class="btn btn-info btn-sm loading mb-1"
                                        @if( isset($viewShowService) && $viewShowService)
                                            href="{{route('customers.services.show.service', $service->id) }}"
                                        @else
                                        href="{{route('customers.services.show.service', $service->id) }}"

                                            {{-- href="{{route($module.'.show', $service->id) }}" --}}
                                        @endif
                                        bs-bs-toggle="tooltip"
                                        bs-bs-placement="top"
                                        title="Ver">
                                        <i class="far fa-eye"></i>
                                    </a>
                                @endcan
                                    
                                    <button class="btn btn-success btn-sm editService mb-1"
                                        bs-toggle="tooltip"
                                        bs-placement="top"
                                        title="Editar"
                                        dataUrl="{{ route($module.'.services.update',$service->id) }}"
                                        dataService="{{ $service }}">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    @can('users_eliminar')
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
                                    @php
                                        echo $service->id;
                                    @endphp
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


