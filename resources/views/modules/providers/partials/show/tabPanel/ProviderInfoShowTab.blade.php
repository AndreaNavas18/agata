<div class="card-border">
    {{-- datos personales--}}
    <h4><strong>Datos personales</strong></h4>
    <div class="card-border">
        @include('modules.shared.show.infoPersonalShow', [
            'objeto' => $provider
        ])
    </div>


    {{-- Contactos titulo--}}
    <h4><strong>Contactos agregados</strong></h4>
    {{-- Contactos agregados--}}
    @include('modules.shared.show.contactsShow', [
        'contacs' => $providerContacts
    ])
</div>

