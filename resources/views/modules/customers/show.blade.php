@extends('layouts.app')
@section('title', 'Clientes')
@push('script')
    <script src="{{asset('assets/js/modules/Shared/cities.js')}}"></script>
@endpush
@section('content')

	@component('componentes.card',[
        'shadow' => true,
	    'title' => 'Ver cliente '.$customer->name,
	    'breadcrumb' => 'customers/show',
        'dataBreadcrumb' => ['id' => $customer->id] ])

            {{-- tabs--}}
            @include('modules.customers.partials.tab',[
                'urlnfo' => route('customers.show',$customer->id),
                'urlServices' => route('customers.services.show',['customerId'=>$customer->id ]),
                'urlTickets' => route('customers.tickets.show',['customerId'=>$customer->id ]),
                'urlUsers'=> route('customers.users.show',['customerId'=>$customer->id ]),
            ])

            <!-- Tab panes -->
            @include('modules.customers.partials.show.tabPanel.'.$tabPanel)
     @endcomponent
@endsection
