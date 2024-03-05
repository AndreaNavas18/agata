
<form action=""
    method="POST"
    id="formProyecto">
    @csrf
    <div class="put d-none">
        @method('PUT')
    </div>
    @component('componentes.modal', [
        'id' => 'modalProyecto',
        'title' => 'Proyecto',
        'size' => 'modal-lg',
        'btnCancel' => true])

        @slot('body')
            <div class="row">

                <div class="col-md-6 mb-4">
                    @component('componentes.label', [
                        'title' => 'Nombre del proyecto',
                        'required' => true])
                    @endcomponent
                    <input type="text"
                        name="name"
                        id="name"
                        class="form-control"
                        required>
                </div>

                <div class="col-md-6 mb-4">
                    @component('componentes.label', [
                        'title' => 'Descripción',
                        'required' => true])
                    @endcomponent
                    <input type="text"
                        name="description"
                        id="description"
                        class="form-control">
                </div>

                {{-- Si se accede a este formulario desde el boton editar no se muestra este campo  --}}           
{{-- 
                @if(isset($customer) && $customer)
                    <div class="col-md-6 mb-4">
                        @component('componentes.label', [
                            'title' => 'Cliente',
                            'required' => true])
                        @endcomponent
                        <select class="form-control selectpicker"
                            name="customer_id"
                            id="customer_id"
                            required>
                            <option value="">--Seleccione--</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">
                                    {{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif --}}
        @endslot
        @slot('footer')
            <button class="btn btn-primary
                btn-sm"
                type="submit">
                <i class="fas fa-save"></i>
                Guardar
            </button>
        @endslot
    @endcomponent
</form>

{{-- inputs ocultos--}}
<input type="hidden"
    id="rutaAjax"
    data-url-cities="{{ route('general.cities') }}">

<input type="hidden"
    id="rutaAjaxDepartments"
    value="{{ route('general.departments') }}">

