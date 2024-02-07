<div class="card-border">
    <div>
        <a class="btn btn-primary btn-sm loading"
            href="{{ route('providers.tickets.show', ['providerId', $provider->id]) }}">
            <i class="fas fa-sync-alt"></i> Refrescar
        </a>

        <a class="btn btn-info btn-sm"
            data-toggle="collapse"
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
    <div class="collapse card-border" id="buscar">
        <form method="GET"
            id="frmBuscar"
            action="{{route('providers.tickets.show.search', [
            'providerId' => $provider->id]) }}">

            @include('modules.tickets.partials.formFilter', [
                'provider' =>false,
                'customer' => true
            ])
        </form>
    </div>

    @include('modules.tickets.partials.ticketsList', [
        'tickets'           => $tickets,
        'provider'          => false,
        'customer'          => true,
        'showActions'       => false,
        'newTab'            => true
    ])
</div>


