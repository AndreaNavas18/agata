@component('componentes.card', [
    'title'=> 'Información'])
    <table class="table">
        <tr class="border-bottom">
            <td>Consecutivo ID</td>
            <td class="text-right">
                <span> {{ $ticket->consecutive }}</span>
            </td>
        </tr>
        @if(Auth()->user()->role_id!=2)
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
        @if(Auth()->user()->role_id!=2)
            <tr class="border-bottom">
                <td>Proveedor</td>
                <td class="text-right">
                    <span>
                        {{ $ticket->service->provider ? $ticket->service->provider->name : 'N/A'}}
                    </span>
                </td>
            </tr>

        <tr class="border-bottom">
            <td>Prioridad</td>
            <td class="text-right">
                <span class="badge {{ $ticket->priority->color=='BG-DANGER' ? 'bg-danger' : 'bg-info' }} rounded-pill">
                    {{ $ticket->priority->name }}
                </span>
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
        </tr>
    </table>
@endcomponent
