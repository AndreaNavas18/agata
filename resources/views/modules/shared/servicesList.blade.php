@component('componentes.table')
    @slot('thead')
        @if($provider)
            <th>Proveedor</th>
        @endif
        @if($customer)
            <th>Cliente</th>
        @endif
        <th>Nombre</th>
        <th>Ciudad</th>
        <th>Latitud</th>
        <th>Longitud</th>
        <th>Fecha</th>
        <th>Estado</th>
        @if ($showActions)
            <th></th>
        @endif
    @endslot
    @slot('tbody')
        @foreach($services as $service)
            <tr>
                @if($provider)
                    <td>{{ $service->provider ? $service->provider->name : '' }}</td>
                @endif
                @if($customer)
                    <td>{{ $service->customer->name }}</td>
                @endif
                <td>{{ $service->service->name }}</td>
                <td>{{ $service->city->name }}</td>
                <td>{{ $service->latitude_coordinates }}</td>
                <td>{{ $service->longitude_coordinates }}</td>
                <td>{{ $service->date_service }}</td>
                <td>
                    <span class="badge {{ ($service->state  == 'Activo') ? 'bg-success' : 'bg-danger' }}">
                        {{ $service->state}}
                    </span>
                </td>
                @if ($showActions)
                    <td>
                        @can('users_ver')
                            <a class="btn btn-info btn-sm loading mb-1"
                                @if( isset($viewShowService) && $viewShowService)
                                    href="{{route('customers.services.show.service', $service->id) }}"
                                @else
                                    href="{{route($module.'.show', $service->id) }}"
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
