<div class="row">
    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Consecutivo',
            'id' => 'consecutive',
        ])
        @endcomponent
        <input type="text" name="consecutive" class="form-control" value="{{ $quote->consecutive }}" disabled>
    </div>
    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Asunto de la cotización',
            'id' => 'issue',
            'required' => true,
        ])
        @endcomponent
        <input type="text" name="issue" class="form-control" value="{{ $quote->issue }}">
    </div>

    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Nombre',
            'id' => 'name',
            'required' => true,
        ])
        @endcomponent
        <input type="text" name="name" class="form-control" value="{{ $quote->name }}" required>
    </div>
    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Tipo de identificación',
            'id' => 'type_document_id',
        ])
        @endcomponent
        <select class="form-control selectpicker" name="type_document_id" id="type_document_id">
            <option value="">--Seleccione--</option>
            @foreach ($typeDocuments as $typeDocumentRow)
            <option value="{{ $typeDocumentRow->id }}" {{ $typeDocumentRow->id == $quote->type_document_id ? 'selected' : '' }}>
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
        <input type="text" name="identification" class="form-control" value="{{ $quote->identification }}">
    </div>
    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Correo electrónico',
            'id' => 'email',
        ])
        @endcomponent
        <input type="text" name="email" class="form-control" value="{{ $quote->email }}">
    </div>
    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Teléfono',
            'id' => 'phone',
        ])
        @endcomponent
        <input type="text" name="phone" class="form-control" value="{{ $quote->phone }}">
    </div>

    @component('componentes.cardTitle',[
        'shadow' => true,
        'icono'  => 'fas fa-info-circle',
        'title' => 'Anchos de banda'])
    @endcomponent

   <div style="overflow-x: auto">
        {{--Aquí iría la tabla de tarifas --}}
        @include('modules.commercial.quotes.partials.edit.serviceEdit')
   </div>
   @component('componentes.cardTitle',[
        'shadow' => true,
        'icono'  => 'fas fa-info-circle',
        'title' => 'Otras opciones'])
    @endcomponent
    
    <div style="overflow-x: auto">
        {{--Aquí iría la tabla de tramos --}}
        @include('modules.commercial.quotes.partials.edit.tramoEdit')
    </div>
</div>

<script>
    var servicios = @json($servicios);
</script>
