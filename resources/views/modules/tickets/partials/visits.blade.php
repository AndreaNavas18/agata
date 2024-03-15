<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-10">
                <h4 class="card-title">Visitas tecnicas</h4>
            </div>
            @if(!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
                <div class="col-2 float-right">
                    <button
                        class="btn btn-success btn-sm text-white addVisit"
                        data-toggle="tooltip"
                        title=""
                        data-placement="top"
                        data-original-title="Nueva visita tecnica"
                        type="button"
                        data-replieId="">
                        <span>
                            <i class="fa fa-plus"></i>
                        </span>
                    </button>
                </div>
            @endif
        </div>

    </div>
    <div class="card-body">
        @if (count($ticket->ticketsVisits)>0)
            @foreach ($ticket->ticketsVisits as $ticketVisit)
                <div
                    data-toggle="tooltip"
                    title=""
                    data-placement="top"
                    data-original-title=" {{ $ticketVisit->description }}"
                    class="pointer border-top-cs">
                    @if (count($ticketVisit->employees)>0)
                        <div>
                            <b>Empleados agendados:</b>
                            <span class="ml-2">
                                @foreach ($ticketVisit->employees as $employeeT)
                                    </br> {{ $employeeT->short_name }} 
                                    {{-- &nbsp; --}}
                                @endforeach
                            </span>
                        </div>
                    @else
                        <div>
                            <b>Visita:</b>
                            <span class="ml-2">
                               Tercerizada
                            </span>
                        </div>
                    @endif
                    <div>
                        <b>Fecha:</b>
                        <span class="ml-2">
                            {{ $ticketVisit->date }}
                        </span>
                    </div>
                    <div>
                        <b>Hora:</b>
                        <span class="ml-2">
                            {{ $ticketVisit->time }}
                        </span>
                    </div>
                    {{-- Si hay archivos que los muestre --}}
                    @if(count($ticketVisit->ticketvisitfiles)>0)
                        <div class="row">
                            @component('componentes.table')
                                @slot('thead')
                                    <th>Documentos adjuntos:</th>
                                    <th></th>
                                @endslot
                                @slot('tbody')
                                    @foreach ($ticketVisit->ticketvisitfiles as $file)
                                        <tr>
                                            <td>
                                                <a class="btn btn-info"
                                                    target="_blank"
                                                    href="{{ Storage::url($file->path) }}"
                                                    data-original-title= "{{ $ticketVisit->name_original }}" >
                                                    <i class="fas fa-file-download"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <span> 
                                                    {{ $file->name_original }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endslot
                            @endcomponent
                        </div>
                    @endif
                </div>
            @endforeach
        @else
            <em>No hay información</em>
        @endif
    </div>
</div>


