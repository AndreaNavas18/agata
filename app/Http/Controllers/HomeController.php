<?php

namespace App\Http\Controllers;

use App\Models\Customers\Customer;
use App\Models\Customers\CustomerService;
use App\Models\Employees\Employee;
use App\Models\Providers\Provider;
use App\Models\Tickets\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;



class HomeController extends Controller
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
        // if(auth()->user()->role_id==2){
        //     DB::rollBack();
        //     Alert::error('Error', 'No tienes acceso para ingresar.');
        //     return redirect()->back();
        // }

        $ticketsOpen=Ticket::state('Abierto')->count();
        $ticketsClosed=Ticket::state('Cerrado')->count();
        $ticketsPending=Ticket::state('abierto')->doesntHave('replies')->count();
        $totalCustomers=Customer::count();
        $tottalEmployees= Employee::count();
        $totalProviders= Provider::count();
        $totalServicesInternet= CustomerService::serviceId(1)->count();
        return view('home', compact(
            'ticketsOpen',
            'ticketsClosed',
            'ticketsPending',
            'totalCustomers',
            'tottalEmployees',
            'totalProviders',
            'totalServicesInternet'
        ));
    }
}
