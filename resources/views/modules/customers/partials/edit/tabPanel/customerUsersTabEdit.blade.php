<div class="card-border">
    <div>
        <a class="btn btn-primary btn-sm loading mb-2"
            href="{{ route('customers.users.index', ['customerId' =>$customer->id]) }}">
            <i class="fas fa-sync-alt"></i> Refrescar
        </a>

        <button class="btn btn-success btn-sm addUserCustomer mb-2"
            type="button"
            dataUrl="{{ route('customers.users.store' , ['customerId' => $customer->id]) }}">
            <i class="fas fa-plus"></i> Crear
        </button>
    </div>

    <!-- Filtros -->

    @include('modules.shared.users.usersList', [
        'users'          => $users,
        'showActions'       => true
    ])

    {{-- modal servicio--}}
    @include('modules.shared.users.usersForm')
</div>

