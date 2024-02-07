@if(count($employee->files)>0)
    <div class="row">
        @component('componentes.table')
            @slot('thead')
                <th>Tipo documento</th>
                <th>Documento</th>
            @endslot
            @slot('tbody')
                @foreach ($employee->files as $file)
                    <tr>
                        <td>{{ $file->name_original }}</td>
                        <td>
                            <a class="btn btn-info"
                                target="_blank"
                                href="{{ Storage::url($file->path) }}">
                                <i class="fas fa-file-download"></i>
                            </a>
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
