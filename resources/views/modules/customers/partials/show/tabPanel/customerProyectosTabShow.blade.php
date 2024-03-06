<div class="card-border">
    <div>
        <a class="btn btn-primary btn-sm loading"
            href="{{ route('customers.proyectos.show', ['customerId' => $customer->id]) }}">
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
        <form method="GET" 
        action="{{route('customers.proyectos.show.search', [
            'customerId' => $customer->id])
            }}">
            @include('modules.customers.partials.formFilter2', [
                'provider' =>true,
                'customer' => false
            ])
        </form>
    </div>

    @include('modules.shared.proyectosList', [
        'proyectos'         => $proyectos,
        'module'            => 'customers',
        'showActions'       => true,
    ])
</div>
