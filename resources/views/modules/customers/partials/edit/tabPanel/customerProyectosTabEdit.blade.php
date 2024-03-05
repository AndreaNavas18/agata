<div class="card-border">
    <div>
        <a class="btn btn-primary btn-sm loading mb-2"
            href="{{ route('customers.proyectos.index', ['customerId' =>$customer->id]) }}">
            <i class="fas fa-sync-alt"></i> Refrescar
        </a>

        <a class="btn btn-info btn-sm mb-2"
            data-toggle="collapse"
            href="#buscar"
            role="button"
            aria-expanded="false"
            aria-controls="buscar">
            <i class="fas fa-search"></i> Buscar
        </a>

        <button class="btn btn-success btn-sm addProyecto mb-2"
            type="button"
            dataUrl="{{ route('customers.proyectos.store' , ['customerId' => $customer->id]) }}">
            <i class="fas fa-plus"></i> Crear
        </button>
    </div>

    <!-- Filtros -->
    <div class="collapse card-border" id="buscar">
        <form method="GET"
        action="{{route('customers.proyectos.index.search', [
                'customerId' => $customer->id])
            }}">
            @include('modules.customers.partials.formFilter', [
                'provider' =>true,
                'customer' => false
            ])
        </form>
    </div>

    @include('modules.shared.proyectoAsignar')
    
    @include('modules.shared.proyectosList', [
        'proyectos'          => $proyectos,
        'module'            => 'customers',
        'provider'          => true,
        'customer'          => true,
        'showActions'       => true
    ])

    {{-- modal servicio--}}
    @include('modules.shared.proyectoForm', ['module' => 'customers'])
    
</div>

