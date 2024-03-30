@if(count($employee->files)>0)
    <div class="row">
        @component('componentes.table')
            @slot('thead')
                <th>Tipo documento</th>
                <th>Documento</th>
            @can('employees.destroy')
                <th>Acciones</th>
            @endcan
            @endslot
            @slot('tbody')
                @foreach ($employee->files as $file)
                    <tr>
                        <td>
                            <a href="{{ route('employees.download.file', ['id' => $file->id]) }}" download>
                                {{ $file->name_original }}
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-info"
                                target="_blank"
                                href="{{ Storage::url($file->path) }}">
                                <i class="fas fa-file-download"></i>
                            </a>
                        </td>
                @can('employees.destroy')
                        <td>
                            <a href="{{ route('employees.delete.file', $file->id) }}"
                                class="btn btn-danger btn-sm"
                                data-toggle="tooltip"
                                data-placement="top"
                                onclick="return confirm('¿Estás seguro que deseas eliminar este registro?');"
                                title="Eliminar">
                                    <i class="fas fa-trash-alt"></i> Eliminar
                                </a>
                        </td>
                @endcan
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
