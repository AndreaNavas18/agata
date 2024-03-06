<?php

namespace App\Http\Controllers\Permissions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Permissions\Permission;
use Spatie\Permission\Exceptions\PermissionAlreadyExists;
use App\Models\Submodules\Submodule;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission as SpatiePermission;



class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::with('submodule')->orderBy('name')->paginate();
        $submodules = Submodule::orderBy('name')->get();
        return view('modules.permissions.index', compact('permissions','submodules'));
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
        $request->validate(['name' => 'required|max:191', 'submodule' => 'required|numeric']);
        try {
            $submodule = Submodule::findOrFail($request->input('submodule'));
            $name = $submodule->initials.'_'.$request->input('name');
            $permiso = Permission::create([
                'name'         => $name,
                'description'  => $request->input('description'),
                'submodule_id' => $submodule->id
            ]);
        } catch (PermissionAlreadyExists $e) {
            Alert::warning('Warning', 'El permiso '. $request->input('name') .' esta en uso.');
            return redirect()->back();
        }

        if (!$permiso) {
            DB::rollBack();
            Alert::error('Error', 'Error inserted record.');
        }
        DB::commit();
        Alert::success('¡Éxito!', 'Registro insertado exitosamente');
        return redirect()->back();
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
        $request->validate(['name' => 'required|max:191', 'submodule' => 'required|numeric']);
        $submodule = Submodule::findOrFail($request->input('submodule'));
        $name = $submodule->initials.'_'.$request->input('name');
        $description = $request->input('description');
        $permiso = SpatiePermission::findOrFail($id);
        $permisoNew = Permission::where('name', $name)->first();

        if ($permisoNew && $permisoNew->name != $permiso->name) {
            Alert::warning('Warning', 'El permiso '. $name .' esta en uso.');
            return redirect()->back();
        }

        $permiso->name = $name;
        $permiso->description = $description;
        $permiso->submodule_id = $submodule->id;
        if (!$permiso->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error updating record.');
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
        Log::info($id);
        try {
            $permission = SpatiePermission::findOrFail($id);
            $permission->delete();
            Alert::success('¡Éxito!', 'Registro eliminado correctamente');
        } catch (ModelNotFoundException $exception) {
            Alert::error('Error', 'El permiso no pudo ser encontrado.');
        } catch (QueryException $exception) {
            Alert::error('Error!', 'No se puede eliminar el registro porque está asociado con otro registro.');
        }
    
        return redirect()->back();

    }

    /**
     * Realiza un filtro de permisos
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */

    //  karen , esta es la unica busqueda que funciona bien 
    public function search(Request $request)
    {
        $submodules = Submodule::orderBy('name')->get();
        $permissions = Permission::with('submodule');
        if ($request->filled('name'))
            $permissions = $permissions->where('name', 'like', '%'.trim($request->input('name')).'%');

        if ($request->filled('submodule'))
            $permissions = $permissions->where('submodule_id', $request->input('submodule'));

        $permissions = $permissions->orderBy('name')->paginate();
        $data = $request->all();
        return view('modules.permissions.index', compact('permissions','submodules','data'));
    }

}
