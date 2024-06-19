<?php

namespace App\Http\Controllers\Commercial;

use App\Http\Controllers\Controller;
use App\Models\Commercial\CommercialBandwidth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\General\Department;
use App\Models\General\City;

class CommercialBandwidthController extends Controller
{
    public function index(){
        $bandwidths = CommercialBandwidth::orderBy('name')->paginate();
        $departments = Department::orderBy('name')->get();
        $cities = City::orderBy('name')->get();

        return view('modules/commercial/parameters/bandwidth/index', compact('bandwidths', 'departments', 'cities'));

    }

    public function obtenerCiudades($department_id)
    {
        $cities = City::where('department_id', $department_id)->get();
        return response()->json($cities);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        $request->validate(['name' => 'required|max:100']);
        $bandwidth= new CommercialBandwidth();
        $bandwidth->name= $request->name . " MBPS";
        $bandwidth->department_id= $request->department_id;
        $bandwidth->city_id= $request->city_id;


        if (!$bandwidth->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al insertar registro.');
            return redirect()->back();
        }

        DB::commit();
        Alert::success('¡Éxito!', 'Registro insertado correctamente');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {

        DB::beginTransaction();
        $request->validate(['name' => 'required|max:100']);
        $name = $request->input('name');
        $department = $request->input('department_id');
        $city = $request->input('city_id');

        //validaciones
        $bandwidth = CommercialBandwidth::findOrFail($id);
        $bandwidthNew = CommercialBandwidth::where('name', $name)->first();

        if ($bandwidthNew && $bandwidthNew->name != $bandwidth->name) {
            Alert::warning('Warning', 'El nombre '. $name .' esta en uso.');
            return redirect()->back();
        }

        $bandwidth->name = $name;
        $bandwidth->department_id = $department;
        $bandwidth->city_id = $city;

        if (!$bandwidth->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al actualizar registro.');
            return redirect()->back();
        }
        DB::commit();
        Alert::success('¡Éxito!', 'Registro actualizado con éxito');
        return redirect()->back(); 
     }

     
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            if (!CommercialBandwidth::findOrFail($id)->delete()) {
                Alert::error('Error', 'Error al eliminar registro.');
                return redirect()->back();
            }
            DB::commit();
            Alert::success('¡Éxito!', 'Registro eliminado correctamente');
            return redirect()->back();
        } catch (CommercialBandwidth $th) {
            if ($th->getCode() === '23000') {
                Alert::error('Error!', 'No se puede eliminar el registro porque está asociado con otro registro.');
                return redirect()->back();
            } else {
                Alert::error('Error!', $th->getMessage());
                return redirect()->back();
            }
        }
    }

    public function search(Request $request)
    {
        $bandwidths = CommercialBandwidth::name($request->input('name'))->orderBy('name')->paginate();
        $data = $request->all();
        return view('modules/commercial/parameters/bandwidth/index', compact('bandwidths','data'));    
    }

}
