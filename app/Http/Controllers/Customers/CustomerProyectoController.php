<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\General\Proyecto;
use App\Models\Customers\Customer;
use App\Models\General\City;
use App\Models\General\Country;
use App\Models\General\Department;
use App\Models\General\Service;
use App\Models\Providers\Provider;
use Illuminate\Http\Request;
use App\Models\Customers\CustomerService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;
use Session;

class CustomerProyectoController extends Controller
{
    public function indexAll() {

        session::flash('tab','proyectos');

        if (Auth()->user()->role_id == 2 && $user->customer_id || Auth()->user()->role_id == 3 && $user->customer_id) {
            // Filtra los servicios por el customer_id del usuario autenticado
            $customerServices = CustomerService::where('customer_id', $user->customer_id)
                ->orderBy('id', 'DESC')
                ->paginate();
            $customers = Customer::where('id', $user->customer_id)->get(); // Si el cliente está asociado al usuario autenticado, puede obtenerlo directamente desde el usuario
            $customer = Customer::with('customerContacs', 'customerServices')->findOrFail($user->customer_id); // También puedes usar $user->customer_id aquí
            $departments = Department::get();
            $cities = City::get();
            $countries = Country::get();
            $servicesList = Service::get();
            $typesServices = Service::get();
            // Obtener los ids únicos de los proyectos asociados a los servicios del cliente
            $projectIds = $customerServices->pluck('proyecto_id')->unique();
            $proyectos = Proyecto::whereIn('id', $projectIds)->get();

            $tabPanel='customerProyectosTabEdit';
            $typesInstalations = [
                'Propia'    =>'Propia',
                'Terceros'  =>'Terceros'
            ];
            $providers = Provider::get();

            return view('modules.customers.proyectos.index', compact(
                'customers',
                'countries',
                'departments',
                'cities',
                'tabPanel',
                'customerServices',
                'servicesList',
                'typesServices',
                'proyectos',
                'typesInstalations',
                'providers',
            ));

        }else {
            $servicesList=Service::get();
            $customers= Customer::with('customerContacs','customerServices')->get();
            $countries= Country::get();
            $departments= Department::get();
            $cities=City::get();
            $customerServices= CustomerService::get();
            $typesInstalations = [
                'Propia'    =>'Propia',
                'Terceros'  =>'Terceros'
            ];
            $providers = Provider::get();
            $tabPanel='customerProyectosTabEdit';
            $typesServices=Service::get();
            $proyectos = Proyecto::paginate();

            return view('modules.customers.proyectos.index', compact(
                'customers',
                'countries',
                'departments',
                'cities',
                'tabPanel',
                'customerServices',
                'servicesList',
                'typesInstalations',
                'providers',
                'typesServices',
                'proyectos',
            ));
        }

    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($customerId)
    {
            session::flash('tab','proyectos');
            $servicesList=Service::get();
            $customers= Customer::with('customerContacs','customerServices')->get();
            $customer= Customer::with('customerContacs','customerServices')->findOrFail($customerId);
            $departments= Department::get();
            $cities=City::get();
            $countries= Country::get();
            $customerServices= CustomerService::get();
            $typesInstalations = [
                'Propia'    =>'Propia',
                'Terceros'  =>'Terceros'
            ];
            $providers = Provider::get();
            $tabPanel='customerProyectosTabEdit';
            $typesServices=Service::get();
            $proyectos = Proyecto::where('customer_id', $customerId)->paginate();
    
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
                'countries',
                'proyectos'
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
        Log::info("Hice esto ");
        session::flash('tab','proyectos');
        $servicesList=Service::get();
        $customer= Customer::with('customerContacs','customerServices')->findOrFail($customerId);
        $departments= Department::get();
        $cities=City::get();
        $typesInstalations = [
            'Propia'    =>'Propia',
            'Terceros'  =>'Terceros'
        ];
        $providers = Provider::get();
        $tabPanel='customerProyectosTabEdit';
        $typesServices=Service::get();
        $data=$request->all();
        $countries= Country::get();
        $customerServices= CustomerService::get();
        $proyectos = Proyecto::buscar($data,$customerId,'customer');
        if ($request->action=='buscar') {
            $proyectos = $proyectos->paginate();
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
                'countries',
                'proyectos'
            ));
        } else {
            $customerServices = $customerServices->get();
            return (new CustomerServicesExport($customerServices))->download('Clientes_servicios.xlsx');
        }
    }


    public function show($id)
    {
        session::flash('tab','proyectos');
        $customer= Customer::findOrFail($id);
        $customerServices= CustomerService::customerId($id)->paginate();
        $tabPanel='customerProyectosTabShow';
        $cities= City::get();
        $countries = Country::get();
        $services= Service::get();
        $typesServices = Service::get();
        $providers= Provider::get();
        $typesInstalations = [
            'Propia'    =>'Propia',
            'Terceros'  =>'Terceros'
        ];
        $proyectos = Proyecto::where('customer_id', $id)->paginate();
        return view('modules.customers.show', compact(
            'customer',
            'tabPanel',
            'cities',
            'services',
            'providers',
            'proyectos',
            'customerServices',
            'typesServices',
            'typesInstalations',
            'countries'
        ));
    }

    public function showProyecto($id) {
        $proyecto= Proyecto::findOrFail($id);

        return view('modules.customers.proyectos.show', compact(
            'proyecto',
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
       
        session::flash('tab','proyectos');
        $customer= Customer::findOrFail($customerId);
        $tabPanel='customerProyectosTabShow';
        $providers= Provider::get();
        $typesInstalations=['Propia','Terceros'];
        $departments= Department::get();
        $typesServices=Service::get();
        $data=$request->all();
        $countries= Country::get();
        $customerServices= CustomerService::get();
        $proyectos= Proyecto::buscar($data,$customerId,'customer');
        if ($request->action=='buscar') {
            $proyectos = $proyectos->paginate();
            return view('modules.customers.show', compact(
                'customer',
                'customerServices',
                'tabPanel',
                'providers',
                'typesInstalations',
                'departments',
                'typesServices',
                'data',
                'countries',
                'proyectos'
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
        session::flash('modal', 'modalProyecto');
        $proyectos                                  = new Proyecto();
        $proyectos->name                           = $request->name;
        $proyectos->description                    = $request->description;
        $proyectos->customer_id                    = $customerId;
        
        if (!$proyectos->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al insertar registro.');
            return redirect()->back();
        }

        DB::commit();
        Alert::success('Bien hecho!', 'Registro insertado correctamente');
        return redirect()->back();
    }

    public function edit($id)
    {
        session::flash('tab','proyectos');
        $proyectos= Proyecto::findOrFail($id);

        return view('modules.customers.proyectos.edit', compact(
            'proyectos',
        ));

    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        session::flash('modal', 'modalProyecto');
        $proyectos                                 = Proyecto::findOrFail($id);
        $proyectos->name                           = $request->name;
        $proyectos->description                    = $request->description;

        if (!$proyectos->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al actualizar registro.');
            return redirect()->back();
        }

        DB::commit();
        Alert::success('Bien hecho!', 'Registro actualizado correctamente');
        return redirect()->back();
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            if (!Proyecto::findOrFail($id)->delete()) {
                Alert::error('Error', 'Error al eliminar registro.');
                return redirect()->back();
            }
            DB::commit();
            Alert::success('Bien hecho!', 'Registro eliminado correctamente');
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

    public function getServices ($id) {
        $customerServices = CustomerService::where('customer_id', $id)
                ->whereNull('proyecto_id')
                ->get();
        Log::info($customerServices);
        return response()->json(['customerServices' => $customerServices]);
    }

    public function asignarServicio(Request $request) {
        try {
            DB::beginTransaction();
    
            // Actualizar el campo proyecto_id de todos los servicios que se seleccionaron con el id del proyecto
            CustomerService::whereIn('id', $request->customerservices)->update(['proyecto_id' => $request->proyecto_id]);
    
            DB::commit();
            Alert::success('Éxito!', 'Servicio(s) asignado(s) correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Error al asignar el/los servicio(s) al proyecto.');
        }
    
        // Redirigir a la ruta deseada después de completar el proceso
        return redirect()->back();
    }

    public function obtenerProyectoSeleccionado(Request $request) {

        $proyectoSeleccionadoId = $request->input('proyectoId');

        // Obtener la información necesaria del proyecto utilizando el ID
        $proyecto = Proyecto::findOrFail($proyectoSeleccionadoId);

        // Log::info($proyectoSeleccionadoId);
        
        // Devuelve la información del proyecto en formato JSON
        return response()->json(['proyecto' => $proyecto, 'proyectoSeleccionadoId' => $proyectoSeleccionadoId]);
    }

}