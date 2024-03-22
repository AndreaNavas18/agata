<?php

namespace App\Http\Controllers\Providers;

use App\Exports\CustomerServices\CustomerServicesExport;
use App\Http\Controllers\Controller;
use App\Models\Customers\Customer;
use App\Models\Customers\CustomerService;
use App\Models\General\City;
use App\Models\General\Department;
use App\Models\General\Service;
use App\Models\Providers\Provider;
use App\Models\General\Proyecto;
use App\Models\General\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use RealRashid\SweetAlert\Facades\Alert;

class ProviderServiceController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function index($providerId)
    {
        session::flash('tab','services');
        $servicesList=Service::get();
        $provider= Provider::with('contacs','services')->findOrFail($providerId);
        $departments= Department::get();
        $cities=City::get();
        $providerServices= CustomerService::providerId($providerId)->paginate();
        $typesInstalations = [
            'Propia'    =>'Propia',
            'Terceros'  =>'Terceros'
        ];
        $providers = Provider::get();
        $tabPanel='providerServicesTabEdit';
        $customersList = Customer::get();
        $typesServices=Service::get();
        $customers=Customer::get();
        $proyectos= Proyecto::get();
        $countries= Country::get();
        $camposAdicionales = [
            'ip',
            'vlan',
            'mascara',
            'gateway',
            'mac',
            'ancho_de_banda',
            'ip_vpn',
            'tipo_vpn',
            'user_vpn',
            'password_vpn',
            'user_tunel',
            'id_tunel',
            'tecnologia',
            'equipo',
            'modelo',
            'serial',
            'activo_fijo'
        ];


        return view('modules.providers.edit', compact(
            'provider',
            'departments',
            'cities',
            'tabPanel',
            'providerServices',
            'servicesList',
            'typesInstalations',
            'providers',
            'customersList',
            'typesServices',
            'customers',
            'proyectos',
            'countries',
            'camposAdicionales'
        ));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function indexSearch(Request $request,$providerId)
    {
        session::flash('tab','services');
        $servicesList=Service::get();
        $provider= Provider::with('contacs','services')->findOrFail($providerId);
        $departments= Department::get();
        $cities=City::get();
        $typesInstalations = [
            'Propia'    =>'Propia',
            'Terceros'  =>'Terceros'
        ];
        $providers = Provider::get();
        $tabPanel='providerServicesTabEdit';
        $customersList = Customer::get();
        $typesServices=Service::get();
        $customers=Customer::get();
        $data=$request->all();
        //buscar según los filtros
        $providerServices= CustomerService::buscar($data,$providerId,'provider');
        //redirección
        if ($request->action=='buscar') {
            $providerServices = $providerServices->paginate();
            return view('modules.providers.edit', compact(
                'provider',
                'departments',
                'cities',
                'tabPanel',
                'servicesList',
                'typesInstalations',
                'providers',
                'customersList',
                'typesServices',
                'customers',
                'providerServices'
            ));
        } else {
            $providerServices = $providerServices->get();
            return (new CustomerServicesExport($providerServices))->download('Proveedores_servicios.xlsx');
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request ,$providerId)
    {
        DB::beginTransaction();
        $customerService                            = new CustomerService();
        $customerService->service_id                = $request->service_id;
        $customerService->city_id                   = $request->city_id;
        $customerService->date_service              = $request->date_service;
        $customerService->latitude_coordinates      = $request->latitude_coordinates;
        $customerService->longitude_coordinates     = $request->longitude_coordinates;
        $customerService->installation_type         = $request->installation_type;
        if ($request->filled('provider_id')) {
            $customerService->provider_id           = $request->provider_id;
        }
        $customerService->state                     = 1;
        $customerService->description               = $request->description;
        $customerService->customer_id               = $request->customer_id;
        if (!$customerService->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al insertar registro.');
            return redirect()->back();
        }

        DB::commit();
        Alert::success('¡Éxito!', 'Registro insertado correctamente');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($providerId)
    {
        session::flash('tab','services');
        $provider= Provider::findOrFail($providerId);
        $providerServices= CustomerService::providerId($providerId)->paginate();
        $tabPanel='ProviderServicesShowTab';
        $countries= Country::get();
        $departments= Department::get();
        $typesServices=Service::get();
        $customers=Customer::get();
        $proyectos=Proyecto::get();
        $typesInstalations = [
            'Propia'    =>'Propia',
            'Terceros'  =>'Terceros'
        ];
        $providers = Provider::get();

        return view('modules.providers.show', compact(
            'provider',
            'providerServices',
            'tabPanel',
            'departments',
            'typesServices',
            'customers',
            'proyectos',
            'countries',
            'typesInstalations',
            'providers'
        ));
    }

    // public function showService($id) {
    //     $service= CustomerService::findOrFail($id);

    //     return view('modules.customers.services.show', compact(
    //         'service',
    //     ));
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showSearch(Request $request,$providerId)
    {
        session::flash('tab','services');
        $provider= Customer::findOrFail($providerId);
        $tabPanel='ProviderServicesShowTab';
        $departments= Department::get();
        $typesServices=Service::get();
        $customers=Customer::get();
        $data=$request->all();
        //buscar según los filtros
        $providerServices= CustomerService::buscar($data,$providerId,'provider');
        //redirección
        if ($request->action=='buscar') {
            $providerServices = $providerServices->paginate();
            return view('modules.providers.show', compact(
                'provider',
                'providerServices',
                'tabPanel',
                'departments',
                'typesServices',
                'customers',
            ));
        } else {
            $providerServices = $providerServices->get();
            return (new CustomerServicesExport($providerServices))->download('Proveedores_servicios.xlsx');
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
        $customerService->service_id                = $request->service_id;
        $customerService->city_id                   = $request->city_id;
        $customerService->date_service              = $request->date_service;
        $customerService->latitude_coordinates      = $request->latitude_coordinates;
        $customerService->longitude_coordinates     = $request->longitude_coordinates;
        $customerService->installation_type         = $request->installation_type;
        if ($request->filled('provider_id')) {
            $customerService->provider_id           = $request->provider_id;
        }
        $customerService->description               = $request->description;
        $customerService->customer_id               = $request->customer_id;
        if (!$customerService->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al actualizar registro.');
            return redirect()->back();
        }

        DB::commit();
        Alert::success('¡Éxito!', 'Registro actualizado correctamente');
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
        //
    }
}
