@extends('layouts.app')
@section('title', 'Clientes')
@push('script')
    {{-- validación form --}}
    <script src="{{asset('assets/js/modules/Shared/contact.js')}}"></script>
    <script src="{{asset('assets/js/modules/Shared/services.js')}}"></script>
    <script src="{{asset('assets/js/modules/Shared/cities.js')}}"></script>
    <script src="{{asset('assets/js/modules/Shared/customerUsers.js')}}"></script>
    <script src="{{asset('assets/js/modules/Shared/proyectos.js')}}" defer></script>
    <script>
        $(document).ready(function() {
            @if(Session::has('tab'))
                $('.notificaciones').show();
                $(".nav-tabs a.{{ Session::get('tab') }}").tab('show');
            @endif
        });
    </script>
    <script>
        $(document).ready(function() {
            // Manejar el clic en el botón para abrir el formulario
            $('#botonAbrirFormulario').click(function() {
                // Ocultar todos los campos que no tienen la clase 'filtro-proyecto'
                $('.row > div:not(.filtro-proyecto)').hide();
                // Mostrar los campos que tienen la clase 'filtro-proyecto'
                $('.filtro-proyecto').show();
            });
            console.log('ready');
        });
    </script>

    
@endpush
@section('content')

	@component('componentes.card',[
        'shadow' => true,
	    'title' => 'Editar cliente '.$customer->name,
	    'breadcrumb' => 'customers/edit',
        'dataBreadcrumb' => [ 'id' => $customer->id ]])

        {{-- tabs--}}
        @include('modules.customers.partials.tab',[
            'urlnfo' => route('customers.edit',$customer->id),
            'urlServices' => route('customers.services.index',['customerId'=>$customer->id ]),
            'urlProyectos' => route('customers.proyectos.index',['customerId'=>$customer->id ]),
            'urlTickets' => route('customers.tickets.edit',['customerId'=>$customer->id ]),
            'urlUsers' => route('customers.users.index',['customerId'=>$customer->id ]),
        ])

        {{-- inputs ocultos --}}
        @isset($cities)
            <input type="hidden"
                id="cities"
                value="{{$cities}}">
        @endisset

        <div class="mt-5">
            <!-- Tab panes -->
            @include('modules.customers.partials.edit.tabPanel.'.$tabPanel)
        </div>
     @endcomponent
@endsection
