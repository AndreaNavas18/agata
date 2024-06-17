{{-- <div>
    <span class="badge bg-danger p-1">{{ $ticketsOpen }} Abiertos</span>
    <span class="badge bg-secondary p-1">{{ $ticketsClosed }} Cerrados</span>
    <span class="badge bg-danger p-1">{{ $ticketsHight }} Alta</span>
    <span class="badge bg-warning text-dark p-1">{{ $ticketsMedium }} Media</span>
    <span class="badge bg-success p-1">{{ $ticketsLow }} Baja</span>
</div> --}}

@component('componentes.table')
    @slot('thead')
        <th>Consecutivo</th>
        <th>Titulo</th>
        <th>Fecha</th>
        @if($customer && !in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
            <th>Cliente</th>
        @endif
        <th>Servicio</th>
        @if($provider && !in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
            <th> Proveedor</th>
            <th>Asignado</th>
            <th>Prioridad</th>
            <th>Otra Prioridad</th>
           
            <th>Tiempo</th>
            <th>Fecha y Hora</th>
            <th>Estado Tiempo</th>
            <th>Enviar Email</th>
            <th>Email Notificaciones</th>
        @endif
    
        
        <th>Estado</th>


        @if($showActions)
            <th></th> 
        @endif


    @endslot
    @slot('tbody')
    
        @foreach($tickets as $ticket)
            <tr>
                <td>
                    <a href="{{ route('tickets.manage', $ticket->id) }}" style="color: #2e384d">
                    {{ $ticket->consecutive }}
                    </a>
                </td>

                <td>
                    <a href="{{ route('tickets.manage', $ticket->id) }}" style="color: #2e384d">
                    {{ $ticket->ticket_issue }}
                    </a>
                </td>

                <td>
                    <a href="{{ route('tickets.manage', $ticket->id) }}" style="color: #2e384d">

                    {{ $ticket->date }}
                    </a>
                </td>

                @if($customer && !in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
                    <td>
                    <a href="{{ route('tickets.manage', $ticket->id) }}" style="color: #2e384d">
                        {{ $ticket->customer ? $ticket->customer->name : '' }}
                    </a>
                    </td>
                @endif

                <td>
                    {{-- {{ optional($ticket->service)->description }} --}}
                    <a href="{{ route('tickets.manage', $ticket->id) }}" style="color: #2e384d">
                    {{ $ticket->service->name }}
                    </a>
                </td>

                @if($provider && !in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
                    <td>
                    <a href="{{ route('tickets.manage', $ticket->id) }}" style="color: #2e384d">
                        {{ $ticket->service->provider ? $ticket->service->provider->name : '---' }}
                    </a>
                    </td>
                    <td>
                    <a href="{{ route('tickets.manage', $ticket->id) }}" style="color: #2e384d">
                        {{  $ticket->employee ? $ticket->employee->short_name : 'No hay agente asignado' }}
                    </a>
                    </td>
                    <td>
                        <span class="badge {{ $ticket->priority->color}}">
                            <a href="{{ route('tickets.manage', $ticket->id) }}" style="color: #2e384d">
                                {{ $ticket->priority->name}}
                            </a>
                        </span>
                    </td>
                    <td>
                        <span class="badge {{ $ticket->priority->color}}">
                            <a href="{{ route('tickets.manage', $ticket->id) }}" style="color: #2e384d">
                                {{ $ticket->other_priority}}
                            </a>
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('tickets.manage', $ticket->id) }}" style="color: #2e384d">
                                {{ $ticket->time_clock}}
                        </a>
                    </td>

                    <td>
                        <a href="{{ route('tickets.manage', $ticket->id) }}" style="color: #2e384d">
                            {{ $ticket->datetime_clock}}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('tickets.manage', $ticket->id) }}" style="color: #2e384d">
                                {{ $ticket->state_clock}}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('tickets.manage', $ticket->id) }}" style="color: #2e384d">
                                {{ $ticket->send_email}}
                        </a>
                    </td>

                    <td>
                        <a href="{{ route('tickets.manage', $ticket->id) }}" style="color: #2e384d">
                                {{ $ticket->emails_notification}}
                        </a>
                    </td>
    
                @endif

                <td>
                    <span class="badge {{ ($ticket->state  == 'ABIERTO') ? 'bg-danger' : 'bg-success' }}">
                            {{ $ticket->state}}
                    </span>
                </td>


                

                @if($showActions)
                    <td>
                        @can('tickets.index')
                        @if(!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))

                                {{-- <a class="btn btn-info btn-sm loading mb-1"
                                    href="{{ route('tickets.show', $ticket->id) }}"
                                    @if(isset($newTab) && $newTab)
                                        target="'_blank"
                                    @endif
                                    bs-bs-toggle="tooltip"
                                    bs-bs-placement="top"
                                    title="Ver">
                                    <i class="far fa-eye"></i>
                                </a> --}}
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

                        @can('tickets.edit')
                        @if(!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
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

                        @can('tickets.edit')
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

                        @can('tickets.destroy')
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
