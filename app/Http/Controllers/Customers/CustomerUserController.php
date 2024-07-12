<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\UserController;
use App\Models\Customers\Customer;
use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerUserController extends Controller
{

    /**
     * Muestra la página de edición de clientes con una lista de usuarios asociados.
     *
     * @param int $customerId El ID del cliente a editar.
     * @return \Illuminate\View\View Devuelve la vista para la edición del cliente.
     */
    public function index($customerId)
    {
        // Flash de una variable de sesión para establecer la pestaña activa
        session::flash('tab', 'users');

        // Encuentra al cliente con el ID proporcionado
        $customer = Customer::findOrFail($customerId);

        // Recupera los usuarios asociados al cliente y pagine los resultados
        $users = User::customerId($customerId)->paginate();

        // Define el panel de pestañas a mostrar en la vista
        $tabPanel = 'customerUsersTabEdit';

        // Devuelve la vista con el cliente, los usuarios asociados y el panel de pestañas
        return view('modules.customers.edit', compact(
            'customer',
            'users',
            'tabPanel'
        ));
    }


    /**
     * Muestra la información de usuarios de un cliente específico.
     *
     * @param int $customerId El ID del cliente cuyos usuarios se mostrarán.
     * @return \Illuminate\View\View La vista con la información de los usuarios del cliente.
     */
    public function show($customerId)
    {
        // Flash de una variable de sesión para establecer la pestaña activa
        session::flash('tab', 'users');

        // Encuentra al cliente con el ID proporcionado
        $customer = Customer::findOrFail($customerId);

        // Recupera los usuarios asociados al cliente y pagine los resultados
        $users = User::customerId($customerId)->paginate();

        // Define el panel de pestañas a mostrar en la vista
        $tabPanel = 'customerUsersTabShow';

        return view('modules.customers.show', compact(
            'customer',
            'users',
            'tabPanel'
        ));
    }


    /**
     * Almacena un nuevo usuario asociado a un cliente.
     *
     * @param Request $request La solicitud HTTP que contiene los datos del usuario.
     * @param int $customerId El ID del cliente al que se asociará el usuario.
     * @return \Illuminate\Http\RedirectResponse Redirige de vuelta a la página anterior.
     */
    public function store(Request $request, $customerId)
    {
        // Flash de una variable de sesión para mostrar el modal
        session::flash('modal', 'modalCustomerUser');

        // Valida los datos proporcionados en la solicitud
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'password' => 'required',
            'email' => 'required|email|unique:users,email',
        ]);

        // Comienza una transacción de base de datos
        DB::beginTransaction();

        // Crea una nueva instancia de usuario
        $user = new User();
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->status = 'Activo';
        $user->customer_id = $customerId;
        $user->role_id=7;
        $user->full_name=$request->input('name').' '.$request->input('last_name');
        // Asigna un rol al usuario (en este caso, el rol con ID 7)
        UserController::assignRole($user, 7);

        // Intenta guardar el usuario en la base de datos
        if (!$user->save()) {
            // En caso de error, revierte la transacción
            DB::rollBack();
            Alert::error('Error', 'Error al guardar el registro.');
        } else {
            // En caso de éxito, confirma la transacción
            DB::commit();
            Alert::success('Éxito', 'Registro insertado exitosamente');
        }

        // Redirige de vuelta a la página anterior
        return redirect()->back();
    }


    /**
     * Actualiza un usuario existente.
     *
     * @param Request $request La solicitud HTTP que contiene los datos del usuario a actualizar.
     * @param int $id El ID del usuario que se va a actualizar.
     * @return \Illuminate\Http\RedirectResponse Redirige de vuelta a la página anterior.
     */
    public function update(Request $request, $id)
    {
        // Flash de una variable de sesión para mostrar el modal
        session::flash('modal', 'modalCustomerUser');

        // Valida los datos proporcionados en la solicitud
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id . ',id',
        ]);

        // Comienza una transacción de base de datos
        DB::beginTransaction();

        // Encuentra el usuario existente por su ID
        $user = User::findOrFail($id);

        // Actualiza los campos del usuario con los datos proporcionados en la solicitud
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->status = 'Activo';
        $user->full_name=$request->input('name').' '.$request->input('last_name');
        // Verifica si se proporcionó una nueva contraseña en la solicitud
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        // Intenta guardar la actualización del usuario en la base de datos
        if (!$user->save()) {
            // En caso de error, revierte la transacción
            DB::rollBack();
            Alert::error('Error', 'Error al actualizar el registro.');
        } else {
            // En caso de éxito, confirma la transacción
            DB::commit();
            Alert::success('Éxito', 'Registro actualizado exitosamente');
        }

        // Redirige de vuelta a la página anterior
        return redirect()->back();
    }
}
