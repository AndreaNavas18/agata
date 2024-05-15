<?php

namespace App\Http\Controllers\Pqrs;

use App\Http\Controllers\Controller;
use App\Models\Providers\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;
use App\Models\Pqrs\Pqr;
use Session;

class PqrController extends Controller
{
    public function index() {
        session::flash('tab','pqrs');
        $pqrs = Pqr::all();
        return view('modules.pqrs.index', compact(
            'pqrs',
        ));

       

    }

    
    public function indexSearch(Request $request,$customerId)
    {
        
    }

    public function pqrSearch(Request $request){
    }

    public function show($id)
    {
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request ,){
        DB::beginTransaction();
        session::flash('modal', 'modalProyecto');
        $proyectos                                  = new Proyecto();
        $proyectos->name                           = $request->name;
        $proyectos->description                    = $request->description;
        $proyectos->customer_id                    = $customerId;
        
        if (!$proyectos->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al insertar registro.');
            return redirect()->back();
        }

        DB::commit();
        Alert::success('Bien hecho!', 'Registro insertado correctamente');
        return redirect()->back();
    }

    public function edit($id)
    {
        session::flash('tab','proyectos');
        $proyectos= Proyecto::findOrFail($id);

        return view('modules.customers.proyectos.edit', compact(
            'proyectos',
        ));

    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        session::flash('modal', 'modalProyecto');
        $proyectos                                 = Proyecto::findOrFail($id);
        $proyectos->name                           = $request->name;
        $proyectos->description                    = $request->description;

        if (!$proyectos->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al actualizar registro.');
            return redirect()->back();
        }

        DB::commit();
        Alert::success('Bien hecho!', 'Registro actualizado correctamente');
        return redirect()->back();
    }

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



}