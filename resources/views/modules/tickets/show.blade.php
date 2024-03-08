@extends('layouts.app')
@section('title', 'Ticket')
@push('script')
@endpush

@section('content')

@if(Auth()->user()->role_id != 2)

    {{-- Contenido para otros roles --}}

	@component('componentes.card',[
        'shadow' => true,
	    'title' => 'Ver ticket '.($ticket->consecutive ?? $ticket->id),
	    'breadcrumb' => 'tickets/show',
        'dataBreadcrumb' => ['id' =>$ticket->id ] ])

        <div class="card-border">
            <h4><strong>Información ticket</strong></h4>
            <div class="card-border">
                <div class="row">
                    <div class="col-md-3 mb-4">
                        @component('componentes.label', [
                            'title' => 'Consecutivo',
                            'required' => false])
                        @endcomponent
                        <div>
                            {{  $ticket->id }}
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        @component('componentes.label', [
                            'title' => 'Fecha',
                            'required' => false])
                        @endcomponent
                        <div>
                            {{  $ticket->date }}
                        </div>
                    </div>
                    @if(!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
                        <div class="col-md-3 mb-4">
                            @component('componentes.label', [
                                'title' => 'Departamento cargo',
                                'required' => false])
                            @endcomponent
                            <div>
                                {{  $ticket->department ? $ticket->department->name : '' }}
                            </div>
                        </div>
                    
                        <div class="col-md-3 mb-4">
                            @component('componentes.label', [
                                'title' => 'Agente',
                                'required' => false])
                            @endcomponent
                            <div>
                                {{ $ticket->employee ? $ticket->employee->short_name : 'No hay agente asignado' }}
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            @component('componentes.label', [
                                'title' => 'Cliente',
                                'required' => false])
                            @endcomponent
                            <div>
                                {{   $ticket->customer->name }}
                            </div>
                        </div>
                    @endif
                    @if(!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
                        <div class="col-md-3 mb-4">
                            @component('componentes.label', [
                                'title' => 'Tipo instalacion',
                                'required' => false])
                            @endcomponent
                            <div>
                                {{   $ticket->service->installation_type }}
                            </div>
                        </div>
                    @endif
                    <div class="col-md-3 mb-4">
                        @component('componentes.label', [
                            'title' => 'Tipo servicio',
                            'required' => false])
                        @endcomponent
                        <div>
                            {{   $ticket->service->service->name }}
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        @component('componentes.label', [
                            'title' => 'Descripción servicio',
                            'required' => false])
                        @endcomponent
                        <div>
                            {{   $ticket->service->description }}
                        </div>
                    </div>
                    @if(!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
                        <div class="col-md-3 mb-4">
                            @component('componentes.label', [
                                'title' => 'Proveedor',
                                'required' => false])
                            @endcomponent
                            <div>
                                {{  $ticket->service->provider ?  $ticket->service->provider->name : '---' }}
                            </div>
                        </div>
                    @endif
                    <div class="col-md-3 mb-4">
                        @component('componentes.label', [
                            'title' => 'Ciudad',
                            'required' => false])
                        @endcomponent
                        <div>
                            {{  $ticket->service->city->name }}
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        @component('componentes.label', [
                            'title' => 'Estado reloj',
                            'required' => false])
                        @endcomponent
                        <div>
                            <span class="badge bg-{{  $ticket->state_clock=='Corriendo' ? 'danger' : 'success' }}">
                                {{  $ticket->state_clock }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        @component('componentes.label', [
                            'title' => 'Tiempo reloj',
                            'required' => false])
                        @endcomponent
                        <div>
                            00
                        </div>
                    </div>
                    @if(!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
                        <div class="col-md-3 mb-4">
                            @component('componentes.label', [
                                'title' => 'Prioridad',
                                'required' => false])
                            @endcomponent
                            <div>
                                <span class="badge bg-{{ $ticket->priority->color }}">
                                    {{  $ticket->priority->name }}
                                </span>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-3 mb-4">
                        @component('componentes.label', [
                            'title' => 'Estado ticket',
                            'required' => false])
                        @endcomponent
                        <div>
                            <span class="badge bg-{{  $ticket->state=='Abierto' ? 'danger' : 'success' }}">
                                {{  $ticket->state }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        @component('componentes.label', [
                            'title' => 'Fecha creación',
                            'required' => false])
                        @endcomponent
                        <div>
                            {{ $ticket->created_at }}
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        @component('componentes.label', [
                            'title' => 'Asunto',
                            'required' => false])
                        @endcomponent
                        <textarea disabled class="form-control">{{  $ticket->ticket_issue }}</textarea>
                    </div>
                    <div class="col-md-12 mb-4">
                        @component('componentes.label', [
                            'title' => 'Descripción ticket',
                            'required' => false])
                        @endcomponent
                        <textarea disabled class="form-control">{{  $ticket->description }}</textarea>
                    </div>
                </div>
            </div>
        </div>
     @endcomponent
     @else

     {{-- Contenido específico para el rol_id = 2 --}}
     @include('modules.tickets.s2')
 
 @endif
@endsection
