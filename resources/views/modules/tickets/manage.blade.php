@extends('layouts.app')
@section('title', 'Gestionar ticket')
@push('css')
<style>
    .chat-messages {
        display: flex;
        flex-direction: column;
        max-height: 800px;
        overflow-y: scroll
    }

    .chat-message-left,
    .chat-message-right {
        display: flex;
        flex-shrink: 0;
        width: 100%;
    }

    .chat-message-left {
        margin-right: auto
    }

    .chat-message-right {
        flex-direction: row-reverse;
        margin-left: auto
    }

    .py-3 {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }

    .px-4 {
        padding-right: 1.5rem !important;
        padding-left: 1.5rem !important;
    }

    .flex-grow-0 {
        flex-grow: 0 !important;
    }

    .border-top {
        border-top: 1px solid #dee2e6 !important;
    }

    .ck-editor__editable[role="textbox"] {
        /* editing area */
        min-height: 300px;
    }

</style>
@endpush
@push('script')
<script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>

    <script>
        /* initialization of different variables
        to be used in Count-Up App*/
        var clearTime;
        var seconds = {{ $secondsClock }},
        minutes = {{ $minutesClock }},
        hours = {{ $hoursClock }};
        var secs, mins, gethours;

        function startWatch() {
        /* check if seconds is equal to 60 and add a +1
            to minutes, and set seconds to 0 */
        if (seconds === 60) {
            seconds = 0;
            minutes = minutes + 1;
        }

        /* i used the javascript tenary operator to format
            how the minutes should look and add 0 to minutes if
            less than 10 */
        mins = minutes < 10 ? "0" + minutes  : minutes  ;
        /* check if minutes is equal to 60 and add a +1
            to hours set minutes to 0 */
        if (minutes === 60) {
            minutes = 0;
            hours = hours + 1;
        }
        /* i used the javascript tenary operator to format
            how the hours should look and add 0 to hours if less than 10 */
        gethours = hours < 10 ? "0" + hours : hours ;
        secs = seconds < 10 ? "0" + seconds : seconds;


        /* display the Count-Up Timer */
        var clockHour = document.getElementById("clockHour");
        clockHour.innerHTML = gethours;
        //minutes
        var clockMinute = document.getElementById("clockMinute");
        clockMinute.innerHTML = mins;
        //seconds
        var clockSecond = document.getElementById("clockSecond");
        clockSecond.innerHTML = secs;

        /* call the seconds counter after displaying the Count-Up
            and increment seconds by +1 to keep it counting */
        seconds++;

        /* call the setTimeout( ) to keep the Count-Up alive ! */
        clearTime = setTimeout("startWatch( )", 1000);
        }

        window.addEventListener("load", function() {
            startWatch();
        });
        /*********** End of Continue Button Operations *********/
        $('#state').on('change', function() {
            value= $(this).val();
            if (value=='Cerrado') {
                $('#state_clock').val('Detenido').prop('disabled', true);
            } else {
                $('#state_clock').prop('disabled', false);
            }
        })
        $('.addVisit').on('click', function() {
            var replieId = $(this).attr('data-replieId');
            $('#formVisit').trigger("reset");
            $('#ticket_replie_id').val(replieId);
            $('#modalVisit').modal('show');
        })
        $('form#formVisit').submit(function(e) {
            e.preventDefault();
            var $form = $('#formVisit')[0];
            if ($form.checkValidity()) {
                openLoader();
                $form.submit();
            }
            else {
                closeLoader();
            }
        });
        ClassicEditor
    .create(document.querySelector('#editor'), {
        // Configuración personalizada
        // Aquí agregamos el height personalizado
        height: '500px',
    })
    .then(editor => {
        console.log(editor);
    })
    .catch(error => {
        console.error(error);
    });


    </script>
@endpush
@section('content')

    <!-- page-header -->
    <div class="page-header">
        <ol class="breadcrumb">
            <!-- breadcrumb -->
            <li class="breadcrumb-item">
                <a href="{{  Auth()->user()->role_id!=2 ? route('customer.home') : route('home') }}">
                    Inicio
                </a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('tickets.index') }}">Tickets</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gestionar ticket</li>
        </ol><!-- End breadcrumb -->
        <div class="ml-auto">
            <a href="{{ route('tickets.show', $ticket->id) }}"
                class="btn btn-primary text-white"
                data-toggle="tooltip"
                title=""
                data-placement="top"
                data-original-title="Ver información ticket"
                target="_blank">
                <span>
                    <i class="fas fa-info-circle"></i>
                </span>
            </a>
            <a href="{{ route('tickets.edit', $ticket->id) }}"
                class="btn btn-success text-white"
                data-toggle="tooltip"
                title=""
                data-placement="top"
                data-original-title="Editar ticket"
                target="_blank">
                <span>
                    <i class="fa fa-edit"></i>
                </span>
            </a>
            @if(Auth()->user()->role_id!=2)
                <a href="{{ route('customers.show', $ticket->customer_id) }}"
                    class="btn btn-warning text-white"
                    data-toggle="tooltip"
                    title=""
                    data-placement="top"
                    data-original-title="Ver información cliente"
                    target="_blank">
                    <span>
                        <i class="fas fa-user-shield"></i>
                    </span>
                </a>
            @endif
            @if($ticket->service->provider && Auth()->user()->role_id!=2)
                <a href="{{ route('providers.show', $ticket->service->provider_id) }}"
                    class="btn btn-info text-white"
                    data-toggle="tooltip"
                    title=""
                    data-placement="top"
                    data-original-title="Ver información proveedor"
                    target="_blank">
                    <span>
                        <i class="fas fa-user"></i>
                    </span>
                </a>
            @endif
        </div>
    </div>

    <!-- End page-header -->
    <div class="row mb-4">
        <div class="col-md-8">
            <span class="badge {{ $ticket->priority->color }}">
                {{ $ticket->priority->name }}
            </span>
            <span class="badge {{ $ticket->state=='Abierto' ? 'bg-danger' : 'bg-success' }}">
                {{ $ticket->state }}
            </span>
        </div>

        <div class="col-md-4">
            @if($ticket->priority_id==1)
                @include('modules.tickets.partials.clock')
            @endif
        </div>
    </div>

    {{-- panel--}}
    <div class="row">
        {{-------------
        left
        -------------}}
        <div class="col-md-8">

            @component('componentes.card', ['title' => 'Detalle ticket'])
            {{-- detalle del ticket--}}
            @include('modules.tickets.partials.ticketDetail')
            @endcomponent
            <div class="card">
                <div class="row g-0">

                    <div class="col-12">
                        <div class="py-2 px-4 border-bottom d-none d-lg-block">
                            <div class="d-flex align-items-center py-1">
                                <div class="position-relative">
                                    <img src="{{ asset('assets/images/respuestas.png') }}"
                                        class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                </div>
                                <div class="flex-grow-1 pl-3">
                                    <strong>Respuestas ticket</strong>
                                </div>
                            </div>
                        </div>

                        <div class="position-relative">
                            <div class="chat-messages p-4">
                                @if(count($ticket->replies)==0)
                                    <div class="alert alert-info" role="alert">
                                        <strong>Este ticket no tiene respuestas</strong>
                                    </div>
                                @else
                                    @foreach ($ticket->replies as $reply)
                                        @include('modules.tickets.partials.answersTicket',['reply' =>$reply])
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        @if ($ticket->state=='Abierto')
                            <div class="flex-grow-0 py-3 px-4 border-top">
                                <div class="d-flex align-items-center py-1">
                                    <div class="position-relative">
                                        <img src="{{ asset('assets/images/respuesta.ico') }}"
                                            class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                    </div>
                                    <div class="flex-grow-1 pl-3">
                                        <strong>Nueva respuesta</strong>
                                    </div>
                                </div>
                                <div class="border-bottom mb-5"></div>
                                @include('modules.tickets.partials.answerNew')
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-------------
        right
        -------------}}
        <div class="col-md-4">
            @include('modules.tickets.partials.ticketInfo')

            @include('modules.tickets.partials.visits')
        </div>
    </div>
    @if(Auth()->user()->role_id!=2)
        <div>
            <div class="modal fade" id="modalVisit" tabindex="-1" role="dialog" aria-hidden="true">
                <form action="{{ route('tickets.visits.store', ['ticketId' =>$ticket->id]) }}"
                    method="POST"
                    id="formVisit">
                    @csrf
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Visita técnica</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12 mb-4">
                                        @component('componentes.label', [
                                        'title' => 'Técnicos',
                                        'required' => false])
                                        @endcomponent
                                        <select class="form-control selectpicker"
                                            name="technicals[]"
                                            id="technicals[]"
                                            multiple
                                            data-width="100%">
                                            <option value="">--Seleccione--</option>
                                            @foreach($technicals as $technical)
                                            <option value="{{ $technical->id }}">
                                                {{ $technical->short_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-12 mb-4">
                                        @component('componentes.label', [
                                        'title' => 'Fecha del servicio',
                                        'required' => true])
                                        @endcomponent
                                        <input
                                            type="text"
                                            class="form-control fecha"
                                            name="date"
                                            id="date"
                                            required>
                                    </div>
                                    <div class="col-sm-12 mb-4">
                                        @component('componentes.label', [
                                        'title' => 'Descripción',
                                        'id' => 'description ',
                                        'required' => true])
                                        @endcomponent
                                        <textarea
                                            class="form-control"
                                            name="description"
                                            id="description"
                                            rows="5"
                                            required></textarea>
                                    </div>
                                    <input type="hidden" value="" name="ticket_replie_id" id="ticket_replie_id">
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal">
                                    <i class="fas fa-times"></i> Cancelar
                                </button>
                                <button class="btn btn-primary btn-sm"
                                    type="submit">
                                    <i class="fas fa-save"></i>
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endsection
