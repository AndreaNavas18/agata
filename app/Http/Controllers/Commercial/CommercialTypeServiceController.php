<?php

namespace App\Http\Controllers\Commercial;

use App\Http\Controllers\Controller;
use App\Models\Commercial\CommercialTypeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use App\Imports\CommercialServicesImport;


class CommercialTypeServiceController extends Controller
{


    public function index(){
        $typeServices = CommercialTypeService::orderBy('name')->paginate();

        return view('modules/commercial/parameters/typeService/index', compact('typeServices'));

    }


    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $request->validate(['name' => 'required|max:100']);
        $name = $request->input('name');

        //validaciones
        $typeServices = CommercialTypeService::findOrFail($id);
        $typeServicesNew = CommercialTypeService::where('name', $name)->first();

        if ($typeServicesNew && $typeServicesNew->name != $typeServices->name) {
            Alert::warning('Warning', 'El nombre '. $name .' esta en uso.');
            return redirect()->back();
        }

        $typeServices->name = $name;
        if (!$typeServices->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al actualizar registro.');
            return redirect()->back();
        }
        DB::commit();
        Alert::success('¡Éxito!', 'Registro actualizado con éxito');
        return redirect()->back();    
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        $request->validate(['name' => 'required|max:100']);
        $typeService= new CommercialTypeService();
        $typeService->name= $request->name;
        if (!$typeService->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al insertar registro.');
            return redirect()->back();
        }
        DB::commit();
        Alert::success('¡Éxito!', 'Registro insertado correctamente');
        return redirect()->back();
    }


    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            if (!CommercialTypeService::findOrFail($id)->delete()) {
                Alert::error('Error', 'Error al eliminar registro.');
                return redirect()->back();
            }
            DB::commit();
            Alert::success('¡Éxito!', 'Registro eliminado correctamente');
            return redirect()->back();
        } catch (CommercialTypeService $th) {
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
        $typeServices = CommercialTypeService::name($request->input('name'))->orderBy('name')->paginate();
        $data = $request->all();
        return view('modules/commercial/parameters/typeService/index', compact('typeServices','data'));    
    }

    public function import(Request $request)
    {
        if($request->hasFile('commercialservicedocumento')){

            $file = $request->file('commercialservicedocumento');
            Excel::import(new CommercialServicesImport, $file);
            Log::info("funcione, importe los tipos de servicio");

            Alert::success('Bien hecho!', 'Tipos de servicio importado(s) correctamente');
            return redirect()->back();

            
        }else {
            Alert::error('Error', 'Error al importar archivo.');
            Log::info("no funcioneeee");
            return redirect()->back();
        }
    }

}
