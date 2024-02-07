<div class="col-12 mb-3">
    @component('componentes.label', [
        'title' => 'Asunto',
        'required' => false])
    @endcomponent
    <textarea class="form-control" disabled>{{ $ticket->ticket_issue }}</textarea>
</div>
<div class="col-12 mb-3">
    @component('componentes.label', [
        'title' => 'Descripción',
        'id' => 'type_document_id',
        'required' => false])
    @endcomponent
    <textarea class="form-control" disabled>{{ $ticket->description }}</textarea>
</div>
