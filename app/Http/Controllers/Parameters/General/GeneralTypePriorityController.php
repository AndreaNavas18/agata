<?php

namespace App\Http\Controllers\Parameters\General;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Tickets\GeneralTypesPriority;
use App\Models\Tickets\TicketPriority;
use Illuminate\Database\QueryException;
use RealRashid\SweetAlert\Facades\Alert;

class GeneralTypePriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos = GeneralTypesPriority::orderBy('name')->paginate();
        //Prioridades ALTA<MEDIA<BAJA
        $prioritiesList = TicketPriority::all();
        //Motivos de solicitud
        $typesPrioritiesList = GeneralTypesPriority::all();
        return view('modules.parameters.general.typePriorities.index', 
        compact('datos','prioritiesList','typesPrioritiesList'));	
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
        $request->validate(['name' => 'required|max:100', 'ticket_priority_id' => 'required']);
        
        $typePriority= new GeneralTypesPriority();
        $typePriority->name= $request->name;
        $typePriority->id_ticket_priority = $request->ticket_priority_id;
        
        if (!$typePriority->save()) {
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

        $request->validate(
            ['name' => 'required|max:100', 
            'ticket_priority_id' => 'required']);
        $name = $request->name;
        $ticketPriorityId = $request->ticket_priority_id;

        //validaciones
        $typePriority = GeneralTypesPriority::findOrFail($id);
        $typePriorityNew = GeneralTypesPriority::where('name', $name)->first();

        if ($typePriorityNew && $typePriorityNew->name != $typePriority->name) {
            Alert::warning('Warning', 'El nombre '. $name .' esta en uso.');
            return redirect()->back();
        }

        $typePriority->name = $name;
        $typePriority->id_ticket_priority = $ticketPriorityId;

        if (!$typePriority->save()) {
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
            if (!GeneralTypesPriority::findOrFail($id)->delete()) {
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
    public function search(Request $request)
    {
        $datos = GeneralTypesPriority::name($request->input('name'))->orderBy('name')->paginate();
        $data = $request->all();
        return view('modules.parameters.general.typePriorities.index', compact('datos','data'));
    }

}
