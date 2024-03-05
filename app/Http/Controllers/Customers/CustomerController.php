<?php

namespace App\Http\Controllers\Customers;

use App\Exports\Customers\CustomersExport;
use App\Http\Controllers\Controller;
use App\Models\Customers\Customer;
use App\Models\Customers\CustomerContact;
use App\Models\General\City;
use App\Models\General\Department;
use App\Models\General\TypeContact;
use App\Models\General\TypeDocument;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Session;

class CustomerController extends Controller
{

    /**
     * Muestra una lista de clientes paginados.
     *
     * @return \Illuminate\View\View
    */
    public function index()
    {
        // Obtener la lista de clientes paginados
        $customers = Customer::paginate();

        // Devolver la vista 'index' y pasar la lista de clientes como variable
        return view('modules.customers.index', compact('customers'));
    }


    /**
     * Busca clientes según los criterios proporcionados en la solicitud.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View|\Symfony\Component\HttpFoundation\BinaryFileResponse
    */
    public function search(Request $request)
    {
        // Crear una instancia de Customer (modelo)
        $customers = new Customer();

        // Cargar relaciones necesarias con el modelo
        $customers = $customers->with(
            'typeDocument',
            'city',
            'city.department',
            'state',
            'customerContacs',
            'customerServices',
            'customerServices.city',
            'customerServices.city.department',
            'customerServices.service',
            'customerServices.provider'
        );

        // Verificar si se proporciona un nombre en la solicitud y filtrar por él
        if ($request->filled('name')) {
            $customers = $customers->name($request->name);
        }

        // Verificar si se proporciona una identificación en la solicitud y filtrar por ella
        if ($request->filled('identification')) {
            $customers = $customers->name($request->identification);
        }

        // Verificar la acción solicitada
        if ($request->action == 'buscar') {
            // Paginar los resultados y devolver la vista 'index'
            $customers = $customers->paginate();
            return view('modules.customers.index', compact('customers'));
        } else {
            // Obtener todos los resultados y exportarlos como un archivo Excel
            $customers = $customers->get();
            return (new CustomersExport($customers))->download('Clientes.xlsx');
        }
    }


    /**
     * Muestra el formulario para crear un nuevo cliente.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Obtener todos los tipos de contactos disponibles
        $typesContacts = TypeContact::get();

        // Obtener todos los tipos de documentos disponibles
        $typesDocuments = TypeDocument::get();

        // Obtener todas las ciudades disponibles
        $cities = City::get();

        // Devolver la vista 'create' junto con los datos necesarios
        return view('modules.customers.create', compact('typesContacts', 'typesDocuments', 'cities'));
    }


    /**
     * Almacena un nuevo cliente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validar los datos enviados a través del formulario
        $request->validate([
            'type_document_id' => 'required',
            'identification' => 'required|unique:customers',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'city_id' => 'required',
            'type_contact_id' => 'required',
        ]);

        // Iniciar una transacción de base de datos
        DB::beginTransaction();

        // Crear una nueva instancia de Customer (cliente)
        $customer = new Customer();
        $customer->type_document_id = $request->type_document_id;
        $customer->identification = $request->identification;
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->city_id = $request->city_id;
        $customer->observations = $request->observations;
        $customer->state_id = 1; // Asignar un estado inicial (por ejemplo, "Activo")

        // Guardar el cliente en la base de datos
        if (!$customer->save()) {
            // En caso de error, revertir la transacción y mostrar un mensaje de error
            DB::rollBack();
            Alert::error('Error', 'Error al insertar registro.');
            return redirect()->back();
        }

        // Guardar los contactos del cliente
        foreach ($request->type_contact_id as $key => $value) {
            $customerContact = new CustomerContact();
            $customerContact->type_contact_id = $value;
            $customerContact->city_id = $request->city_contact_id[$key];
            $customerContact->name = $request->name_contact[$key];
            $customerContact->home_phone = $request->home_phone_contact[$key];
            $customerContact->cell_phone = $request->cell_phone_contact[$key];
            $customerContact->email = $request->email_contact[$key];
            $customerContact->customer_id = $customer->id; // Asociar el contacto con el cliente creado

            // Guardar el contacto en la base de datos
            if (!$customerContact->save()) {
                // En caso de error, revertir la transacción y mostrar un mensaje de error
                DB::rollBack();
                Alert::error('Error', 'Error al insertar registro.');
                return redirect()->back();
            }
        }

        // Confirmar la transacción y mostrar un mensaje de éxito
        DB::commit();
        Alert::success('¡Éxito!', 'Registro insertado correctamente');
        return redirect()->route('customers.index');
    }


    /**
     * Muestra la información detallada de un cliente.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Establecer una variable de sesión llamada 'tab' con el valor 'info' para resaltar una pestaña en la vista
        session::flash('tab', 'info');

        // Encontrar el cliente con el ID proporcionado
        $customer = Customer::findOrFail($id);

        // Obtener los contactos del cliente paginados
        $customerContacts = CustomerContact::customerId($id)->paginate();

        // Definir el nombre de la pestaña activa en la vista
        $tabPanel = 'customerInfoTabShow';

        // Pasar los datos del cliente, sus contactos y la pestaña activa a la vista
        return view('modules.customers.show', compact(
            'customer',
            'customerContacts',
            'tabPanel',
        ));
    }


    /**
     * Muestra el formulario de edición de un cliente.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Establecer una variable de sesión llamada 'tab' con el valor 'info' para resaltar una pestaña en la vista
        session::flash('tab', 'info');

        // Encontrar el cliente con el ID proporcionado, incluyendo sus contactos y servicios relacionados
        $customer = Customer::with('customerContacs', 'customerServices')->findOrFail($id);

        // Obtener tipos de contactos, tipos de documentos, departamentos y ciudades disponibles
        $typesContacts = TypeContact::get();
        $typesDocuments = TypeDocument::get();
        $departments = Department::get();
        $cities = City::get();

        // Calcular el total de contactos del cliente
        $totalContactos = $customer->customerContacs->count();

        // Definir el nombre de la pestaña activa en la vista
        $tabPanel = 'customerInfoTabEdit';

        // Pasar los datos del cliente y otros datos relacionados al formulario de edición en la vista
        return view('modules.customers.edit', compact(
            'customer',
            'totalContactos',
            'typesContacts',
            'typesDocuments',
            'departments',
            'cities',
            'tabPanel',
        ));
    }


    /**
     * Actualiza un cliente y sus contactos relacionados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Iniciar una transacción de base de datos
        DB::beginTransaction();

        // Validar los campos del formulario
        $request->validate([
            'type_document_id' => 'required',
            'identification' => 'required',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'city_id' => 'required',
            'type_contact_id' => 'required',
        ]);

        // Encontrar el cliente con el ID proporcionado
        $customer = Customer::findOrFail($id);

        // Actualizar los campos del cliente con los valores del formulario
        $customer->type_document_id = $request->type_document_id;
        $customer->identification = $request->identification;
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->city_id = $request->city_id;
        $customer->observations = $request->observations;
        $customer->state_id = 1;

        // Guardar los cambios en el cliente
        if (!$customer->save()) {
            // En caso de error, revertir la transacción y mostrar un mensaje de error
            DB::rollBack();
            Alert::error('Error', 'Error al actualizar el registro.');
            return redirect()->back();
        }

        // Eliminar los contactos del cliente
        CustomerContact::customerId($id)->delete();

        // Guardar los nuevos contactos proporcionados en el formulario
        foreach ($request->type_contact_id as $key => $value) {
            $customerContact = new CustomerContact();
            $customerContact->type_contact_id = $value;
            $customerContact->city_id = $request->city_contact_id[$key];
            $customerContact->name = $request->name_contact[$key];
            $customerContact->home_phone = $request->home_phone_contact[$key];
            $customerContact->cell_phone = $request->cell_phone_contact[$key];
            $customerContact->email = $request->email_contact[$key];
            $customerContact->customer_id = $customer->id;

            // Guardar el contacto
            if (!$customerContact->save()) {
                // En caso de error, revertir la transacción y mostrar un mensaje de error
                DB::rollBack();
                Alert::error('Error', 'Error al actualizar el registro.');
                return redirect()->back();
            }
        }

        // Confirmar la transacción y mostrar un mensaje de éxito
        DB::commit();
        Alert::success('¡Éxito!', 'Registro actualizado correctamente');
        return redirect()->route('customers.index');
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
            if (!Customer::findOrFail($id)->delete()) {
                Alert::error('Error', 'Error al eliminar registro.');
                return redirect()->back();
            }
            DB::commit();
            Alert::success('¡Éxito!', 'Registro eliminado correctamente');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function contactDestroy($id) {
        try {
            DB::beginTransaction();
            if (!CustomerContact::findOrFail($id)->delete()) {
                Alert::error('Error', 'Error al eliminar registro.');
                return redirect()->back();
            }
            DB::commit();
            Alert::success('¡Éxito!', 'Registro eliminado correctamente');
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
