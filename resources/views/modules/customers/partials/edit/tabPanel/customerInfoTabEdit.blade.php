<div class="card-border">
    <form action="{{  route('customers.update',$customer->id) }}"
        method="POST"
        id="formSearch">
        @method('PUT')
        @csrf

        {{-- datos personales--}}
        <h4><strong>Datos personales</strong></h4>
        <div class="card-border">
            @include('modules.shared.InfoPersonalForm', [
                'objeto' => $customer
            ])
        </div>

        <input type="hidden"
            id="typesContacts"
            value="{{$typesContacts}}">


        {{-- Contactos agregados--}}
        <h4><strong>Contactos</strong></h4>
        <div class="card-border">
            @if($totalContactos > 0)
                @foreach ($customer->customerContacs as $contact)
                    @include('modules.shared.contacsForm', [
                        'showButtons' => $loop->last ? true : false,
                        'numeroContacto' => $totalContactos,
                        'contact' => $contact,
                        'route' => 'customers.contacts.destroy'
                    ])
                @endforeach
            @else
                {{-- Nuevo contactos--}}
                @include('modules.shared.contacsForm', [
                    'showButtons' => true,
                    'numeroContacto' => 1,
                    'route' => 'customers.contacts.destroy'
                ])
            @endif
        </div>


        {{--acciones--}}
        @component('componentes.acciones')
        @endcomponent
    </form>
</div>
