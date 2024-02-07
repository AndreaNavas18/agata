@extends('layouts.app')
@section('title', 'Proveedores')
@push('script')
@endpush
@section('content')

	@component('componentes.card',[
        'shadow' => true,
	    'title' => 'Ver proveedor '.$provider->name,
	    'breadcrumb' => 'providers/show',
        'dataBreadcrumb' => ['id' => $provider->id] ])


        {{-- tabs--}}
        @include('modules.providers.partials.tab',[
            'urlnfo' => route('providers.show',$provider->id),
            'urlServices' => route('providers.services.show',['providerId'=>$provider->id ]),
            'urlTickets' => route('providers.tickets.show',['providerId'=>$provider->id ]),
        ])

        <!-- Tab panes -->
        @include('modules.providers.partials.show.tabPanel.'.$tabPanel)

    @endcomponent
@endsection
