{{-- <div>
    <span class="badge bg-danger p-1">{{ $ticketsOpen }} Abiertos</span>
    <span class="badge bg-secondary p-1">{{ $ticketsClosed }} Cerrados</span>
    <span class="badge bg-danger p-1">{{ $ticketsHight }} Alta</span>
    <span class="badge bg-warning text-dark p-1">{{ $ticketsMedium }} Media</span>
    <span class="badge bg-success p-1">{{ $ticketsLow }} Baja</span>
</div> --}}

@component('componentes.table')
    @slot('thead')
        <th>Consecutivo.</th>
        <th>Titulo</th>
        <th>Fecha</th>
        @if($customer && Auth()->user()->role_id!=2)
            <th>Cliente</th>
        @endif
        <th>Servicio</th>
        @if($provider && Auth()->user()->role_id!=2)
            <th> Proveedor</th>
            <th>Asignado</th>
            <th>Prioridad</th>
        @endif
        <th>Estado</th>
        @if($showActions)
            <th></th>
        @endif
    @endslot
    @slot('tbody')
    
        @foreach($tickets as $ticket)
            <tr>
                <td>{{ $ticket->consecutive }}</td>

                <td>{{ $ticket->ticket_issue }}</td>

                <td>{{ $ticket->date }}</td>

                @if($customer && Auth()->user()->role_id!=2)
                    <td>{{ $ticket->customer ? $ticket->customer->name : '' }}</td>
                @endif

                <td>{{ $ticket->service->description }}</td>

                @if($provider && Auth()->user()->role_id!=2)
                    <td>{{ $ticket->service->provider ? $ticket->service->provider->name : '---' }}</td>
                    <td>{{  $ticket->employee ? $ticket->employee->short_name : 'No hay agente asignado' }}</td>
                    <td>
                        <span class="badge {{ $ticket->priority->color}}">
                            {{ $ticket->priority->name}}
                        </span>
                    </td>
                @endif

                <td>
                    <span class="badge {{ ($ticket->state  == 'Abierto') ? 'bg-danger' : 'bg-success' }}">
                        {{ $ticket->state}}
                    </span>
                </td>

                @if($showActions)
                    <td>
                        @can('tickets_ver')
                        @if(Auth()->user()->role_id!=2)

                                <a class="btn btn-info btn-sm loading mb-1"
                                    href="{{ route('tickets.show', $ticket->id) }}"
                                    @if(isset($newTab) && $newTab)
                                        target="'_blank"
                                    @endif
                                    bs-bs-toggle="tooltip"
                                    bs-bs-placement="top"
                                    title="Ver">
                                    <i class="far fa-eye"></i>
                                </a>
                                @else
                                <a class="btn btn-info btn-sm loading mb-1"
                                    href="{{ route('tickets.manage', $ticket->id) }}"
                                    @if(isset($newTab) && $newTab)
                                        target="'_blank"
                                    @endif
                                    bs-bs-toggle="tooltip"
                                    bs-bs-placement="top"
                                    title="Ver">
                                    <i class="far fa-eye"></i>
                                </a>
                                @endif

                        @endcan

                        @can('tickets_editar')
                        @if(Auth()->user()->role_id!=2)
                            <a class="btn btn-success btn-sm loading mb-1"
                                href="{{ route('tickets.edit',$ticket->id)}}"
                                @if(isset($newTab) && $newTab)
                                    target="'_blank"
                                @endif
                                bs-toggle="tooltip"
                                bs-placement="top"
                                title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            @endif
                        @endcan

                        @can('tickets_editar')
                            <a class="btn btn-warning btn-sm loading mb-1"
                                href="{{ route('tickets.manage',['id' => $ticket->id, 'action' => 'manage']) }}"
                                @if(isset($newTab) && $newTab)
                                    target="'_blank"
                                @endif
                                bs-toggle="tooltip"
                                bs-placement="top"
                                title="Gestionar ticket">


                                <i class="fas fa-tools"></i>
                            </a>
                        @endcan

                        @can('tickets_eliminar')
                            <form class="d-inline frmDestroy"
                                action="{{ route('tickets.destroy', $ticket->id) }}"
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
        {{ $tickets->links() }}
    @else
        {{ $tickets->appends($data)->links() }}
    @endif
@endcomponent
