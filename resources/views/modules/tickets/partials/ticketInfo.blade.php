@component('componentes.card', [
    'title'=> 'Información'])
    <table class="table">
        <tr class="border-bottom">
            <td>Consecutivo ID</td>
            <td class="text-right">
                <span> {{ $ticket->consecutive }}</span>
            </td>
        </tr>
        @if(!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
        <tr class="border-bottom">
            <td class="border-top-0">Cliente</td>
            <td class="text-right border-top-0">
                <span>{{ $ticket->customer->name }}</span>
            </td>
        </tr>
        @endif
        <tr class="border-bottom">
            <td>Descripcion Servicio</td>
            <td class="text-right">
                <span> {{ $ticket->service->description }}</span>
            </td>
        </tr>
        @if(!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
            <tr class="border-bottom">
                <td>Proveedor</td>
                <td class="text-right">
                    <span>
                        {{ $ticket->service->provider ? $ticket->service->provider->name : 'N/A'}}
                    </span>
                </td>
            </tr>

            <tr class="border-bottom">
                <td>Asignado a</td>
                <td class="text-right">
                    <span>
                        {{ $ticket->employee_id ? $ticket->employee->short_name : 'No hay agente asignado'}}
                        <div class="col-2 float-right">
                            <button
                                class="btn btn-secondary btn-sm text-white addAgent"
                                data-toggle="tooltip"
                                title=""
                                data-placement="top"
                                data-original-title="Asignar agente"
                                type="button"
                                data-replieId="">
                                <span>
                                    <i class="fa fa-regular fa-user"></i>
                                </span>
                            </button>
                        </div>
                    </span>
                </td>
            </tr>

            <tr class="border-bottom">
                <td>Prioridad</td>
                <td class="text-right">
                    <span class="badge col-4 {{ $ticket->priority->color=='BG-DANGER' ? 'bg-danger' : 'bg-info' }} rounded-pill">
                        {{ $ticket->priority->name }}
                    </span>
                        <div class="col-2 float-right">
                            <button
                                class="btn btn-warning btn-sm text-white addPriority"
                                data-toggle="tooltip"
                                title=""
                                data-placement="top"
                                data-original-title="Asignar prioridad"
                                type="button"
                                data-replieId="">
                                <span>
                                    <i class="fa fa-solid fa-triangle-exclamation"></i>
                                </span>
                            </button>
                        </div>
                </td>
            </tr>
        @endif
        <tr class="border-bottom">
            <td>Fecha de creación</td>
            <td class="text-right">
                <span>
                    {{ $ticket->created_at}}
                </span>
            </td>
        </tr>

        <tr class="border-bottom">
            <td>Estado</td>
            <td class="text-right">
                <span class="badge {{ $ticket->state=='ABIERTO' ? 'bg-danger' : 'bg-success' }} rounded-pill">
                    {{ $ticket->state }}
                </span>
            </td>
            @if(!in_array(Auth()->user()->role_id, [2, 3, 7, 8])) 
            <td>
                 {{-- boton para cambiar el estado del ticket si esta cerrado a abierto  --}}
                 @if($ticket->state=='CERRADO')
                    <form method="POST" action="{{ route('tickets.reopen', $ticket->id) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success btn-sm text-white" data-toggle="tooltip" title="Reabrir ticket">
                            <span><i class="fa fa-undo"></i></span>
                        </button>
                    </form>
                @endif
            </td>
            @endif
        </tr>
    </table>
@endcomponent
