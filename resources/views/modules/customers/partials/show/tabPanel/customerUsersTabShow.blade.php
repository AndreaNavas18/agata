<div class="card-border">
    <div>
        <a class="btn btn-primary btn-sm loading mb-2"
            href="{{ route('customers.users.show', ['customerId' =>$customer->id]) }}">
            <i class="fas fa-sync-alt"></i> Refrescar
        </a>
    </div>

    <!-- listado de usuarios -->
    @include('modules.shared.users.usersList', [
        'users'          => $users,
        'showActions'    => false
    ])
</div>

