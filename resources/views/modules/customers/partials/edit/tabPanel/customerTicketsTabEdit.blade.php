<div class="card-border">
    <div>
        <a class="btn btn-primary btn-sm loading mb-2"
            href="{{ route('customers.tickets.edit', ['customerId', $customer->id]) }}">
            <i class="fas fa-sync-alt"></i> Refrescar
        </a>

        <a class="btn btn-info btn-sm  mb-2"
            data-toggle="collapse"
            href="#buscar"
            role="button"
            aria-expanded="false"
            aria-controls="buscar">
            <i class="fas fa-search"></i> Buscar
        </a>

        <a class="btn btn-success btn-sm addService mb-2"
            type="button"
            href="{{ route('tickets.create') }}"
            target="_blank">
            <i class="fas fa-plus"></i> Crear
        </a>
    </div>


    <!-- Filtros -->
    <div class="collapse" id="buscar">
        <div class="card-border">
            <form method="GET"
                action="{{route('customers.tickets.edit.search', [
                'customerId' => $customer->id]) }}">
                @include('modules.tickets.partials.formFilter', [
                    'provider' =>true,
                    'customer' => false
                ])
            </form>
        </div>
    </div>

    @include('modules.tickets.partials.ticketsList', [
        'tickets'           => $tickets,
        'provider'          => true,
        'customer'          => false,
        'newTab'            => true,
        'showActions'       => true
    ])
</div>

