<?php

namespace App\Http\Controllers\Parameters\General;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\General\City;
use App\Models\General\Department;
use Illuminate\Database\QueryException;
use RealRashid\SweetAlert\Facades\Alert;

class GeneralCityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos = City::orderBy('name')->paginate();
        $departments = Department::get();
        return view('modules.parameters.general.cities.index', compact('datos','departments'));
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
        $request->validate([
            'name'          => 'required|max:100',
            'department_id' => 'required',
        ]);
        $city= new City();
        $city->name             = $request->name;
        $city->department_id    = $request->department_id;
        if (!$city->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al insertar registro.');
            return redirect()->back();
        }
        DB::commit();
        Alert::success('Success!', 'Registro insertado correctamente');
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

        $request->validate([
            'name' => 'required|max:100',
            'department_id' => 'required',
        ]);
        $name = $request->input('name');

        //validaciones
        $city = City::findOrFail($id);
        $cityNew = City::where('name', $name)->first();

        if ($cityNew && $cityNew->name != $city->name) {
            Alert::warning('Warning', 'El nombre '. $name .' esta en uso.');
            return redirect()->back();
        }

        $city->name             = $name;
        $city->department_id    = $request->department_id;

        if (!$city->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al actualizar registro.');
            return redirect()->back();
        }
        DB::commit();
        Alert::success('Success!', 'Registro actualizado con éxito');
        return redirect()->back();    }

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
            if (!City::findOrFail($id)->delete()) {
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

    /**
     * Realiza un filtro de datos
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $datos = City::name($request->input('name'))->orderBy('name')->paginate();
        $departments = Department::get();
        $data = $request->all();
        return view('modules.parameters.general.cities.index', compact('datos','data','departments'));
    }

}
