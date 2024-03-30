<?php

namespace App\Http\Controllers\Employees;

use App\Exports\Employees\EmployeesExport;
use App\Http\Controllers\Controller;
use App\Models\Employees\Employee;
use App\Models\Employees\EmployeeArl;
use App\Models\Employees\EmployeeEps;
use App\Models\Employees\EmployeeFile;
use App\Models\Employees\EmployeePensionFund;
use App\Models\Employees\EmployeePosition;
use App\Models\Employees\EmployeeSeverance;
use App\Models\General\TypeDocument;
use App\Models\Helpers;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Session;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::paginate();
        return view('modules.employees.index', compact('employees'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function search(Request $request)
    {
        $employees = new Employee();
        $employees= $employees->with(
            'state:id,name',
            'position:id,name,department_id',
            'position.department:id,name',
            'typeDocument:id,name',
            'arl:id,name',
            'pension:id,name',
            'cesantias:id,name',
            'eps:id,name',
        );
        if ($request->filled('name')) {
            $employees = $employees->name($request->name);
        }

        if ($request->filled('identification')) {
            $employees = $employees->name($request->identification);
        }

        if ($request->action=='buscar') {
            $employees = $employees->paginate();
            return view('modules.employees.index', compact('employees'));

        } else {
            $employees = $employees->get();
            // return $employees;
            return (new EmployeesExport($employees))->download('Empleados.xlsx');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arlsList=EmployeeArl::get();
        $epsList= EmployeeEps::get();
        $pensionsList=EmployeePensionFund::get();
        $positionsList=EmployeePosition::get();
        $severanceList=EmployeeSeverance::get();
        $typesDocuments = TypeDocument::get();

        return view('modules.employees.create', compact(
            'arlsList',
            'epsList',
            'pensionsList',
            'positionsList',
            'severanceList',
            'typesDocuments'
        ));
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
        $employee= new Employee();
        $employee->type_document_id         = $request->type_document_id;
        $employee->identification           = $request->identification;
        $employee->first_name               = $request->first_name;
        $employee->second_name              = $request->second_name;
        $employee->surname                  = $request->surname;
        $employee->second_surname           = $request->second_surname;
        $employee->full_name                = $this->generarNombreCompleto($request);
        $employee->birth_date               = $request->birth_date;
        $employee->email                    = $request->email;
        $employee->address                  = $request->address;
        $employee->cell_phone               = $request->cell_phone;
        $employee->arl_id                   = $request->arl_id;
        $employee->fund_pension_id          = $request->fund_pension_id ;
        $employee->severance_fund_id        = $request->severance_fund_id ;
        $employee->eps_id                   = $request->eps_id ;
        $employee->position_id              = $request->position_id ;
        $employee->state_id                 = 1;
        $employee->name_contact_emergency           = $request->name_contact_emergency;
        $employee->last_name_contact_emergency      = $request->last_name_contact_emergency;
        $employee->parentesque_contact_emergency    = $request->parentesque_contact_emergency;
        $employee->phone_contact_emergency          = $request->phone_contact_emergency;
        if($request->filled('gender')) {
            $employee->gender                   = $request->gender;
        }
        if($request->filled('home_phone')) {
            $employee->home_phone                   = $request->home_phone;
        }

        if (!$employee->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al insertar el registro.');
            return redirect()->back();
        }

        //guardar documentos
         if ($request->hasFile('files')) {
            $files=$request->file('files');
            foreach ($files as  $value) {
                $fileEmployee= new  EmployeeFile();
                // Obtener el archivo
                $file = $value;
                // Obtener el nombre original del archivo
                $nameOriginal = $file->getClientOriginalName();
                Log::info($nameOriginal);
                // Carpeta de destino
                $destinationPath = public_path('storage/empleados/documentos');
                // Generar un nombre de archivo único
                $slugArchivo = 'documento_' . $employee->identification . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                // Mover el archivo a la carpeta de destino
                $file->move($destinationPath, $slugArchivo);
                // Definir la ruta del archivo
                $path = 'empleados/documentos/' . $slugArchivo;
                $fileEmployee->name_original = strtolower($nameOriginal).'_'.uniqid();
                $fileEmployee->slug = strtolower($slugArchivo);
                $fileEmployee->path = $path;
                $fileEmployee->employee_id = $employee->id;

                if(!$fileEmployee->save()) {
                    DB::rollBack();
                    Alert::error('Error', 'Error al insertar el registro.');
                    return redirect()->back();
                }
            }
        }

        DB::commit();
        Alert::success('¡Éxito!', 'Registro insertado correctamente');
        return redirect()->route('employees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('modules.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // session::flash('tab','editEmployee');
        $employee= Employee::findOrFail($id);
        $arlsList=EmployeeArl::get();
        $epsList= EmployeeEps::get();
        $pensionsList=EmployeePensionFund::get();
        $positionsList=EmployeePosition::get();
        $severanceList=EmployeeSeverance::get();
        $typesDocuments = TypeDocument::get();

        return view('modules.employees.edit', compact(
            'employee',
            'arlsList',
            'epsList',
            'pensionsList',
            'positionsList',
            'severanceList',
            'typesDocuments'
        ));
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
        try {
            DB::beginTransaction();
            $employee= Employee::findOrFail($id);
            $employee->type_document_id         = $request->type_document_id;
            $employee->first_name               = $request->first_name;
            $employee->second_name              = $request->second_name;
            $employee->surname                  = $request->surname;
            $employee->second_surname           = $request->second_surname;
            $employee->full_name                = $this->generarNombreCompleto($request);
            $employee->birth_date               = $request->birth_date;
            $employee->email                    = $request->email;
            $employee->address                  = $request->address;
            $employee->cell_phone               = $request->cell_phone;
            $employee->arl_id                   = $request->arl_id;
            $employee->fund_pension_id          = $request->fund_pension_id ;
            $employee->severance_fund_id        = $request->severance_fund_id ;
            $employee->eps_id                   = $request->eps_id ;
            $employee->position_id              = $request->position_id ;
            $employee->name_contact_emergency           = $request->name_contact_emergency;
            $employee->last_name_contact_emergency      = $request->last_name_contact_emergency;
            $employee->parentesque_contact_emergency    = $request->parentesque_contact_emergency;
            $employee->phone_contact_emergency          = $request->phone_contact_emergency;
            if($request->filled('gender')) {
                $employee->gender                   = $request->gender;
            }
            if($request->filled('home_phone')) {
                $employee->home_phone                   = $request->home_phone;
            }
            if ($request->hasFile('files')) {
                $files=$request->file('files');
                foreach ($files as $key => $value) {
                    $fileEmployee= new  EmployeeFile();
                    // Obtener el archivo
                    $file = $value;
                    // Obtener el nombre original del archivo
                    $nameOriginal = ($file->getClientOriginalName());
                    // Carpeta de destino
                    $destinationPath = public_path('storage/empleados/documentos');
                    // Generar un nombre de archivo único
                    $slugArchivo = 'documento_' . $employee->identification . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    // Mover el archivo a la carpeta de destino
                    $file->move($destinationPath, $slugArchivo);
                    // Definir la ruta del archivo
                    $path = 'empleados/documentos/' . $slugArchivo;
                    $fileEmployee->name_original = uniqid().'_'.Str::lower($nameOriginal);
                    $fileEmployee->slug = Str::lower($slugArchivo);
                    $fileEmployee->path = $path;
                    $fileEmployee->employee_id = $employee->id;

                    if(!$fileEmployee->save()) {
                        DB::rollBack();
                        Alert::error('Error', 'Error al insertar el registro.');
                        return redirect()->back();
                    }
                }

            }

            if (!$employee->save()) {
                DB::rollBack();
                Alert::error('Error', 'Error al actualizar registro.');
                return redirect()->back();
            }

            DB::commit();
            Alert::success('¡Éxito!', 'Registro actualizado correctamente');
            return redirect()->route('employees.index');
        } catch (\Throwable $th) {
            Alert::error('Error', 'Error al actualizar registro. '.$th->getMessage());
            return redirect()->back();
        }

    }


    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            if (!Employee::findOrFail($id)->delete()) {
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
     * Genera el nombre completo del empleado
     *
     * @param  Request $request
     * @return string
    */
    private function generarNombreCompleto(Request $request)
    {
        return Helpers::MayusculaTextoCompleto($request->input('first_name')) . ' ' .
            Helpers::MayusculaTextoCompleto($request->input('second_name')) . ' ' .
            Helpers::MayusculaTextoCompleto($request->input('surname')) . ' ' .
            Helpers::MayusculaTextoCompleto($request->input('second_surname'));
    }

    public function deleteFile($id){
        try {
            DB::beginTransaction();
            $file=EmployeeFile::findOrFail($id);
            if (!EmployeeFile::findOrFail($id)->delete()) {
                DB::rollBack();
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

    public function downloadFile($id){
        $file=EmployeeFile::findOrFail($id);
        $path = public_path('storage/'.$file->path);
        return response()->download($path);
    }

}
