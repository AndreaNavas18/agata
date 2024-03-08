<form action="{{  route('tickets.reply.store', $ticket->id) }}"
    method="POST"
    id="formStore"
    enctype="multipart/form-data">
    @csrf

    @if (!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
        <div class="row">
            <div class="col-md-6 mb-3">
                @component('componentes.label', [
                    'title' => 'Estado del ticket',
                    'id' => 'state',
                    'required' => true])
                @endcomponent
                <select class="form-control"
                    name="state"
                    id="state"
                    required>
                    <option {{ $ticket->state=='Abierto' ? 'selected' : '' }}>
                        Abierto
                    </option>
                    <option {{ $ticket->state=='Cerrado' ? 'selected' : '' }}>
                        Cerrado
                    </option>
                </select>
            </div>
            @if($ticket->priority_id == 1)
            <div class="col-md-6 mb-3">
                @component('componentes.label', [
                    'title' => 'Estado reloj',
                    'id' => 'state_clock',
                    'required' => true])
                @endcomponent
                <select class="form-control"
                    name="state_clock"
                    id="state_clock"
                    required>
                    <option {{ $ticket->state_clock=='Detenido' ? 'selected' : '' }}>
                        Detenido
                    </option>
                    <option {{ $ticket->state_clock=='Corriendo' ? 'selected' : '' }}>
                        Corriendo
                    </option>
                </select>
            </div>
            @endif
        </div>
    @endif

    <div class="row">
        <div class="col-12 mb-3">
            @component('componentes.label', [
                'title' => 'Nueva respuesta',
                'id' => 'type_document_id',
                'required' => true])
            @endcomponent
            <textarea class="form-control" id="editor" rows="7" name="replie"></textarea>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-3">
            <div class="col-12 mb-3">
                @component('componentes.label', [
                    'title' => 'Archivos',
                    'id' => 'type_document_id',
                    'required' => false])
                @endcomponent
            </div>
           <input class="form-control" name="files[]" type="file" multiple>
        </div>
    </div>
    <div class="mt-5">
        @component('componentes.acciones')
        @endcomponent
    </div>
</form>


