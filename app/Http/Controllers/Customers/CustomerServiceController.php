<?php

namespace App\Http\Controllers\Customers;

use App\Exports\CustomerServices\CustomerServicesExport;
use App\Exports\Services\ServicesExport;
use App\Http\Controllers\Controller;
use App\Models\Customers\Customer;
use App\Models\Customers\CustomerService;
use App\Models\Employees\Employee;
use App\Models\General\City;
use App\Models\General\Country;
use App\Models\General\Department;
use App\Models\General\Service;
use App\Models\Providers\Provider;
use App\Models\Tickets\Ticket;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerServiceController extends Controller
{

    public function indexAll() {
        $servicesList=Service::get();
        $customers= Customer::with('customerContacs','customerServices')->get();
        $countries= Country::get();
        $departments= Department::get();
        $cities=City::get();
        $customerServices= CustomerService::paginate();
        $typesInstalations = [
            'Propia'    =>'Propia',
            'Terceros'  =>'Terceros'
        ];
        $providers = Provider::get();
        $tabPanel='customerServicesTabEdit';
        $typesServices=Service::get();

        return view('modules.customers.services.index', compact(
            'customers',
            'countries',
            'departments',
            'cities',
            'tabPanel',
            'customerServices',
            'servicesList',
            'typesInstalations',
            'providers',
            'typesServices'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($customerId)
    {
        session::flash('tab','services');
        $servicesList=Service::get();
        $customers= Customer::with('customerContacs','customerServices')->get();
        $customer= Customer::with('customerContacs','customerServices')->findOrFail($customerId);
        $departments= Department::get();
        $cities=City::get();
        $countries= Country::get();
        $customerServices= CustomerService::customerId($customerId)->paginate();
        $typesInstalations = [
            'Propia'    =>'Propia',
            'Terceros'  =>'Terceros'
        ];
        $providers = Provider::get();
        $tabPanel='customerServicesTabEdit';
        $typesServices=Service::get();

        return view('modules.customers.edit', compact(
            'customer',
            'departments',
            'cities',
            'tabPanel',
            'customerServices',
            'customers',
            'servicesList',
            'typesInstalations',
            'providers',
            'typesServices',
            'countries'
        ));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function indexSearch(Request $request,$customerId)
    {
        session::flash('tab','services');
        $servicesList=Service::get();
        $customer= Customer::with('customerContacs','customerServices')->findOrFail($customerId);
        $departments= Department::get();
        $cities=City::get();
        $typesInstalations = [
            'Propia'    =>'Propia',
            'Terceros'  =>'Terceros'
        ];
        $providers = Provider::get();
        $tabPanel='customerServicesTabEdit';
        $typesServices=Service::get();
        $data=$request->all();
        $countries= Country::get();
        $customerServices= CustomerService::buscar($data,$customerId,'customer');
        if ($request->action=='buscar') {
            $customerServices = $customerServices->paginate();
            return view('modules.customers.edit', compact(
                'customer',
                'departments',
                'cities',
                'tabPanel',
                'customerServices',
                'servicesList',
                'typesInstalations',
                'providers',
                'data',
                'typesServices',
                'countries'
            ));
        } else {
            $customerServices = $customerServices->get();
            return (new CustomerServicesExport($customerServices))->download('Clientes_servicios.xlsx');
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request ,$customerId=null)
    {
        DB::beginTransaction();
        $customerService                            = new CustomerService();
        $customerService->stratecsa_id              = $request->stratecsa_id;
        $customerService->service_id                = $request->service_id;
        $customerService->city_id                   = $request->city_id;
        $customerService->date_service              = $request->date_service;
        $customerService->latitude_coordinates      = $request->latitude_coordinates;
        $customerService->longitude_coordinates     = $request->longitude_coordinates;
        $customerService->installation_type         = $request->installation_type;
        $customerService->country_id                = $request->country_id;
        $customerService->department_id             = $request->department_id;
        if ($request->filled('provider_id')) {
            $customerService->provider_id           = $request->provider_id;
        }
        if (is_null($customerId)) {
            $customerService->customer_id           = $request->customer_id;
        } else {
            $customerService->customer_id           = $customerId;
        }
        $customerService->state                     = 'Activo';
        $customerService->description               = $request->description;
        if (!$customerService->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al insertar registro.');
            return redirect()->back();
        }

        DB::commit();
        Alert::success('Success!', 'Registro insertado correctamente');
        return redirect()->back();
    }


     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        session::flash('tab','services');
        $customer= Customer::findOrFail($id);
        $customerServices= CustomerService::customerId($id)->paginate();
        $tabPanel='customerServicesTabShow';
        $providers= Provider::get();
        $typesInstalations=['Propia','Terceros'];
        $departments= Department::get();
        $typesServices=Service::get();
        $countries= Country::get();
        return view('modules.customers.show', compact(
            'customer',
            'customerServices',
            'tabPanel',
            'providers',
            'typesInstalations',
            'departments',
            'typesServices',
            'countries'
        ));
    }

    public function showService($id) {
        $service= CustomerService::findOrFail($id);

        return view('modules.customers.services.show', compact(
            'service',
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
        session::flash('tab','services');
        $customer= Customer::findOrFail($customerId);
        $tabPanel='customerServicesTabShow';
        $providers= Provider::get();
        $typesInstalations=['Propia','Terceros'];
        $departments= Department::get();
        $typesServices=Service::get();
        $data=$request->all();
        $countries= Country::get();
        $customerServices= CustomerService::buscar($data,$customerId,'customer');
        if ($request->action=='buscar') {
            $customerServices = $customerServices->paginate();
            return view('modules.customers.show', compact(
                'customer',
                'customerServices',
                'tabPanel',
                'providers',
                'typesInstalations',
                'departments',
                'typesServices',
                'data',
                'countries'
            ));
        } else {
            $customerServices = $customerServices->get();
            return (new CustomerServicesExport($customerServices))->download('Clientes_servicios.xlsx');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $customerService                            = CustomerService::findOrFail($id);
        $customerService->stratecsa_id              = $request->stratecsa_id;
        $customerService->service_id                = $request->service_id;
        $customerService->city_id                   = $request->city_id;
        $customerService->date_service              = $request->date_service;
        $customerService->latitude_coordinates      = $request->latitude_coordinates;
        $customerService->longitude_coordinates     = $request->longitude_coordinates;
        $customerService->installation_type         = $request->installation_type;
        $customerService->country_id                = $request->country_id;
        if ($request->filled('provider_id')) {
            $customerService->provider_id           = $request->provider_id;
        }
        $customerService->description               = $request->description;
        if (!$customerService->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al actualizar registro.');
            return redirect()->back();
        }

        DB::commit();
        Alert::success('Success!', 'Registro actualizado correctamente');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            if (!CustomerService::findOrFail($id)->delete()) {
                Alert::error('Error', 'Error al eliminar registro.');
                return redirect()->back();
            }
            DB::commit();
            Alert::success('Success!', 'Registro eliminado correctamente');
            return redirect()->back();
        } catch (QueryException $th) {
            if ($th->getCode() === '23000') {
                Alert::error('Error!', 'No se puede eliminar el registro porque está asociado con otro registro.');
                return redirect()->back();
            } else {
                Alert::error('Error!', $th->getMessage());
                return redirect()->back();
            }
        }
    }
}
