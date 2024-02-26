<?php

namespace App\Http\Controllers\Customers;

use App\Exports\Tickets\TicketsExport;
use App\Http\Controllers\Controller;
use App\Models\Customers\Customer;
use App\Models\Employees\Employee;
use App\Models\General\City;
use App\Models\General\Service;
use App\Models\Providers\Provider;
use App\Models\Tickets\Ticket;
use App\Models\Tickets\TicketPriority;
use Illuminate\Http\Request;
use App\Models\Customers\CustomerService;
use Session;

class CustomerTicketController extends Controller
{


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($customerId)
    {
        session::flash('tab','tickets');
        $customer= Customer::findOrFail($customerId);
        $tabPanel='customerTicketsTabShow';
        $priorities= TicketPriority::get();
        $employees= Employee::get();
        $providers= Provider::get();
        $states=['Abierto','Cerrado'];
        $tickets= Ticket::customerId($customerId)->paginate();
        return view('modules.customers.show', compact(
            'customer',
            'tabPanel',
            'priorities',
            'employees',
            'providers',
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
    public function showSearch(Request $request,$customerId)
    {
        session::flash('tab','tickets');
        $customer= Customer::findOrFail($customerId);
        $tabPanel='customerTicketsTabShow';
        $priorities= TicketPriority::get();
        $employees= Employee::get();
        $providers= Provider::get();
        $states=['Abierto','Cerrado'];
        $data=$request->all();
        $tickets= Ticket::buscar($data,$customerId,'customers');
        if ($request->action=='buscar') {
            $tickets = $tickets->paginate();
            return view('modules.customers.show', compact(
                'customer',
                'tabPanel',
                'priorities',
                'employees',
                'providers',
                'states',
                'tickets'
            ));
        } else {
            $tickets = $tickets->get();
            return (new TicketsExport($tickets))->download('Clientes_tickets.xlsx');
        }

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($customerId)
    {
        session::flash('tab','tickets');
        $customer= Customer::findOrFail($customerId);
        $customerServices = CustomerService::get();
        $tabPanel='customerTicketsTabEdit';
        $priorities= TicketPriority::get();
        $employees= Employee::get();
        $providers= Provider::get();
        $states=['Abierto','Cerrado'];
        $tickets= Ticket::customerId($customerId)->paginate();
        return view('modules.customers.edit', compact(
            'customer',
            'tabPanel',
            'priorities',
            'employees',
            'providers',
            'states',
            'tickets',
            'customerServices'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editSearch(Request $request,$customerId)
    {
        session::flash('tab','tickets');
        $customer= Customer::findOrFail($customerId);
        $tabPanel='customerTicketsTabEdit';
        $priorities= TicketPriority::get();
        $employees= Employee::get();
        $providers= Provider::get();
        $states=['Abierto','Cerrado'];
        $data=$request->all();
        $tickets= Ticket::buscar($data,$customerId,'customers');
        if ($request->action=='buscar') {
            $tickets = $tickets->paginate();
            return view('modules.customers.edit', compact(
                'customer',
                'tabPanel',
                'priorities',
                'employees',
                'providers',
                'states',
                'tickets',
                'data'
            ));
        } else {
            $tickets = $tickets->get();
            return (new TicketsExport($tickets))->download('Clientes_tickets.xlsx');
        }
    }
}
