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
                        {{-- <td>
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
                         --}}

                        <td>
                            <a href="{{ route('employees.download.file', ['id' => $file->id]) }}" download>
                                {{ $file->name_original }}
                            </a>
                        </td>
                        <td>
                            @if (pathinfo($file->name_original, PATHINFO_EXTENSION) == 'pdf')
                                <button class="btn btn-info open-pdf-modal" 
                                data-path="{{ Storage::url($file->path) }}">
                                    <i class="fas fa-file-pdf"></i>
                                </button>

                            {{-- @elseif (pathinfo($file->name_original, PATHINFO_EXTENSION)) --}}
                            @elseif (in_array(strtolower(pathinfo($file->name_original, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif']))
                                <button class="btn btn-info open-image-modal" 
                                data-path="{{ Storage::url($file->path) }}">
                                    <i class="fas fa-file-image"></i>
                                </button>
                             @else
                            <a class="btn btn-info"
                                 target="_blank"
                                 href="{{ Storage::url($file->path) }}">
                                 <i class="fas fa-file-download"></i>
                            </a>
                            @endif
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


{{-- Script para Ejecutar la Modal para visualizar las imágenes y pdf --}}

<script>
    $(document).ready(function() {
        // Abrir modal para PDF
        $('.open-pdf-modal').click(function() {
            var pdfPath = $(this).data('path');
            $('#pdfViewer').attr('src', pdfPath);
            $('#pdfModal').modal('show');
        });

        // Abrir modal para imágenes
        $('.open-image-modal').click(function() {
            var imagePath = $(this).data('path');
            $('#imageViewer').attr('src', imagePath);
            $('#imageModal').modal('show');
        });
    });
</script>
