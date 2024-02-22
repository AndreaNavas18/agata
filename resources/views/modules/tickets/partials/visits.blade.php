<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-10">
                <h4 class="card-title">Visitas tecnicas</h4>
            </div>
            @if(Auth()->user()->role_id!=2)
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
                    <div>
                        <b>Técnicos:</b>
                        <span class="ml-2">
                            @foreach ($ticketVisit->employees as $employeeT)
                                {{ $employeeT->short_name }} &nbsp;
                            @endforeach
                        </span>
                    </div>
                    <div>
                        <b>Fecha:</b>
                        <span class="ml-2">
                            {{ $ticketVisit->date }}
                        </span>
                    </div>
                </div>
            @endforeach
        @else
            <em>No hay información</em>
        @endif
    </div>
</div>


