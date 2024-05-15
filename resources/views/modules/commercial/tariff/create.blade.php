@extends('layouts.app')
@section('title', 'Nuevo Tarifa')
    @push('script')
    <script src="{{ asset('assets/js/modules/Tickets/tickets.js') }}"></script>
    @endpush
@section('content')

    @component('componentes.card', [
        'shadow' => true,
        'title' => 'Nueva Tarifa',
        'breadcrumb' => 'commercial/tariff/crear',
    ])


        <form method="POST" action="{{ route('tariff.store') }}">
            @csrf()

            {{-- formulario --}}
            @include('modules.commercial.tariff.partials.form')

            {{-- contenedor para campos adicionales --}}
            <div id="additionalFieldsContainer"></div>

            {{-- acciones --}}
            @component('componentes.acciones')
            @endcomponent

            {{-- @component('componentes.add')
            @endcomponent --}}

            {{-- botón para agregar campos adicionales --}}
            <button type="button" class="btn btn-primary btn-sm" id="addFieldsButton">
                <i class="fas fa-add"></i> Agregar campos
            </button>


        </form>
        
                <script >
                            $(document).ready(function() {
                                    $('#addFieldsButton').click(function() {
                                    $.get('{{ route('tariff.addCampos') }}', function(data) {
                                    $('#additionalFieldsContainer').append(data);
                                    $('.selectpicker').selectpicker(); // Inicializa los selectores
                                    // Agrega un botón de eliminar a cada nuevo formulario
                            $('#additionalFieldsContainer').children('div.row').each(function() {
                                $(this).append('<button class="btn btn-danger removeFieldsButton">Eliminar</button>');
                            });
                        });
                    });
                });
        </script>

            {{-- <script>
$(document).ready(function() {
    $('#addFieldsButton').click(function() {
        $.get('{{ route('tariff.addCampos') }}', function(data) {
            // Agrega el formulario al contenedor
            $('#additionalFieldsContainer').append(data);
            // Inicializa los selectores
            $('.selectpicker').selectpicker();
            // Agrega un botón de eliminar solo si no existe uno dentro del formulario
            $('#additionalFieldsContainer').children('div.row').last().append('<button class="btn btn-danger removeFieldsButton">Eliminar</button>');
        });
    });

    // Agrega un listener de eventos para los botones de eliminar
    $('#additionalFieldsContainer').on('click', '.removeFieldsButton', function() {
        // Elimina el div que contiene el formulario y el botón de eliminar
        $(this).closest('div.row').remove();
    });
});


            </script> --}}



    @endcomponent
@endsection
