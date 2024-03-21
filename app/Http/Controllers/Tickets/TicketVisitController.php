<?php

namespace App\Http\Controllers\Tickets;

use App\Exports\Tickets\TicketsExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tickets\Ticket;
use App\Models\Tickets\TicketVisit;
use App\Models\Tickets\TicketVisitEmployee;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\Employees\EmployeeFile;
use App\Models\Employees\Employee;
use App\Models\General\TypeDocument;
use App\Models\Helpers;
use App\Models\Tickets\TicketVisitFile;
use App\Mail\VisitaTicketMail;
use App\Models\Tickets\TicketVisitEmployeeFile;

class TicketVisitController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $ticketId)
    {
        $ticketVisit= new TicketVisit();
        $ticketVisit->ticket_id                             = $ticketId;
        $ticketVisit->date                                  = $request->date;
        $ticketVisit->time                                  = $request->time;
        $ticketVisit->description                           = $request->description;
        if($request->filled('ticket_replie_id')) {
            $ticketVisit->ticket_replie_id                  = $request->ticket_replie_id;
        }
        Log::info("este es el tipo de visita:");
        Log::info($request->visit_type);
        if($request->visit_type === '1') {
            $ticketVisit->visit_type                        = '1';
            Log::info("visita con instalacion propia");
        } else {
            $ticketVisit->visit_type                        = '2';
            Log::info("Visita con instalacion tercerizada");
        }
            

        if (!$ticketVisit->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al insertar registro.');
            return redirect()->back();
        }

        if($request->filled('technicals')) {
            //guardarlos tecnicos
            foreach($request->technicals as $technical) {
                $ticketVisitEmployee= new TicketVisitEmployee();
                $ticketVisitEmployee->ticket_visit_id  = $ticketVisit->id;
                $ticketVisitEmployee->employee_id  = $technical;
                if (!$ticketVisitEmployee->save()) {
                    DB::rollBack();
                    Alert::error('Error', 'Error al insertar registro.');
                    return redirect()->back();
                }
            }
        }else{
            Log::info("Visita tercerizada no tiene tecnicos asignados");
        }

         //guardar documentos
        
         if ($request->filled('files')) {
            Log::info("Si hay archivos");
            $selectedFiles = $request->input('files', []);
            foreach ($selectedFiles as $file) {
                Log::info($file);
                $file = EmployeeFile::findOrFail($file);

                $ticketVisitFile = new TicketVisitFile();
                $ticketVisitFile->ticket_visit_id = $ticketVisit->id;
                $ticketVisitFile->employee_file_id = $file->id; 


                $ticketVisitFile->path = $file->path;
                $ticketVisitFile->name_original = $file->name_original;
                $ticketVisitFile->slug = $file->slug;
                $ticketVisitFile->save();
            }
        }else {
            Log::info("No hay archivos adjuntos");
        }
        $employees = $ticketVisit->employees;
        Log::info($employees);
        DB::commit();
        Alert::success('¡Éxito!', 'Registro insertado correctamente');

        $this->sendVisitEmail($ticketVisit, $employees);
        return redirect()->back();
    }

    public function sendVisitEmail (TicketVisit $ticketVisit, $employees){

        if($ticketVisit->visit_type === '1') {
            Log::info("visita con instalacion propia");
            
            // Obtener todos los archivos adjuntos asociados con la visita del ticket
               $archivosAdjuntos = $ticketVisit->ticketvisitfiles->pluck('path')->toArray();
               $clientEmails = explode(';', $ticketVisit->ticket->emails_notification);
               $firstRecipients = array_filter($clientEmails);
               $additionalEmails = ['karennavas333@gmail.com', 'andreadeveloper18@gmail.com'];
               $recipients = array_merge($firstRecipients, $additionalEmails);
               Log::info($recipients);
               
               if (!empty($recipients)) {

                    foreach ($recipients as $recipient) {

                        Mail::to($recipient)->send(new VisitaTicketMail($ticketVisit, $archivosAdjuntos, $employees));
                        Log::info("Si, se están enviando");
                    }

                //    Enviar el correo electrónico
                //    Mail::to($recipients)->send(new VisitaTicketMail($ticketVisit, $archivosAdjuntos, $employees));
                //    Log::info("Si, se están enviando");
               } else {
                   Log::error('No hay destinatarios especificados para el correo electrónico.');
               }

            } else {
                Log::info("Visita con instalacion tercerizada");
            }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket= Ticket::findOrFail($id);
        return view('modules.tickets.show', compact('ticket'));
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
        $ticket= Ticket::findOrFail($id);
        $ticket->ticket_issue                       = $request->ticket_issue;
        $ticket->ticket_issue                       = $request->ticket_issue;
        $ticket->priority_id                        = $request->priority_id;
        $ticket->employee_position_department_id    = $request->employee_position_department_id;
        $ticket->customer_id                        = $request->customer_id;
        $ticket->employee_id                        = $request->employee_id;
        $ticket->customer_service_id                = $request->customer_service_id;
        $ticket->description                        = $request->description;
        if (!$ticket->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al actualizar el registro.');
            return redirect()->back();
        }

        DB::commit();
        Alert::success('¡Éxito!', 'Registro actualizado correctamente');
        return redirect()->route('tickets.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
