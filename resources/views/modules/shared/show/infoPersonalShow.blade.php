<div class="row">
    <div class="col-md-4 mb-3">
        @component('componentes.label', [
            'title' => 'Tipo de documento',
            'required' => false])
        @endcomponent
        <div>
            <label>{{  $objeto->typeDocument->name }} </label>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        @component('componentes.label', [
            'title' => 'Identificación',
            'required' => false])
        @endcomponent
        <div>
            <label>{{  $objeto->identification }} </label>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        @component('componentes.label', [
            'title' => 'Nombre',
            'required' => false])
        @endcomponent
        <div>
            <label>{{  $objeto->name }} </label>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        @component('componentes.label', [
            'title' => 'Dirección',
            'required' => false])
        @endcomponent
        <div>
            <label>{{  $objeto->address }} </label>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        @component('componentes.label', [
            'title' => 'Telefono',
            'required' => false])
        @endcomponent
        <div>
            <label>{{  $objeto->phone }} </label>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        @component('componentes.label', [
            'title' => 'Ciudad',
            'required' => false])
        @endcomponent
        <div>
            <label>{{  $objeto->city->department->name.' - '.$objeto->city->name }} </label>
        </div>
    </div>
    <div class="col-md-12 mb-3">
        @component('componentes.label', [
            'title' => 'Observaciones',
            'required' => false])
        @endcomponent
        <div>
            <textarea class="form-control" disabled>{{ $objeto->observations }}</textarea>
        </div>
    </div>
</div>
