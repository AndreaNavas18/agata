@if(count($service->files)>0)
    <div class="row">
        @component('componentes.table')
            @slot('thead')
                <th>Tipo documento</th>
                <th>Documento</th>
                @can('customers.services.destroy')
                    <th>Eliminar</th>
                    @if( Session::get('tab') == 'config' )
                        <th>Actualizar</th>
                    @endif
                @endcan
            @endslot
            @slot('tbody')
                @foreach ($service->files as $file)
                    <tr>
                        <td>
                            <a href="{{ route('customers.services.download.file', ['id' => $file->id]) }}" download>
                                {{ $file->name_original }}
                            </a>
                        </td>
                        <td>
                            @if (in_array(strtolower(pathinfo($file->path, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif']))
                                <a href="{{ Storage::url($file->path) }}" target="_blank">
                                    <img src="{{ Storage::url($file->path) }}" alt="{{ $file->name_original }}" style="max-width: 100px; max-height: 100px;">
                                </a>
                            @else
                                <a class="btn btn-info"
                                    target="_blank"
                                    href="{{ Storage::url($file->path) }}">
                                    <i class="fas fa-file-download"></i>
                                </a>
                            @endif

                            {{-- <a class="btn btn-info"
                                target="_blank"
                                href="{{ Storage::url($file->path) }}">
                                <i class="fas fa-file-download"></i>
                            </a> --}}
                        </td>
                        @can('customers.services.destroy')
                        <td>
                            <a href="{{ route('customers.services.delete.file', $file->id) }}"
                                class="btn btn-danger btn-sm"
                                data-toggle="tooltip"
                                data-placement="top"
                                onclick="return confirm('¿Estás seguro que deseas eliminar este registro?');"
                                title="Eliminar">
                                    <i class="fas fa-trash-alt"></i> Eliminar
                                </a>
                        </td>
                        @if( Session::get('tab') == 'config' )
                        <td>

                            <div>
                                <button class="btn btn-info btn-sm mb-1 update-file-btn">
                                    <i class="fas fa-solid fa-arrow-up"></i> Actualizar
                                </button>
                            </div>
                        </td>
                        @endif
                            {{-- <form class="d-inline"
                                        action="{{ route('customers.services.update.file', $file->id) }}"
                                        method="POST"
                                        enctype="multipart/form-data"
                                        id="formUpdate"
                                        >
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-info btn-sm mb-1"
                                            type="submit"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Actualizar">
                                            <i class="fas fa-solid fa-arrow-up"></i> Actualizar
                                        </button>
                                    </form> --}}
                    @endcan
                    </tr>
                    <tr class="update-file-form" style="display: none;">
                        <td colspan="4">
                            <form class="d-inline"
                                action="{{ route('customers.services.update.file', $file->id) }}" 
                                method="POST" 
                                enctype="multipart/form-data"
                                >
                                @csrf
                                @method('PUT')
                                @include('modules.customers.services.partials.documentUpdate')
                                <button type="submit" class="btn btn-primary">Subir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endslot
        @endcomponent
    </div>
@else
    <div class="row">
        <div class="col-md-12">
            <em class="text-danger">No hay documentos cargados</em>
        </div>
    </div>
@endif

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Obtener todos los botones de actualizar archivo
        const updateFileBtns = document.querySelectorAll('.update-file-btn');

        // Agregar un event listener a cada botón
        updateFileBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                // Obtener el formulario asociado
                const form = btn.closest('tr').nextElementSibling;

                // Mostrar u ocultar el formulario según su estado actual
                if (form.style.display === 'none') {
                    form.style.display = 'table-row';
                } else {
                    form.style.display = 'none';
                }
            });
        });
    });
</script>
