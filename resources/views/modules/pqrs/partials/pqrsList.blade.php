{{-- <div>
    <span class="badge bg-danger p-1">{{ $ticketsOpen }} Abiertos</span>
    <span class="badge bg-secondary p-1">{{ $ticketsClosed }} Cerrados</span>
    <span class="badge bg-danger p-1">{{ $ticketsHight }} Alta</span>
    <span class="badge bg-warning text-dark p-1">{{ $ticketsMedium }} Media</span>
    <span class="badge bg-success p-1">{{ $ticketsLow }} Baja</span>
</div> --}}

@component('componentes.table')
    @slot('thead')
        <th>Asunto</th>
        <th>Tema</th>
        <th>Creado por</th>
        <th>Estado</th>
    @endslot
    @slot('tbody')
    
        @foreach($pqrs as $pqr)
            <tr>
                <td>
                    <a href="{{ route('pqrs.manage', $pqr->id) }}" style="color: #2e384d">
                    {{ $pqr->issue }}
                    </a>
                </td>

                <td>
                    <a href="{{ route('pqrs.manage', $pqr->id) }}" style="color: #2e384d">
                        {{ $pqr->tema ? $pqr->tema->name : '---' }}
                    </a>
                </td>

                <td>
                    <a href="{{ route('pqrs.manage', $pqr->id) }}" style="color: #2e384d">
                        {{ $pqr->user ? $pqr->user->name : '---' }}
                    </a>
                </td>

                <td>
                    <a href="{{ route('pqrs.manage', $pqr->id) }}" style="color: #2e384d">
                        {{ $pqr->status }}
                    </a>
                </td>

            </tr>
        @endforeach
    @endslot

    @if(!isset($data))
        {{ $pqrs->links() }}
    @else
        {{ $pqrs->appends($data)->links() }}
    @endif
@endcomponent
