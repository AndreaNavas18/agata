@component('componentes.table')
    @slot('thead')
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Email</th>
        <th>Fecha creación</th>
        <th>Estado</th>
    @endslot
    @slot('tbody')
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
                <td>
                    <span class="badge {{ ($user->status  == 'Activo') ? 'bg-success' : 'bg-danger' }}">
                        {{ $user->status}}
                    </span>
                </td>
                @if ($showActions)
                    <td>
                        <button class="btn btn-success btn-sm editUserCustomer mb-1"
                            bs-toggle="tooltip"
                            bs-placement="top"
                            title="Editar"
                            dataUrl="{{ route('customers.users.update',$user->id) }}"
                            datauserCustomer="{{ $user }}">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                @endif
            </tr>

        @endforeach
    @endslot

    @if(!isset($data))
        {{ $users->links() }}
    @else
        {{ $users->appends($data)->links() }}
    @endif
@endcomponent
