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
                    <a href="" style="color: #2e384d">
                    {{ $tariff->comercialTypeService->name }}
                    </a>
                </td>

                <td>
                    <a href="" style="color: #2e384d">
                    {{ $tariff->bandwidth->name }}
                    </a>
                </td>

                <td>
                    <a href="" style="color: #2e384d">
                    $ {{ $tariff->recurring_value }}

                    </a>
                </td>

                <td>
                    <a href="" style="color: #2e384d">
                    {{ $tariff->months}}

                    </a>
                </td>

                <td>
                    <a href="" style="color: #2e384d">
                    $ {{ $tariff->value_Mbps}}

                    </a>
                </td>


                {{-- @if($showActions) --}}
                    <td>
                        {{-- @can('tickets.index')
                        @if(!in_array(Auth()->user()->role_id, [2, 3, 7, 8])) --}}
                        
                                {{-- @else --}}
                                <a class="btn btn-info btn-sm loading mb-1"
                                    {{-- href="{{ route('tickets.manage', $ticket->id) }}" --}}
                                    {{-- @if(isset($newTab) && $newTab)
                                        target="'_blank"
                                    @endif --}}
                                    bs-bs-toggle="tooltip"
                                    bs-bs-placement="top"
                                    title="Ver">
                                    <i class="far fa-eye"></i>
                                </a>
                                {{-- @endif --}}

                        {{-- @endcan --}}

                        {{-- @can('tickets.edit') --}}
                        {{-- @if(!in_array(Auth()->user()->role_id, [2, 3, 7, 8])) --}}
                            <a class="btn btn-success btn-sm loading mb-1"
                                {{-- href="{{ route('tickets.edit',$ticket->id)}}" --}}
                                {{-- @if(isset($newTab) && $newTab)
                                    target="'_blank"
                                @endif --}}
                                bs-toggle="tooltip"
                                bs-placement="top"
                                title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            {{-- @endif
                        @endcan --}}

                        {{-- @can('tickets.edit') --}}
                            <a class="btn btn-warning btn-sm loading mb-1"
                                {{-- href="{{ route('tickets.manage',['id' => $ticket->id, 'action' => 'manage']) }}" --}}
                                {{-- @if(isset($newTab) && $newTab)
                                    target="'_blank"
                                @endif --}}
                                bs-toggle="tooltip"
                                bs-placement="top"
                                title="Gestionar ticket">


                                <i class="fas fa-tools"></i>
                            </a>
                        {{-- @endcan --}}

                        {{-- @can('tickets.destroy') --}}
                            <form class="d-inline frmDestroy"
                                {{-- action="{{ route('tickets.destroy', $ticket->id) }}" --}}
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
                        {{-- @endcan --}}
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
