<div class="card-border">
    {{-- datos personales--}}
    <h4><strong>Datos personales</strong></h4>
    <div class="card-border">
        @include('modules.shared.show.infoPersonalShow', [
            'objeto' => $customer
        ])
    </div>

    {{-- Contactos agregados--}}
    <h4><strong>Contactos</strong></h4>
    @include('modules.shared.show.contactsShow', [
        'contacs' => $customerContacts
    ])
</div>




