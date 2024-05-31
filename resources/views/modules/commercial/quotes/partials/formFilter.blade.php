
    <div class="col-md-3 col-sm-12 mb-3">
        <input class="form-control mr-2"
        type="text"
        name="issue"
        placeholder="Asunto"
        value="{{ old('issue', $data['issue'] ?? '') }}">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input class="form-control mr-2"
        type="text"
        name="name"
        placeholder="Nombre cliente"
        value="{{ old('name', $data['name'] ?? '') }}">
    </div>
    <div class="col-md-3 col-sm-12 mb-3">
        <input class="form-control mr-2"
        type="text"
        name="identification"
        placeholder="Identificación cliente"
        value="{{ old('identification', $data['identification'] ?? '') }}">
    </div>

    <div class="col-md-3 col-sm-12 mb-4 mt-2">
        @component('componentes.actions_filter')
        @endcomponent
    </div>
