@component('componentes.card', [
    'title'=> 'Información'])
    <table class="table">
        @if(Auth()->user()->role_id!=2)
        <tr class="border-bottom">
            <td class="border-top-0">Cliente</td>
            <td class="text-right border-top-0">
                <span>{{ $ticket->customer->name }}</span>
            </td>
        </tr>
        @endif
        <tr class="border-bottom">
            <td>Servicio</td>
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
                <span class="badge {{ $ticket->priority->color }} rounded-pill">
                    {{ $ticket->priority->name }}
                </span>
            </td>
        </tr>
        @endif
        <tr class="border-bottom">
            <td>Estado</td>
            <td class="text-right">
                <span class="badge {{ $ticket->state=='ABIERTO' ? 'bg-danger' : 'bg-success' }} rounded-pill">
                    {{ $ticket->state }}
                </span>
            </td>
        </tr>
    </table>
@endcomponent
