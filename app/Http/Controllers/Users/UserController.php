<?php

namespace App\Http\Controllers\Users;

use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Employees\Employee;
use App\Models\Permissions\Permission;
use App\Models\Roles\Role;
use App\Models\General\Proyecto;
use App\Models\Submodules\Submodule;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Gate;


class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth()->user();
        if ($user->role_id == 2 || $user->role_id == 3 || $user->role_id == 7 || $user->role_id == 8) {
            $users = User::where('customer_id', Auth()->user()->customer_id)->paginate();
            $proyectos = Proyecto::where('customer_id', $user->customer_id)->get();
            return view('modules.users.index', compact('users', 'proyectos'));

        }else if (Gate::allows('users.index')) {
            //Roles que puede ver el director_soporte
            $allowedRoles = [5,7,8,10,2,3];
            if($user->role_id == 10){
                $users = User::whereIn('role_id', $allowedRoles)->paginate();
                return view('modules.users.index', compact('users'));
            }else if($user->role_id == 9){
                $users = User::paginate();
                return view('modules.users.index', compact('users'));
            }else{
                //Que no se muestre el rol de programador a nadie, a excepcion del mismo
                $users = User::where('role_id', '!=', 9)->paginate();
                return view('modules.users.index', compact('users'));
            }
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proyectos = Proyecto::where('customer_id', Auth()->user()->customer_id)->get();
        
        if(Auth()->user()->role_id == 10){
            //Solo puede crear usuarios de soporte
            $roles = Role::where('id', 7)
            ->orWhere('id', 8)
            ->orWhere('id', 5)
            ->get();
        }else {
            $roles = Role::orderBy('name')->noCustomerRole()->get();
        }

        return view('modules.users.create', compact('roles', 'proyectos'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $request->validate([
                'name' => 'required',
                'last_name' => 'required',
                'password' => 'required',
                'email' => 'required|email|unique:users,email',
                'proyecto_id' => 'nullable|array',
                'proyecto_id.*' => 'exists:proyectos,id',
            ]);
            $user = new User();
            $userAuthenticated = Auth()->user();
            if ($userAuthenticated->role_id == 2 || $userAuthenticated->role_id == 3 || $userAuthenticated->role_id == 7 || $userAuthenticated->role_id == 8){
                $user->role_id=7;
                $user->customer_id=Auth()->user()->customer_id;
            // }else if($userAuthenticated->role_id == 10) {
            //     $user->role_id=5;
            }else {
                $user->role_id=$request->input('role_id');
                self::assignRole($user, $request->input('role_id'));
            }

            $user->name = $request->input('name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->status = 'Activo';
            $user->full_name=$request->input('name').' '.$request->input('last_name');

            if(!$user->save()) {
                DB::rollBack();
                Alert::error('Error', 'Error al guardar el registro.');
            }

            // Asigna los proyectos al usuario si existen
            if ($request->has('proyecto_id')) {
                $user->proyectos()->sync($request->input('proyecto_id'));
            }

            DB::commit();
            Alert::success('¡Éxito!', 'Registro insertado exitosamente');
            return redirect()->route('users.index');
        }catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Error al guardar el registro.');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('modules.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::orderBy('name')->noCustomerRole()->get();
        return view('modules.users.edit', compact('user', 'roles'));
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
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'role_id' => 'required',
            'email' => 'required|email|unique:users,email,'.$id.',id',
        ]);

        $user = User::findOrFail($id);
        self::assignRole($user, $request->input('role_id'));
        if (!is_null($request->input('password'))) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->role_id=$request->input('role_id');
        $user->full_name=$request->input('name').' '.$request->input('last_name');
        if (!$user->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al actualizar el registro.');
            return redirect()->back();
        }
        DB::commit();
        Alert::success('¡Éxito!', 'Registro actualizado correctamente');
        return redirect()->route('users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        if (!User::findOrFail($id)->delete()) {
            DB::rollBack();
            Alert::error('Error', 'Error deleting record.');
            return redirect()->back();
        }
        DB::commit();
        Alert::success('¡Éxito!', 'Registro eliminado exitosamente');
        return redirect()->back();
    }

    /**
     * Realiza un filtro de datos
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        // $users = User::with('employee');
        $users = User::query();
        
        if ($request->filled('name'))
             $users->username(trim($request->input('name')));
            

        if ($request->filled('status'))
            $users->status($request->input('status'));

        $users = $users->orderBy('name')->paginate();
        $data = $request->all();
        return view('modules.users.index', compact('users', 'data'));
    }

    /**
     * Vista para la asignación de permisos del usuario
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function allocationPermissions($id)
    {
        $user = User::findOrFail($id);
        $permissions = Permission::orderBy('name')->get();
        $submodules = Submodule::orderBy('name')->get();
        return view('modules.users.assignment_permissions', compact('user','permissions','submodules'));
    }


    /**
     * Assigns the specified permissions to the user
     *
     * @param  Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function allocationPermissionsUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->assignPermissions($user, $request->input('permissions'));
        Alert::success('¡Éxito!', 'Registro actualizado correctamente');
        return redirect()->route('users.index');
    }

    /**
     * User Profile View
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perfil($id)
    {
        if (Auth::user()->id != $id)
            abort(403);
        $user = User::findOrFail($id);
        return view('modules.users.perfil', compact('user'));
    }

    /**
     * Update user information
     *
     * @param  Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request, $id)
    {
        if (Auth::user()->id != $id)
            abort(403);

        DB::beginTransaction();
        $user = User::findOrFail($id);
        if ($user->validateChangePassword($request)) {
            $currentpass = $request->input('passwordActual');
            if (!Hash::check($currentpass, $user->password)) {
                Alert::warning('Warning', 'The current password is incorrect');
                return redirect()->back();
            }


            $user->password = bcrypt($request->input('password'));
            if (!$user->save()) {
                DB::rollBack();
                Alert::success('¡Éxito!', 'Registro actualizado correctamente');
                return redirect()->back();
            }
            DB::commit();

            Alert::success('¡Éxito!', 'Registro actualizado correctamente');
            return redirect()->route('home');
        }
    }


    /**
     * Check if username already exists
     * and is active
     *
     * @param  string $nombreUsuario
     * @return boolean
     */
    private function existsUserName($username)
    {
        $partyname = explode('.', trim($username));
        if ($partyname[0] == "" || (isset($partyname[1]) && $partyname[1] == ""))
            return true;

        $existsUser = User::nombreExacto($username)
            ->active()
            ->first();
        return ($existsUser) ? true : false;
    }


    /**
     * Assign the roles to the user
     *
     * @param  App\Models\users\Usuario $usuario
     * @param  array $roles
     * @return void
     */
    public static function assignRole($user, $role)
    {
        $user->syncRoles([$role]);
    }

    /**
     * Assign the permissions to the user
     *
     * @param  App\Models\users\User $user
     * @param  array $permissions
     * @return void
     */
    private function assignPermissions($user, $permissions)
    {
        $permissions = (!is_null($permissions)) ? array_keys($permissions) : array();
        foreach ($user->getPermissionsViaRoles() as $permissionViaRol) {
            if (in_array($permissionViaRol->id, $permissions)) {
                $index = array_search($permissionViaRol->id, $permissions);
                unset($permissions[$index]);
            }
        }
        $user->syncPermissions($permissions);
    }

}
