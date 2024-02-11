<form action="{{  route('providers.update',$provider->id) }}"
    method="POST">
    @method('PUT')
    @csrf

    <input type="hidden"
    id="typesContacts"
    value="{{$typesContacts}}">


    {{-- datos personales titulo--}}
    @component('componentes.cardTitle',[
        'shadow' => true,
        'icono'  => 'fas fa-info-circle',
        'title' => 'Datos personales'])
    @endcomponent
    {{-- datos personales--}}
    {{-- <h4><strong>Datos personales</strong></h4> --}}
    <div class="card-border">
        @include('modules.shared.InfoPersonalForm', [
            'objeto' => $provider])
    </div>

    {{-- Contactos titulo--}}
    @component('componentes.cardTitle',[
        'shadow' => true,
        'icono'  => 'fas fa-info-circle',
        'title' => 'Contactos'])
    @endcomponent
    {{-- Contactos agregados--}}
    <div class="card-border">
        @if($totalContactos > 0)
            @foreach ($provider->contacs as $contact)
                @include('modules.shared.contacsForm', [
                    'showButtons' => $loop->last ? true : false,
                    'numeroContacto' => $totalContactos,
                    'contact' => $contact,
                    'route' => 'providers.contacts.destroy'
                ])
            @endforeach
        @else
            {{-- Nuevo contactos--}}
            @include('modules.shared.contacsForm', [
                'showButtons' => true,
                'numeroContacto' => 1,
                'route' =>''
            ])
        @endif
    </div>
    {{--acciones--}}
    @component('componentes.acciones')
    @endcomponent
</form>
