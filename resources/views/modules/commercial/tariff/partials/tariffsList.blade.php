@component('componentes.table')
    @slot('thead')
        <th>Tipo de Servicio</th>
        <th>BW</th>
        <th>Recurrencia</th>
        <th>Meses</th>
        <th>Valor por Mbps</th>
    @endslot
    @slot('tbody')
    
        @foreach($tariffs as $tariff)
            <tr>
                <td>
                    <a href="{{ route('tariff.show',$tariff->id)}}" style="color: #2e384d">
                    {{ $tariff->comercialTypeService->name }}
                    </a>
                </td>

                <td>
                    <a href="{{ route('tariff.show',$tariff->id)}}" style="color: #2e384d">
                    {{ $tariff->bandwidth->name }}
                    </a>
                </td>

                <td>
                    <a href="{{ route('tariff.show',$tariff->id)}}" style="color: #2e384d">
                    $ {{ $tariff->recurring_value }}

                    </a>
                </td>

                <td>
                    <a href="{{ route('tariff.show',$tariff->id)}}" style="color: #2e384d">
                    {{ $tariff->months}}

                    </a>
                </td>

                <td>
                    <a href="{{ route('tariff.show',$tariff->id)}}" style="color: #2e384d">
                    $ {{ $tariff->value_Mbps}}

                    </a>
                </td>


                {{-- @if($showActions) --}}
                    <td>
                        {{-- @can('tickets.index')
                        @if(!in_array(Auth()->user()->role_id, [2, 3, 7, 8])) --}}
                        
                                {{-- @else --}}

                                {{-- @endif --}}

                        {{-- @endcan --}}

                        {{-- @can('tickets.edit') --}}
                        {{-- @if(!in_array(Auth()->user()->role_id, [2, 3, 7, 8])) --}}
                            {{-- <a class="btn btn-success btn-sm loading mb-1" --}}
                                {{-- href="{{ route('tickets.edit',$ticket->id)}}" --}}
                                {{-- @if(isset($newTab) && $newTab)
                                    target="'_blank"
                                @endif --}}
                                {{-- bs-toggle="tooltip"
                                bs-placement="top"
                                title="Editar">
                                <i class="fas fa-edit"></i>
                            </a> --}}
                            {{-- @endif
                        @endcan --}}



                        @can('commercial.destroy')
                            <form class="d-inline frmDestroy"
                                action="{{ route('tariff.destroy', $tariff->id) }}"
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
                {{-- @endif --}}
            </tr>
        @endforeach
    @endslot

    {{-- @if(!isset($data))
        {{ $tickets->links() }}
    @else
        {{ $tickets->appends($data)->links() }}
    @endif --}}
@endcomponent
