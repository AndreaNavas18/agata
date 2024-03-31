<div class="col-12 mb-4">
    @component('componentes.label', [
        'title' => 'Documento',
        'id' => 'file',
        'required' => false])
    @endcomponent
    <input type="file"
        class="form-control"
        name="file"
        id="file"
        >
</div>