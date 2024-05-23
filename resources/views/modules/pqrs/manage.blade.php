@extends('layouts.app')
@section('title', 'Ticket')
@push('script')
@endpush

@section('content')

	@component('componentes.card',[
        'shadow' => true,
	    'title' => 'Ver Pqr'. ' - ' .($pqr->tema ? $pqr->tema->name : 'No se asignó tema'),
	    'breadcrumb' => 'pqrs/show',
        'dataBreadcrumb' => ['id' =>$pqr->id ] ])

        <div class="card-border">
            <h4><strong>Información PQRS</strong></h4>
            <div class="card-border">
                <div class="row">
                    <div class="col-md-12 mb-4">
                        @component('componentes.label', [
                            'title' => 'Asunto',
                            'required' => false])
                        @endcomponent
                        <textarea disabled class="form-control">{{  $pqr->issue }}</textarea>
                    </div>
                    <div class="col-md-12 mb-4">
                        @component('componentes.label', [
                            'title' => 'Descripción PQRS',
                            'required' => false])
                        @endcomponent
                        <textarea disabled class="form-control">{{  $pqr->description }}</textarea>
                    </div>
                    <div class="col-md-3 mb-4">
                        @component('componentes.label', [
                            'title' => 'Creado por',
                            'required' => false])
                        @endcomponent
                        <div>
                            {{  $pqr->user ? $pqr->user->name : 'No se especificó' }}
                        </div>
                    </div>
                        <div class="col-md-3 mb-4">
                            @component('componentes.label', [
                                'title' => 'Estado del PQR',
                                'required' => false])
                            @endcomponent
                            <div>
                                <span class="badge bg-{{  $pqr->status=='Pendiente' ? 'danger' : 'success' }}">
                                    {{  $pqr->status }}
                                </span>
                            </div>
                        </div>
                    
                        <div class="col-md-3 mb-4">
                            @component('componentes.label', [
                                'title' => 'Tema',
                                'required' => false])
                            @endcomponent
                            <div>
                                {{ $pqr->tema ? $pqr->tema->name : 'No se asignó tema' }}
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="card-border">
            <h4><strong>Indexes PQRS</strong></h4>
            <div class="card-border">
                <div class="row">
                    <div class="col-md-3 mb-4">
                        @component('componentes.label', [
                            'title' => 'Ticket',
                            'required' => false])
                        @endcomponent
                        <div>
                            @if($pqr->ticket)
                                <a href="{{ url('tickets/gestionar/' . $pqr->ticket->id) }}" target="_blank">{{ $pqr->ticket->ticket_issue }} {{ $pqr->ticket->consecutive }}</a>
                            @else
                                No se especificó
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        @component('componentes.label', [
                            'title' => 'Departamento',
                            'required' => false])
                        @endcomponent
                        <div>
                            {{   $pqr->department ? $pqr->department->name : 'No se especificó' }}
                        </div>
                    </div>
                    
                    <div class="col-md-3 mb-4">
                        @component('componentes.label', [
                            'title' => 'Servicio',
                            'required' => false])
                        @endcomponent
                        <div>
                            @if($pqr->service)
                                <a href="{{ url('servicios/show/' . $pqr->service->id) }}" target="_blank">{{ $pqr->service->name }}</a>
                            @else
                                No se especificó
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        @component('componentes.label', [
                            'title' => 'Proveedor',
                            'required' => false])
                        @endcomponent
                        <div>
                            @if($pqr->provider)
                                <a href="{{ url('proveedores/ver/' . $pqr->provider->id) }}" target="_blank">{{ $pqr->provider->name }}</a>
                            @else
                                No se especificó
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        @component('componentes.label', [
                            'title' => 'Cliente',
                            'required' => false])
                        @endcomponent
                        <div>
                            @if($pqr->customer)
                                <a href="{{ url('clientes/ver/' . $pqr->customer->id) }}" target="_blank">{{ $pqr->customer->name }}</a>
                            @else
                                No se especificó
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        @component('componentes.label', [
                            'title' => 'Empleado (a)',
                            'required' => false])
                        @endcomponent
                        <div>
                            @if($pqr->employee)
                                <a href="{{ url('empleados/ver/' . $pqr->employee->id) }}" target="_blank">{{ $pqr->employee->full_name }}</a>
                            @else
                                No se especificó
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        @component('componentes.label', [
                            'title' => 'Proyecto',
                            'required' => false])
                        @endcomponent
                        <div>
                            @if($pqr->project)
                                <a href="{{ url('proyectos/show/' . $pqr->project->id) }}" target="_blank">{{ $pqr->project->name }}</a>
                            @else
                                'No se especificó'
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-3 mb-4">
                        @component('componentes.label', [
                            'title' => 'Fecha creación',
                            'required' => false])
                        @endcomponent
                        <div>
                            {{ $pqr->created_at }}
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
     @endcomponent
@endsection
