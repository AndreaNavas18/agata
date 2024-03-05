@php
    
@endphp
<form action="{{ route('customers.proyectos.asignarServicio') }}"
    method="POST"
    id="formAsignarServicio">
    @csrf
    @component('componentes.modal', [
        'id' => 'modalAsignarServicio',
        'title' => 'Asignar servicio',
        'size' => 'modal-lg',
        'btnCancel' => true])

    @slot('body')
    <div class="row">
        <div class="col-md-12">
            <div class="mb-4">
                <label class="form-label" for="{{ isset($id) ? $id : ''}}">
                    <span id="title_proyecto"></span>
                    <input type="hidden"
                        name="proyecto_id"
                        id="proyecto_id"
                        value="">
                    @if(isset($required) && $required)
                        <i class=" fa fa-asterisk small text-danger"></i>
                    @endif
                </label>
            </div>
        </div>

        <div class="col-md-12">
                <div class="mb-4">
                @component('componentes.label', [
                    'title' => 'Servicios',
                    'required' => false])
                @endcomponent
                <select class="form-control selectpicker"
                    name="customerservices[]"
                    id="customerservices"
                    multiple
                    data-width="100%">
                    <option value="">--Seleccione--</option>
                </select>
            </div>
        </div>
    </div>
    @endslot

    @slot('footer')
    <button class="btn btn-primary btn-sm" type="submit">
        <i class="fas fa-save"></i>
        Guardar
    </button>
    @endslot
    @endcomponent
    </form>

