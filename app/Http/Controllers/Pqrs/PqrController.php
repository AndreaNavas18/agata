<?php

namespace App\Http\Controllers\Pqrs;

use App\Http\Controllers\Controller;
use App\Models\Providers\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;
use App\Models\Pqrs\Pqr;
use App\Models\Employees\EmployeePositionDepartment;
use App\Models\Employees\Employee;
use App\Models\Tickets\Ticket;
use App\Models\Pqrs\TemaPqr;
use App\Models\Customers\Customer;
use App\Models\General\Proyecto;
use App\Models\Customers\CustomerService;

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

    public function create() {
        session::flash('tab','pqrs');
        $pqrs = Pqr::all();
        $departmentList = EmployeePositionDepartment::all();
        $temasList = TemaPqr::all();

        $indexes = [
            'tickets' => Ticket::all(),
            'providers' => Provider::all(),
            'employees' => Employee::all(),
            'customers' => Customer::all(),
            'projects' => Proyecto::all(),
            'services' => CustomerService::all(),
        ];

        return view('modules.pqrs.create', compact(
            'pqrs', 
            'departmentList', 
            'temasList',
            'indexes',
        ));
    }

    public function temasPorDepartamento(Request $request){
        return TemaPqr::where('department_id', $request->temaDepartmentId)->get();
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $pqr = new Pqr();
        $pqr->created_by = $user->id;
        $pqr->department = $request->department;
        $pqr->issue = $request->issue;
        $pqr->description = $request->description;
        $pqr->status = 'Pendiente';

        $proyectos                                 = new Proyecto();
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

    public function indexTema() {
        session::flash('tab','temas');
        $datos = TemaPqr::orderBy('name')->paginate();
        $temas = TemaPqr::all();
        $departmentList = EmployeePositionDepartment::all();

        return view('modules.pqrs.temas.index', compact(
            'temas', 'departmentList', 'datos',
        ));
    }

    public function storeTema(Request $request) {
        DB::beginTransaction();
        $request->validate(['name' => 'required|max:100', 'department_id' => 'required']);

        $tema = new TemaPqr();
        $tema->name = $request->name;
        $tema->department_id = $request->department_id;

        if (!$tema->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al insertar registro.');
            return redirect()->back();
        }
        DB::commit();
        Alert::success('¡Éxito!', 'Registro insertado correctamente');
        return redirect()->back();
    }

    public function updateTema(Request $request, $id) {      
        DB::beginTransaction();

        $request->validate(
            ['name' => 'required|max:100', 
            'department_id' => 'required']);

        $tema = TemaPqr::findOrFail($id);
        $name = $request->name;

        $nameNew = TemaPqr::where('name', $name)->first();

        if ($nameNew && $nameNew->name != $tema->name) {
            Alert::warning('Warning', 'El nombre '. $name .' esta en uso.');
            return redirect()->back();
        }

        $tema->name = $request->name;
        $tema->department_id = $request->department_id;

        if (!$tema->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al actualizar registro.');
            return redirect()->back();
        }
        DB::commit();
        Alert::success('¡Éxito!', 'Registro actualizado con éxito');
        return redirect()->back();
    }

    public function SearchTema(Request $request) {
        $datos = TemaPqr::name($request->input('name'))->orderBy('name')->paginate();
        $data = $request->all();
        $departmentList = EmployeePositionDepartment::all();
        return view('modules.pqrs.temas.index', compact('datos','data', 'departmentList'));

    }

    public function destroyTema($id) {
        try {
            DB::beginTransaction();
            if (!TemaPqr::findOrFail($id)->delete()) {
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





}