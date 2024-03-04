@php
    $proyectoSeleccionadoId = session('proyectoSeleccionadoId');
    $proyectoSeleccionado = $proyectos->firstWhere('id', $proyectoSeleccionadoId);
@endphp
@foreach($proyectos as $proyecto)
<form action=""
    method="POST"
    id="formAsignarServicio">
    @csrf
    <div class="put d-none">
        @method('PUT')
    </div>
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
                    id="customerservices[]"
                    multiple
                    data-width="100%">
                    <option value="">--Seleccione--</option>
                    @foreach($customerServices as $customerService)
                        <option value="{{ $customerService->id }}">
                            {{ $customerService->description }}
                        </option>
                    @endforeach
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
    @endforeach

{{-- inputs ocultos--}}
<input type="hidden"
    id="rutaAjax"
    data-url-cities="{{ route('general.cities') }}">

<input type="hidden"
    id="rutaAjaxDepartments"
    value="{{ route('general.departments') }}">

<input type="hidden" 
    id="proyectoSeleccionadoId" 
    name="proyectoSeleccionadoId"
    value="">

