<div class="card-border">
    <div>
        <a class="btn btn-primary btn-sm loading"
            href="{{ route('customers.tickets.show', ['customerId', $customer->id]) }}">
            <i class="fas fa-sync-alt"></i> Refrescar
        </a>
        <a class="btn btn-info btn-sm"
            data-bs-toggle="collapse"
            href="#buscar"
            role="button"
            aria-expanded="false"
            aria-controls="buscar">
            <i class="fas fa-search"></i> Buscar
        </a>
        <button class="btn btn-success btn-sm addService"
            type="button"
            dataUrl="{{ route('tickets.create') }}">
            <i class="fas fa-plus"></i> Crear
        </button>
    </div>

    <!-- Filtros -->
    <div class="collapse" id="buscar">
        <div class="card-border">
            <form method="GET" id="frmBuscar" action="{{route('customers.tickets.show.search', [
                'customerId' => $customer->id]) }}">
                @include('modules.tickets.partials.formFilter', [
                    'provider' =>true,
                    'customer' => false
                ])
            </form>
        </div>
    </div>

    @include('modules.Tickets.Partials.ticketsList', [
        'tickets'           => $tickets,
        'provider'          => true,
        'customer'          => false,
        'showActions'       => false,
    ])
</div>

