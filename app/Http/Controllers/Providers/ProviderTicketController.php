<?php

namespace App\Http\Controllers\Providers;

use App\Exports\Tickets\TicketsExport;
use App\Http\Controllers\Controller;
use App\Models\Customers\Customer;
use App\Models\Employees\Employee;
use App\Models\General\City;
use App\Models\General\Department;
use App\Models\General\Service;
use App\Models\General\TypeContact;
use App\Models\General\TypeDocument;
use App\Models\Providers\Provider;
use App\Models\Tickets\Ticket;
use App\Models\Tickets\TicketPriority;
use Illuminate\Http\Request;
use Session;

class ProviderTicketController extends Controller
{


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($providerId)
    {
        session::flash('tab','tickets');
        $provider= Provider::with('contacs','services')->findOrFail($providerId);
        $tabPanel='providerTicketsTabShow';
        $priorities=TicketPriority::get();
        $cities= City::get();
        $employees= Employee::get();
        $customers= Customer::get();
        $states=['Abierto','Cerrado'];
        $tickets = Ticket::whereHas('service', function($q) use($providerId) {
            return $q->where('customers_services.provider_id',$providerId);
        })->paginate();

        return view('modules.providers.show', compact(
            'provider',
            'tabPanel',
            'priorities',
            'cities',
            'employees',
            'customers',
            'states',
            'tickets'
        ));
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showSearch(Request $request,$providerId)
    {
        session::flash('tab','tickets');
        $provider= Provider::with('contacs','services')->findOrFail($providerId);
        $tabPanel='providerTicketsTabShow';
        $priorities=TicketPriority::get();
        $cities= City::get();
        $employees= Employee::get();
        $customers= Customer::get();
        $states=['Abierto','Cerrado'];
        $data= $request->all();
        $tickets= Ticket::buscar($data,$providerId,'providers');
        if ($request->action=='buscar') {
            $tickets = $tickets->paginate();
            return view('modules.providers.show', compact(
                'provider',
                'tabPanel',
                'priorities',
                'cities',
                'employees',
                'customers',
                'states',
                'tickets',
                'data'
            ));
        } else {
            $tickets = $tickets->get();
            return (new TicketsExport($tickets))->download('Proveedores_tickets.xlsx');
        }

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($providerId)
    {
        session::flash('tab','tickets');
        $provider= Provider::with('contacs','services')->findOrFail($providerId);
        $tabPanel='providerTicketsTabEdit';
        $priorities=TicketPriority::get();
        $cities= City::get();
        $employees= Employee::get();
        $customers= Customer::get();
        $states=['Abierto','Cerrado'];
        $tickets = Ticket::whereHas('service', function($q) use($providerId) {
            return $q->where('customers_services.provider_id',$providerId);
        })->paginate();

        return view('modules.providers.edit', compact(
            'provider',
            'tabPanel',
            'priorities',
            'cities',
            'employees',
            'customers',
            'states',
            'tickets'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editSearch(Request $request,$providerId)
    {
        session::flash('tab','tickets');
        $provider= Provider::with('contacs','services')->findOrFail($providerId);
        $tabPanel='providerTicketsTabEdit';
        $priorities=TicketPriority::get();
        $cities= City::get();
        $employees= Employee::get();
        $customers= Customer::get();
        $states=['Abierto','Cerrado'];
        $data=$request->all();
        $tickets= Ticket::buscar($data,$providerId,'providers');
        if ($request->action=='buscar') {
            $tickets = $tickets->paginate();
            return view('modules.providers.edit', compact(
                'provider',
                'tabPanel',
                'priorities',
                'cities',
                'employees',
                'customers',
                'states',
                'tickets',
                'data'
            ));
        } else {
            $tickets = $tickets->get();
            return (new TicketsExport($tickets))->download('Proveedores_tickets.xlsx');
        }
    }
}
