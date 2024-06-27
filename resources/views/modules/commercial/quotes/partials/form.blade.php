<div class="row">
    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Asunto de la cotización',
            'id' => 'issue',
            'required' => true,
        ])
        @endcomponent
        <input type="text" name="issue" class="form-control" value="{{ isset($quote) ? $quote->issue : '' }}">
    </div>
    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Nombre',
            'id' => 'name',
            'required' => true,
        ])
        @endcomponent
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Tipo de identificación',
            'id' => 'type_document_id',
        ])
        @endcomponent
        <select class="form-control
                selectpicker" name="type_document_id" id="type_document_id">
                <option value="">--Seleccione--</option>
                @foreach ($typeDocuments as $typeDocumentRow)
                <option value="{{ $typeDocumentRow->id }}">
                    {{ $typeDocumentRow->name }}
                </option>
                @endforeach
            </select>
    </div>
    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Identificación',
            'id' => 'identification',
        ])
        @endcomponent
        <input type="text" name="identification" class="form-control">
    </div>
    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Correo electrónico',
            'id' => 'email',
        ])
        @endcomponent
        <input type="text" name="email" class="form-control">
    </div>
    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Teléfono',
            'id' => 'phone',
        ])
        @endcomponent
        <input type="text" name="phone" class="form-control">
    </div>
</div>
<div>
    @include('modules.commercial.quotes.partials.service')

</div>
