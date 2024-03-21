@component('componentes.table')
    @slot('thead')
        <th>Proyecto - Contrato - Subcliente</th>
        @if(!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
        <th>Cliente</th>
        @endif
        <th>Descripción</th>
        <th>Estado</th>
        @if ($showActions)
            @if(!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
                <th></th>
            @else
                <th>Crear ticket</th>
            @endif
        @endif
    @endslot
    @slot('tbody')
        @foreach($proyectos as $proyecto)
        @if($proyecto->customerServices->count() > 0)
            @foreach ($proyecto->customerServices as $customerService)
                <tr>
                    <td>{{ $proyecto->name }}</td>
                    @if(!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
                    <td>{{ $proyecto->customer ? $proyecto->customer->name : '' }}</td>
                    @endif
                    <td>{{ $proyecto->description }}</td>
                    <td>
                        <span class="badge {{ $proyecto->state == 'Activo' ? 'bg-danger' : 'bg-success' }}">
                            {{ $customerService->state }}
                        </span>
                    </td>
                        @if ($showActions)
                            <td>
                                @if(!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
                                        <a class="btn btn-info btn-sm loading mb-1"
                                            href="{{route('customers.proyectos.show.proyecto', $proyecto->id) }}"
                                            bs-bs-toggle="tooltip"
                                            bs-bs-placement="top"
                                            title="Ver">
                                            <i class="far fa-eye"></i>
                                        </a>
                                        
                                        <button class="btn btn-success btn-sm editProyect mb-1"
                                            bs-toggle="tooltip"
                                            bs-placement="top"
                                            title="Editar"
                                            dataUrl="{{ route('customers.proyectos.update',$proyecto->id) }}"
                                            dataproyectoCustomer="{{ $proyecto }}">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        @can('proyectos.destroy')
                                            <form class="d-inline frmDestroy mb-1"
                                                action="{{ route($module.'.proyectos.destroy', $proyecto->id) }}"
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

                                        
                                        <button class="btn btn-purple btn-sm obtenerServicios mb-1"
                                            bs-toggle="tooltip"
                                            bs-placement="top"
                                            title="Asignar Servicios"
                                            data-proyecto-name="{{ $proyecto->name }}"
                                            data-proyecto-id="{{ $proyecto->id }}"
                                            data-customer-id="{{ $proyecto->customer_id }}">
                                            <i class="fas fa-light fa-handshake"></i>
                                        </button>

                                    {{-- <a class="btn btn-success btn-sm loading mb-1 createforproyecto"
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
                                    </a> --}}
                                @endif

                            </td>
                        @endif
                </tr>
            @endforeach
            @else 
                <tr>
                    <td>{{ $proyecto->name }}</td>
                    @if(!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
                    <td>{{ $proyecto->customer ? $proyecto->customer->name : '' }}</td>
                    @endif
                    <td> {{ $proyecto->description }}</td>
                    <td></td>
                    @if ($showActions)
                            <td>
                                @if(!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
                                    @can('proyectos.index')
                                        <a class="btn btn-info btn-sm loading mb-1"
                                            href="{{route('customers.proyectos.show.proyecto', $proyecto->id) }}"
                                            bs-bs-toggle="tooltip"
                                            bs-bs-placement="top"
                                            title="Ver">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    @endcan
                                        
                                        <button class="btn btn-success btn-sm editProyect mb-1"
                                            bs-toggle="tooltip"
                                            bs-placement="top"
                                            title="Editar"
                                            dataUrl="{{ route('customers.proyectos.update',$proyecto->id) }}"
                                            dataproyectoCustomer="{{ $proyecto }}">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        @can('proyectos.destroy')
                                            <form class="d-inline frmDestroy mb-1"
                                                action="{{ route($module.'.proyectos.destroy', $proyecto->id) }}"
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

                                        <button class="btn btn-purple btn-sm obtenerServicios mb-1"
                                            bs-toggle="tooltip"
                                            bs-placement="top"
                                            title="Asignar Servicios"
                                            data-proyecto-name="{{ $proyecto->name }}"
                                            data-proyecto-id="{{ $proyecto->id }}"
                                            data-customer-id="{{ $proyecto->customer_id }}">
                                            <i class="fas fa-light fa-handshake"></i>
                                        </button>


                                    {{-- <a class="btn btn-success btn-sm loading mb-1 createforproyecto"
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
                                    </a> --}}
                                @endif

                            </td>
                        @endif

                </tr>
            @endif
            @endforeach
            @endslot
            
    @if(!isset($data))
        {{ $proyectos->links() }}
    @else
        {{ $proyectos->appends($data)->links() }}
    @endif
@endcomponent


