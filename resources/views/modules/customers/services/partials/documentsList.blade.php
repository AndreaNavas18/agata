@if(count($service->files)>0)
    <div class="row">
        @component('componentes.table')
            @slot('thead')
                <th>Tipo documento</th>
                <th>Documento</th>
            @endslot
            @slot('tbody')
                @foreach ($service->files as $file)
                    <tr>
                        <td>{{ $file->name_original }}</td>
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

