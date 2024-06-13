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
        <th>Nombre</th>
        <th>Teléfono</th>
        @if($showActions)
            <th></th>
        @endif
    @endslot
    @slot('tbody')
    
        @foreach($quotes as $quote)
            <tr>
                <td>
                    <a href="{{ route('commercial.quotes.manage', $quote->id) }}" style="color: #2e384d">
                    {{ $quote->issue }}
                    </a>
                </td>

                <td>
                    <a href="{{ route('commercial.quotes.manage', $quote->id) }}" style="color: #2e384d">
                    {{ $quote->name }}
                    </a>
                </td>

                <td>
                    <a href="{{ route('commercial.quotes.manage', $quote->id) }}" style="color: #2e384d">
                    {{ $quote->phone }}
                    </a>
                </td>

                @if($showActions)
                    <td>
                        <form class="d-inline frmDestroy"
                            action="{{ route('commercial.quotes.destroy', $quote->id) }}"
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
                        <a class="btn btn-success btn-sm loading mb-1"
                            href="{{ route('commercial.quotes.edit',$quote->id)}}"
                            @if(isset($newTab) && $newTab)
                                target="'_blank"
                            @endif
                            bs-toggle="tooltip"
                            bs-placement="top"
                            title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-primary btn-sm mb-1"
                            href="{{ route('commercial.quotes.export', $quote->id) }}"
                            bs-toggle="tooltip"
                            bs-placement="top"
                            title="Exportar Cotización Informal">
                            <i class="fas fa-download"></i> Exportar Informal
                        </a>
                        <a class="btn btn-secondary btn-sm mb-1"
                            href="{{ route('commercial.quotes.export.formal', $quote->id) }}"
                            bs-toggle="tooltip"
                            bs-placement="top"
                            title="Exportar Cotización Formal">
                            <i class="fas fa-download"></i> Exportar Formal
                        </a>
                    </td>
                @endif
            </tr>
        @endforeach
    @endslot

    @if(!isset($data))
        {{ $quotes->links() }}
    @else
        {{ $quotes->appends($data)->links() }}
    @endif
@endcomponent
