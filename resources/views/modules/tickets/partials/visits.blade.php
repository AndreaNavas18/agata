<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-10">
                <h4 class="card-title">Visitas tecnicas</h4>
            </div>
            @if(!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
                <div class="col-2 float-right">
                    <button
                        class="btn btn-success btn-sm text-white addVisit"
                        data-toggle="tooltip"
                        title=""
                        data-placement="top"
                        data-original-title="Nueva visita tecnica"
                        type="button"
                        data-replieId="{{ $lastReplyId->id }}">
                        <span>
                            <i class="fa fa-plus"></i>
                        </span>
                    </button>
                </div>
            @endif
        </div>

    </div>
    <div class="card-body">
        @if (count($ticket->ticketsVisits)>0)
            @foreach ($ticket->ticketsVisits as $ticketVisit)
                <div
                    data-toggle="tooltip"
                    title=""
                    data-placement="top"
                    data-original-title=" {{ $ticketVisit->description }}"
                    class="pointer border-top-cs">
                    @if (count($ticketVisit->employees)>0)
                        <div>
                            <b>Empleados agendados:</b>
                            <span class="ml-2">
                                @foreach ($ticketVisit->employees as $employeeT)
                                    </br> {{ $employeeT->short_name }} 
                                    {{-- &nbsp; --}}
                                @endforeach
                            </span>
                        </div>
                    @else
                        <div>
                            <b>Visita:</b>
                            <span class="ml-2">
                               Tercerizada
                            </span>
                        </div>
                    @endif
                    <div>
                        <b>Fecha:</b>
                            @php
                                $partes = explode(" ", $ticketVisit->date);
                                $fecha = $partes[0];
                                $hora = $partes[1];
                            @endphp
                        <span class="ml-2">
                            {{ $fecha }}
                        </span>
                    </div>
                    <div>
                        <b>Hora:</b>
                        <span class="ml-2">
                            
                            {{ $hora }}
                        </span>
                    </div>
                    {{-- Si hay archivos que los muestre --}}
                    @if(count($ticketVisit->ticketvisitfiles)>0)
                        <div class="row">
                            @component('componentes.table')
                                @slot('thead')
                                    <th>Documentos adjuntos:</th>
                                    <th></th>
                                @endslot
                                @slot('tbody')
                                    @foreach ($ticketVisit->ticketvisitfiles as $file)
                                        <tr>
                                            <td>
                                                @if (pathinfo($file->name_original, PATHINFO_EXTENSION) == 'pdf')
                                                <a class="btn btn-info open-pdf-modal"
                                                    data-toggle="modal"
                                                    data-target="#pdfModal"
                                                    data-original-title= "{{ $ticketVisit->name_original }}"
                                                    data-path="{{ Storage::url($file->path) }}" >
                                                    <i class="fas fa-file-download" style='color:white;'></i>

                                                    @elseif (in_array(strtolower(pathinfo($file->name_original, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif']))
                                                    <a class="btn btn-info"
                                                    {{-- target="_blank"
                                                    href="{{ Storage::url($file->path) }}"
                                                    data-original-title= "{{ $ticketVisit->name_original }}" > --}}
                                                    data-toggle="modal"
                                                    data-target="#imageModal"
                                                    data-original-title= "{{ $ticketVisit->name_original }}"
                                                    data-image-url="{{ Storage::url($file->path) }}" >
                                                    <i class="fas fa-file-download" style='color:white;'></i>
                                                </a>
                                                
                                                @else
                                                <a class="btn btn-info"
                                                    target="_blank"
                                                    href="{{ Storage::url($file->path) }}">
                                                    <i class="fas fa-file-download" style='color:white;'></i>
                                            </a>
                                            @endif
                                            </td>
                                            <td>
                                                <span> 
                                                    {{ $file->name_original }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endslot
                            @endcomponent
                        </div>
                    @endif
                </div>
            @endforeach
        @else
            <em>No hay información</em>
        @endif
    </div>
</div>


{{-- Script para Ejecutar la Modal para visualizar las imágenes y pdf --}}
<script>
    $(document).ready(function() {
        // Captura el evento de clic en los enlaces con la clase .btn
        $('.btn').on('click', function() {
            var imageUrl = $(this).data('image-url'); // Obtiene la URL de la imagen del atributo data-image-url
            $('#imageViewer').attr('src', imageUrl); // Actualiza la fuente de la imagen en el modal
        });
         // Abrir modal para PDFs
         $('.open-pdf-modal').on('click', function() {
            var pdfUrl = $(this).data('path');
            $('#pdfViewer').attr('src', pdfUrl);
        });
    });
</script>


<div>
    @include('componentes.modalFiles')
</div>