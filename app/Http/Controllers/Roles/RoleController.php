<?php

namespace App\Http\Controllers\Roles;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Permissions\Permission;
use App\Models\Roles\Role;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use App\Models\Submodules\Submodule;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('name')->paginate();
        return view('modules.roles.index', compact('roles'));
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
        $request->validate(['name' => 'required|max:191']);
        try {
            $role = new Role();
            $role->name     =   $request->input('name');
            if (!$role->save()) {
                DB::rollBack();
                Alert::error('Error', 'Error inserted record.');
                return back();
            }
        } catch (RoleAlreadyExists $e) {
            Alert::warning('Warning', 'The role '. $request->input('name') .' is already in use.');
        }

        DB::commit();
        Alert::success('Success!', 'Registro insertado exitosamente');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rol = Role::findOrFail($id);
        $permissions = Permission::orderBy('name')->get();
        $submodules = Submodule::orderBy('name')->get();
        if ($rol->name == "admin")
            Alert::warning('Warning', 'The administrative role cannot be edited');


        return view('modules.roles.edit', compact('rol','permissions','submodules'));
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
        $rol = Role::findOrFail($id);
        if ($rol->name != "admin") {
            $permissions = (!is_null($request->input('to_assign'))) ? array_keys($request->input('to_assign')) : null;
            $rol->syncPermissions($permissions);
            $request->validate(['name' => 'required|max:191']);
            $name = $request->input('name');
            $rolNew = Role::where('name', $name)->first();
            if ($rolNew && $rolNew->name != $rol->name)
                Alert::warning('Warning', 'The role '. $name .' is already in use.');

            $rol->name = $name;
            if (!$rol->save()) {
                DB::rollBack();
                Alert::error('Error', 'Error updating record.');
            }
            DB::commit();
            Alert::success('Success!', 'Registro actualizado correctamente');
        } else {
            Alert::warning('Warning', 'The administrative role cannot be edited');
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Role::findOrFail($id)->name == "admin")
            Alert::warning('Warning', 'The administrative role cannot be removed');


        DB::beginTransaction();
        if (!Role::findOrFail($id)->delete()) {
            DB::rollBack();
            Alert::error('Error', 'Error deleting record.');
        }
        DB::commit();
        Alert::success('Success!', 'Registro eliminado exitosamente');
    }

    /**
     * Realiza un filtro de roles
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function buscar(Request $request)
    {
        $roles = Role::where('name', 'like', '%'.trim($request->input('name')).'%')
            ->orderBy('name')
            ->paginate(30);
        $data = $request->all();
        return view('modules.roles.index', compact('roles', 'data'));
    }

}
