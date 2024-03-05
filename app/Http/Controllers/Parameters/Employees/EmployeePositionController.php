<?php

namespace App\Http\Controllers\Parameters\Employees;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Employees\EmployeePosition;
use App\Models\Employees\EmployeePositionDepartment;
use Illuminate\Database\QueryException;
use RealRashid\SweetAlert\Facades\Alert;

class EmployeePositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos = EmployeePosition::orderBy('name')->paginate();
        $departments = EmployeePositionDepartment::get();
        return view('modules.parameters.employees.positions.index', compact('datos','departments'));
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
        $position= new EmployeePosition();
        $position->name             = $request->name;
        $position->department_id    = $request->department_id;
        if (!$position->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al insertar registro.');
            return redirect()->back();
        }
        DB::commit();
        Alert::success('¡Éxito!', 'Registro insertado correctamente');
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
        $position = EmployeePosition::findOrFail($id);
        $positionNew = EmployeePosition::where('name', $name)->first();
        if ($positionNew && $positionNew->name != $position->name) {
            Alert::warning('Warning', 'El nombre '. $name .' esta en uso.');
            return redirect()->back();
        }

        $position->name             = $name;
        $position->department_id    = $request->department_id;
        if (!$position->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al actualizar registro.');
            return redirect()->back();
        }
        DB::commit();
        Alert::success('¡Éxito!', 'Registro actualizado con éxito');
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
            if (!EmployeePosition::findOrFail($id)->delete()) {
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
     * Realiza un filtro de datos
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function buscar(Request $request)
    {
        $datos = EmployeePosition::name($request->input('name'))->orderBy('name')->paginate();
        $departments = EmployeePositionDepartment::get();
        $data = $request->all();
        return view('modules.parameters.employees.positions.index', compact('datos','data','departments'));
    }

}
