<div class="card-border">
    <div>
        <a class="btn btn-primary btn-sm loading"
            href="{{ route('customers.services.show', ['customerId' => $customer->id]) }}">
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
    </div>

    <!-- Filtros -->
    <div class="collapse card-border" id="buscar">
        <form method="GET" id="frmBuscar" action="{{route('customers.services.show.search', [
            'customerId' => $customer->id])
            }}">
            @include('modules.customers.partials.formFilter', [
                'provider' =>true,
                'customer' => false
            ])
        </form>
    </div>

    @include('modules.shared.servicesList', [
        'services'          => $customerServices,
        'module'            => 'customers',
        'provider'          => true,
        'customer'          => true,
        'showActions'       => false
    ])
</div>
