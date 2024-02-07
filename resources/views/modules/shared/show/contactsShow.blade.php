	<!-- Datos -->
@component('componentes.table')
    @slot('thead')
        <th>Tipo de contacto</th>
        <th>Ciudad</th>
        <th>Nombre</th>
        <th>Telefono fijo</th>
        <th>Telefono movil</th>
        <th>Email</th>
    @endslot
    @slot('tbody')
        @foreach($contacs as $contac)
            <tr>
                <td>{{  $contac->typeContact->name }}</td>
                <td>{{  $contac->city->name }}</td>
                <td>{{  $contac->name }}</td>
                <td>{{  $contac->home_phone }}</td>
                <td>{{  $contac->cell_phone }}</td>
                <td>{{  $contac->email }}</td>
            </tr>
        @endforeach
    @endslot
    @if(!isset($data))
        {{ $contacs->links() }}
    @else
        {{ $contacs->appends($data)->links() }}
    @endif
@endcomponent
