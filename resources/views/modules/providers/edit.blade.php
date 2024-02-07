@extends('layouts.app')
@section('title', 'Proveedores')

@push('script')
    {{-- validación form --}}
    <script src="{{asset('assets/js/modules/Shared/contact.js')}}"></script>
    <script src="{{asset('assets/js/modules/Shared/services.js')}}"></script>
    <script src="{{asset('assets/js/modules/Shared/cities.js')}}"></script>
    <script>
        $(document).ready(function() {
            @if(Session::has('tab'))
                $('.notificaciones').show();
                $(".nav-tabs a.{{ Session::get('tab') }}").tab('show');
            @endif
        });
    </script>
@endpush
@section('content')

	@component('componentes.card',[
        'shadow' => true,
	    'title' => 'Editar proveedor '.$provider->name,
	    'breadcrumb' => 'providers/edit',
        'dataBreadcrumb' => [
            'id' => $provider->id ]])


        {{-- tabs--}}
        @include('modules.providers.partials.tab',[
            'urlnfo' => route('providers.edit',$provider->id),
            'urlServices' => route('providers.services.index',['providerId'=>$provider->id ]),
            'urlTickets' => route('providers.tickets.edit',['providerId'=>$provider->id ]),
        ])

        {{-- inputs ocultos --}}
        <input type="hidden"
            id="cities"
            value="{{$cities}}">

        <!-- Tab panes -->
        <div class="mt-5">
            @include('modules.providers.partials.edit.tabPanel.'.$tabPanel)
        </div>
    @endcomponent
@endsection
