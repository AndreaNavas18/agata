<?php

namespace App\Http\Controllers\Submodules;

use App\Http\Controllers\Controller;
use App\Models\Permissions\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Submodules\Submodule;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class SubmoduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $submodules = Submodule::orderBy('name')->paginate();
        return view('modules.submodules.index', compact('submodules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:100', 'initials' => 'required|string|max:100']);
        $submodule = Submodule::firstOrCreate([
        	'name' => $request->input('name'),
        	'initials'  => strtolower($request->input('initials'))
        ]);

        if (!$submodule) {
            DB::rollBack();
            Alert::error('Error', 'Error inserted record.');
        }
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
        $request->validate(['name' => 'required|string|max:100']);
        $name = $request->input('name');
        Log::info( "Recibo: ".$id);
        $submodule = Submodule::findOrFail($id);
        Log::info( $name);

        $submoduleNew = Submodule::where('name', $name)->first();
        if ($submoduleNew && $submoduleNew->name != $submodule->name)
            Alert::warning('Warning', 'The submodule '. $request->input('name') .' is already in use.');

        $submodule->name = $name;
        if (!$submodule->save()) {
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
        $permission = Permission::where('submodule_id', $id)->get();
        if ($permission && $permission->count() > 0){

            Alert::error('Error', 'Cannot remove this submodule because there are permissions that make use of this');

            return redirect()->back();
        } 

        DB::beginTransaction();
        if (!Submodule::findOrFail($id)->delete()) {
            DB::rollBack();
            Alert::error('Error', 'Error deleting record.');
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
        $submodules = Submodule::name(strtolower($request->input('name')))->orderBy('name')->paginate();
        $data = $request->all();
        return view('modules.submodules.index', compact('submodules', 'data'));
    }

}
