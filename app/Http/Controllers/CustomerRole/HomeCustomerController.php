<?php

namespace App\Http\Controllers\CustomerRole;

use App\Http\Controllers\Controller;
use App\Models\Customers\CustomerService;
use App\Models\Tickets\Ticket;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;


class HomeCustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function index()
    {
        if(auth()->user()->role_id!=2){
            DB::rollBack();
            Alert::error('Error', 'Modulo solo es accesible para los clientes.');
            return redirect()->back();
        }

        $customerId=auth()->user()->customer_id;
        $ticketsOpen=Ticket::state('Abierto')->customerId($customerId)->count();
        $ticketsClosed=Ticket::state('Cerrado')->customerId($customerId)->count();
        $ticketsPending=Ticket::state('abierto')->customerId($customerId)->doesntHave('replies')->count();
        $totalServicesInternet= CustomerService::serviceId(1)->customerId($customerId)->count();
        return view('customerRole.home', compact(
            'ticketsOpen',
            'ticketsClosed',
            'ticketsPending',
            'totalServicesInternet'
        ));
    }
}
