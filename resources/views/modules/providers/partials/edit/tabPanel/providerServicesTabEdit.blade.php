<div class="card-border">
    <div>
        <a class="btn btn-primary btn-sm loading mb-2"
            href="{{ route('providers.services.index', ['providerId' => $provider->id]) }}">
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

        <button class="btn btn-success btn-sm addService  mb-2"
            type="button"
            dataUrl="{{ route('providers.services.store' , ['providerId' => $provider->id]) }}">
            <i class="fas fa-plus"></i> Crear
        </button>
    </div>

    <!-- Filtros -->
    <div class="collapse card-border" id="buscar">
        <form method="GET"
            id="frmBuscar"
            action="{{route('providers.services.index.search', [
                'providerId' => $provider->id])
            }}">
            @include('modules.customers.partials.formFilter', [
                'provider' =>false,
                'customer' => true
            ])
        </form>
    </div>

    @include('modules.shared.servicesList', [
        'services'          => $providerServices,
        'module'            => 'providers',
        'provider'          => false,
        'customer'          => true,
        'showActions'       => true
    ])

    {{-- modal servicio--}}
    @include('modules.shared.serviceForm', ['module' => 'providers'])
</div>



