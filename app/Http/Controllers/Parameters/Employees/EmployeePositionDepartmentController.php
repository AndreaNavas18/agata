<?php

namespace App\Http\Controllers\Parameters\Employees;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Employees\EmployeePositionDepartment;
use Illuminate\Database\QueryException;

;
use RealRashid\SweetAlert\Facades\Alert;

class EmployeePositionDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos = EmployeePositionDepartment::orderBy('name')->paginate();
        return view('modules.parameters.employees.positionDepartment.index', compact('datos'));
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
        $request->validate(['name' => 'required|max:100']);
        $department= new EmployeePositionDepartment();
        $department->name= $request->name;
        if (!$department->save()) {
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

        $request->validate(['name' => 'required|max:100']);
        $name = $request->input('name');

        //validaciones
        $department = EmployeePositionDepartment::findOrFail($id);
        $departmentNew = EmployeePositionDepartment::where('name', $name)->first();

        if ($departmentNew && $departmentNew->name != $department->name) {
            Alert::warning('Warning', 'El nombre '. $name .' esta en uso.');
            return redirect()->back();
        }

        $department->name = $name;
        if (!$department->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al actualizar registro.');
            return redirect()->back();
        }
        DB::commit();
        Alert::success('Success!', 'Registro actualizado con éxito');
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
        try {
            DB::beginTransaction();
            if (!EmployeePositionDepartment::findOrFail($id)->delete()) {
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
        $datos = EmployeePositionDepartment::name($request->input('name'))->orderBy('name')->paginate();
        $data = $request->all();
        return view('modules.parameters.employees.positionDepartment.index', compact('datos','data'));
    }

}
