<?php

namespace App\Http\Controllers\Parameters\General;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\General\Proyecto;
use Illuminate\Database\QueryException;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Customers\Customer;

class GeneralProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos = Proyecto::orderBy('name')->paginate();

        return view('modules.parameters.general.proyectos.index', 
        compact('datos'));	


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

        $proyecto= new Proyecto();
        $proyecto->name             =       $request->name;
        $proyecto->description      =       $request->description;

        if (!$proyecto->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al insertar registro.');
            return redirect()->back();
        }
        DB::commit();
        Alert::success('Bien hecho!', 'Registro insertado correctamente');
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
        $description = $request->input('description');

        //validaciones
        $proyecto = Proyecto::findOrFail($id);
        $proyectoNew = Proyecto::where('name', $name)->first();

        if ($proyectoNew && $proyectoNew->name != $proyecto->name) {
            Alert::warning('Warning', 'El nombre '. $name .' esta en uso.');
            return redirect()->back();
        }

        $proyecto->name = $name;
        $proyecto->description = $description;

        if (!$proyecto->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al actualizar registro.');
            return redirect()->back();
        }
        DB::commit();
        Alert::success('Bien hecho!', 'Registro actualizado con éxito');
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

    /**
     * Realiza un filtro de datos
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $datos = Service::name($request->input('name'))->orderBy('name')->paginate();
        $data = $request->all();
        return view('modules.parameters.general.services.index', compact('datos','data'));
       
    }

}
