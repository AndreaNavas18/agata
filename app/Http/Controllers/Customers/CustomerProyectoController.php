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
    public function indexAll1() {

        session::flash('tab','proyectosAll');
        $user = Auth()->user();
        $allowedRoles = [2, 3, 7, 8];


        if (in_array(Auth()->user()->role_id, $allowedRoles) && $user->customer_id) {
            \Log::info('Usuario con permisos para ver todos los proyectos');
            if($user->proyectos()->exists()){
                \Log::info('Usuario con proyectos asociados');
                $proyectoIds = $user->proyectos->pluck('id')->toArray();
                $customerServicesQuery->whereIn('proyecto_id', $proyectoIds);
            }else{
                \Log::info('Usuario sin proyectos asociados');
                $customerServices = CustomerService::where('customer_id', $user->customer_id);
            }

            $customers = Customer::where('id', $user->customer_id)->get(); // Si el cliente está asociado al usuario autenticado, puede obtenerlo directamente desde el usuario
            $customer = Customer::with('customerContacs', 'customerServices')->findOrFail($user->customer_id); 
            $departments = Department::get();
            $cities = City::get();
            $countries = Country::get();
            $servicesList = Service::get();
            $typesServices = Service::get();
            // Obtener los ids únicos de los proyectos asociados a los servicios del cliente
            $projectIds = $customerServices->pluck('proyecto_id')->unique();
            // $proyectos = Proyecto::whereIn('id', $projectIds)->get();
            $proyectos = Proyecto::whereIn('id', $projectIds)->paginate();

            $tabPanel='customerProyectosTabEdit';
            $typesInstalations = [
                'Propia'    =>'Propia',
                'Terceros'  =>'Terceros'
            ];
            $providers = Provider::get();

            return view('modules.customers.proyectos.index',
            compact(
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
            \Log::info('Usuario de la empresa');
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

    public function indexAll() {
        session::flash('tab','proyectosAll');
        $user = Auth()->user();
        $allowedRoles = [2, 3, 7, 8];
    
        if (in_array($user->role_id, $allowedRoles) && $user->customer_id) {
            \Log::info('Usuario con permisos para ver todos los proyectos');
    
            // Inicializamos la consulta de servicios de clientes
            $customerServicesQuery = CustomerService::where('customer_id', $user->customer_id);
    
            if ($user->proyectos()->exists()) {
                \Log::info('Usuario con proyectos asociados');
                $proyectoIds = $user->proyectos->pluck('id')->toArray();
                $customerServicesQuery->whereIn('proyecto_id', $proyectoIds);
            } else {
                \Log::info('Usuario sin proyectos asociados');
            }
    
            // Obtener servicios de clientes
            $customerServices = $customerServicesQuery->get();
            
            // Obtener el cliente relacionado
            $customers = Customer::where('id', $user->customer_id)->get();
            $customer = Customer::with('customerContacs', 'customerServices')->findOrFail($user->customer_id);
    
            // Obtener otros datos necesarios
            $departments = Department::get();
            $cities = City::get();
            $countries = Country::get();
            $servicesList = Service::get();
            $typesServices = Service::get();
            $typesInstalations = [
                'Propia'    =>'Propia',
                'Terceros'  =>'Terceros'
            ];
            $providers = Provider::get();
            
            // Obtener los ids únicos de los proyectos asociados a los servicios del cliente
            $projectIds = $customerServices->pluck('proyecto_id')->unique();
            $proyectos = Proyecto::whereIn('id', $projectIds)->paginate();
    
            $tabPanel = 'customerProyectosTabEdit';
    
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
    
        } else {
            \Log::info('Usuario de la empresa');
            
            // Datos generales para usuarios sin permisos especiales
            $servicesList = Service::get();
            $customers = Customer::with('customerContacs','customerServices')->get();
            $countries = Country::get();
            $departments = Department::get();
            $cities = City::get();
            $customerServices = CustomerService::get();
            $typesInstalations = [
                'Propia'    =>'Propia',
                'Terceros'  =>'Terceros'
            ];
            $providers = Provider::get();
            $tabPanel = 'customerProyectosTabEdit';
            $typesServices = Service::get();
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
        //Otra busqueda funcional --karen --
        public function indexSearch(Request $request,$customerId)
        {
            
          // Obtener el cliente
            $customer = Customer::findOrFail($customerId);

            // Obtener el proyecto seleccionado en la solicitud
            $projectId = $request->input('proyecto_id');

            // Realizar la búsqueda de proyectos del cliente específico y el proyecto seleccionado
            $proyectos = Proyecto::where('customer_id', $customerId);
                    
             // Si se proporciona un proyecto específico, agregar el filtro por su ID
            if (!empty($projectId)) {
                $proyectos->where('id', $projectId);
            }

            // Obtener los proyectos paginados
            $proyectos = $proyectos->paginate();
            $proyectosAll =Proyecto::where('customer_id', $customerId);
            $proyectosAll = $proyectosAll->paginate();
            
            $customerServices= CustomerService::customerId($customerId)->paginate();
            $tabPanel='customerProyectosTabEdit';
            $cities= City::get();
            $countries = Country::get();
            $services= Service::get();
            $typesServices = Service::get();
            $providers= Provider::get();
            $typesInstalations = [
                'Propia'    =>'Propia',
                'Terceros'  =>'Terceros'
            ];


            return view('modules.customers.edit', 
            compact(
                'proyectos',
                'customer',
                'tabPanel',
                'cities',
                'services',
                'providers',
                'customerServices',
                'typesServices',
                'typesInstalations',
                'countries',
                'proyectosAll'
            ));

            
                    // } else {
                    //     $customerServices = $customerServices->get();
                    //     return (new CustomerServicesExport($customerServices))->download('Clientes_servicios.xlsx');
                    // }
        }

    public function projectSearch(Request $request){
        $proyectos = Proyecto::name($request->input('proyecto_id'))->orderBy('name')->paginate();
        $proyectosAll = Proyecto::get();
        return view('modules.customers.proyectos.index',
        compact('proyectos' , 'proyectosAll'));
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

        session::flash('tab','showProyecto');

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
        // Obtener el cliente
        $customer = Customer::findOrFail($customerId);

        // Obtener el proyecto seleccionado en la solicitud
        $projectId = $request->input('proyecto_id');

        // Realizar la búsqueda de proyectos del cliente específico y el proyecto seleccionado
        $proyectos = Proyecto::where('customer_id', $customerId);
                
            // Si se proporciona un proyecto específico, agregar el filtro por su ID
        if (!empty($projectId)) {
            $proyectos->where('id', $projectId);
        }

        // Obtener los proyectos paginados
        $proyectos = $proyectos->paginate();

        $customerServices= CustomerService::customerId($customerId)->get();
        $tabPanel='customerProyectosTabEdit';
        $cities= City::get();
        $countries = Country::get();
        $services= Service::get();
        $typesServices = Service::get();
        $providers= Provider::get();
        $typesInstalations = [
            'Propia'    =>'Propia',
            'Terceros'  =>'Terceros'
        ];
            return view('modules.customers.show', compact(
                'proyectos',
                'customer',
                'tabPanel',
                'cities',
                'services',
                'providers',
                'customerServices',
                'typesServices',
                'typesInstalations',
                'countries'
            ));
    //     }else {
    //         $customerServices = $customerServices->get();
    //         return (new CustomerServicesExport($customerServices))->download('Clientes_servicios.xlsx');
    //     }
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

        // Obtener los proyectos asociados al cliente
        $projects = Proyecto::where('customer_id', $id)->pluck('id')->toArray();

        // Verificar si hay servicios asociados a alguno de los proyectos del cliente
        $projectServicesCount = CustomerService::whereIn('proyecto_id', $projects)->count();

        // Obtener los servicios según la validación
        $customerServices = CustomerService::where(function ($query) use ($projects, $projectServicesCount) {
            if ($projectServicesCount > 0) {
                // Si hay servicios asociados a alguno de los proyectos del cliente, listar los servicios sin proyecto_id o con proyecto_id diferente de los proyectos del cliente
                $query->whereNull('proyecto_id')
                    ->orWhereNotIn('proyecto_id', $projects);
            } else {
                // Si no hay servicios asociados a ninguno de los proyectos del cliente, listar todos los servicios sin proyecto_id
                $query->whereNull('proyecto_id');
            }
        })
        ->where('customer_id', $id)
        ->get();

        Log::info($customerServices);

        return response()->json(['customerServices' => $customerServices]);
    
    //     $customerServices = CustomerService::where('customer_id', $id)
    //             ->whereNull('proyecto_id')
    //             ->get();
    //     Log::info($customerServices);
    //     return response()->json(['customerServices' => $customerServices]);
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

    //Obtener todos los proyectos
    public function getProyectos(Request $request){
        $customerId = $request->customerId;
        $customer = Customer::find($customerId);
    
        // Inicializar un array para almacenar los IDs de los proyectos
        $proyectosIds = [];
    
        // Iterar sobre cada servicio de cliente
        foreach ($customer->customerServices as $customerService) {
            // Agregar el ID del proyecto asociado al array
            $proyectosIds[] = $customerService->proyecto_id;
        }
    
        // Eliminar los IDs de proyectos duplicados
        $proyectosIdsUnicos = array_unique($proyectosIds);
    
        // Imprimir los IDs de los proyectos únicos en el registro
        $proyectos = Proyecto::whereIn('id', $proyectosIdsUnicos)->get();
        // Retornar los IDs de los proyectos únicos como respuesta JSON
        // Log::info($proyectos);
        return response()->json($proyectos);
    }
    


}