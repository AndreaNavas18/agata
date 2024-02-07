<?php

namespace App\Http\Controllers\Tickets;

use App\Exports\Tickets\TicketsExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customers\Customer;
use App\Models\Customers\CustomerService;
use App\Models\Employees\Employee;
use App\Models\Employees\EmployeePositionDepartment;
use App\Models\Providers\Provider;
use App\Models\Tickets\Ticket;
use App\Models\Tickets\TicketPriority;
use App\Models\Tickets\TicketReply;
use App\Models\Tickets\TicketReplyFile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    /**
     * Muestra la página de listado de tickets.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtener todos los tickets ordenados por ID de forma descendente
        $tickets = Ticket::orderBy('id', 'DESC');

        // Verificar si el usuario tiene el rol con ID 2
        if (Auth()->user()->role_id == 2) {
            // Si el usuario tiene el rol con ID 2, filtrar los tickets por su customer_id
            $tickets = $tickets->customerId(Auth()->user()->customer_id);
        }

        // Paginar los resultados de los tickets
        $tickets = $tickets->paginate();

        // Obtener todos los TicketPriorities, Customers, Employees y Providers
        $priorities = TicketPriority::get();
        $customers = Customer::get();
        $employees = Employee::get();
        $providers = Provider::get();

        // Definir un array de estados
        $states = ['Abierto', 'Cerrado'];

        // Devolver la vista 'modules.tickets.index' con los datos necesarios
        return view('modules.tickets.index', compact(
            'tickets',
            'priorities',
            'customers',
            'employees',
            'providers',
            'states',
        ));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $priorities = TicketPriority::get();
        $customers = Customer::get();
        $employees = Employee::get();
        $providers = Provider::get();
        $states = ['Abierto', 'Cerrado'];
        $data = $request->all();
        $tickets =  Ticket::buscar($data, null, 'tickets');
        if ($request->action == 'buscar') {
            $tickets = $tickets->paginate();
            return view('modules.tickets.index', compact(
                'tickets',
                'priorities',
                'customers',
                'employees',
                'providers',
                'states',
            ));
        } else {
            $tickets = $tickets->get();
            return (new TicketsExport($tickets))->download('tickets.xlsx');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customersList = Customer::get();
        $positionsDepartmanets = EmployeePositionDepartment::get();
        $prioritiesList = TicketPriority::get();
        if (Auth()->user()->role_id == 2) {
            $serviceList = CustomerService::customerId(Auth()->user()->customer_id)->get();
        } else {
            $serviceList = [];
        }
        $date = Carbon::now()->format('Y-m-d');

        return view('modules.tickets.create', compact(
            'customersList',
            'positionsDepartmanets',
            'prioritiesList',
            'serviceList',
            'date'
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
        $ticket = new Ticket();
        $ticket->ticket_issue                       = $request->ticket_issue;
        $ticket->date                               = $request->date;
        $ticket->priority_id                        = $request->priority_id;
        $ticket->customer_service_id                = $request->customer_service_id;
        $ticket->state                              = 'Abierto';
        $ticket->description                        = $request->description;
        $ticket->send_email                         = $request->send_email;
        if ($request->filled('emails_notification')) {
            $ticket->emails_notification                = $request->emails_notification;
        }
        if (Auth()->user()->role_id == 2) {
            $ticket->customer_id                    = Auth()->user()->customer_id;
        } else {
            $ticket->customer_id                    = $request->customer_id;
            $ticket->employee_position_department_id    = $request->employee_position_department_id;
            $ticket->employee_id                        = $request->employee_id;
        }

        //corre el reloj si es prioridad alta el ticket
        if ($request->priority_id == 1) {
            $ticket->state_clock                    = 'Corriendo';
        } else {
            $ticket->state_clock                    = 'Detenido';
        }

        if (!$ticket->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al insertar registro.');
            return redirect()->back();
        }

        //enviar correo al equipo de soporte
        // $emails=Db::table('emails_notifications_tickets')->pluck('email')->toArray();
        // if ($request->filled('employee_id')) {
        //     $employee= Employee::findOrFail($request->employee_id);
        //     if(!is_null($employee)) {
        //         $emails[]=$employee->email;
        //     }
        // }
        // Mail::send('emails.new_tickect', compact('ticket'), function ($message) use ($emails) {
        //     $message->to($emails)
        //     ->subject('nuevo ticket creado '.Carbon::now()->format('Y-m-d'));
        // });

        DB::commit();
        Alert::success('Success!', 'Registro insertado correctamente');
        return redirect()->route('tickets.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('modules.tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        $customersList = Customer::get();
        $positionsDepartmanets = EmployeePositionDepartment::get();
        $prioritiesList = TicketPriority::get();
        $serviceList = CustomerService::customerId($ticket->customer_id)->get();
        $employeesList = Employee::whereHas('position', function ($q) use ($ticket) {
            return $q->where('employees_positions.department_id', $ticket->employee_position_department_id);
        })->get();
        $date = $ticket->date;
        return view('modules.tickets.edit', compact(
            'ticket',
            'customersList',
            'positionsDepartmanets',
            'prioritiesList',
            'serviceList',
            'employeesList',
            'date'
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
        DB::beginTransaction();
        $ticket = Ticket::findOrFail($id);
        $ticket->ticket_issue                       = $request->ticket_issue;
        $ticket->ticket_issue                       = $request->ticket_issue;
        $ticket->priority_id                        = $request->priority_id;
        $ticket->employee_position_department_id    = $request->employee_position_department_id;
        $ticket->customer_id                        = $request->customer_id;
        $ticket->employee_id                        = $request->employee_id;
        $ticket->customer_service_id                = $request->customer_service_id;
        $ticket->description                        = $request->description;
        $ticket->send_email                         = $request->send_email;
        if ($request->filled('emails_notification')) {
            $ticket->emails_notification                = $request->emails_notification;
        }
        if (!$ticket->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al actualizar el registro.');
            return redirect()->back();
        }

        DB::commit();
        Alert::success('Success!', 'Registro actualizado correctamente');
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


    public function manage($id) {
        $ticket= Ticket::findOrFail($id);
        $timeActually= Carbon::now();
        $technicals= Employee::positionId(1)->get();
        if ($ticket->priority_id == 1) {
            if($ticket->state_clock == 'Corriendo' && !is_null($ticket->time_clock)) {
                $timeClock=Ticket::calculateTimeClock($timeActually, $ticket);
            } else {
                // Calculate the time difference between created_at and current date
                $createdAt = Carbon::parse($ticket->created_at);
                $now = Carbon::parse($timeActually);
                $timeDifference = $now->diff($createdAt);

                // Format the time difference as hours, minutes, and seconds
                $timeClock = $timeDifference->format('%H:%I:%S');
            }

            if(!is_null($timeClock) && !empty($timeClock)) {
                $explodeHour= explode(':',$timeClock);
                $hoursClock= $explodeHour[0];
                $minutesClock= $explodeHour[1];
                $secondsClock= $explodeHour[2];
            } else {
                $hoursClock= NULL;
                $minutesClock=  NULL;
                $secondsClock= NULL;
            }

        } else {
            $hoursClock= NULL;
            $minutesClock=  NULL;
            $secondsClock= NULL;
        }

        $customersList= Customer::get();
        $positionsDepartmanets= EmployeePositionDepartment::get();
        $prioritiesList= TicketPriority::get();
        $serviceList= CustomerService::customerId($ticket->customer_id)->get();
        $employeesList= Employee::whereHas('position', function($q) use($ticket) {
            return $q->where('employees_positions.department_id', $ticket->employee_position_department_id);
        })->get();

        return view('modules.tickets.manage', compact(
            'hoursClock',
            'minutesClock',
            'secondsClock',
            'ticket',
            'customersList',
            'positionsDepartmanets',
            'prioritiesList',
            'serviceList',
            'employeesList',
            'technicals'
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function employeesPositionDepartmant(Request $request)
    {
        return Employee::whereHas('position', function ($q) use ($request) {
            return $q->where('employees_positions.department_id', $request->positionDepartmentId);
        })->get();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function customerServices(Request $request)
    {
        return CustomerService::with('service')->customerId($request->customerId)->get();
    }

    public function replyStore(Request $request, $id)
    {
        if (!$request->filled('replie')) {
            Alert::error('Error', 'Debe ingresar una respuesta.');
            return redirect()->back();
        }
        //tiempo reloj
        $ticket = Ticket::findOrFail($id);
        $timeActually = Carbon::now();
        DB::beginTransaction();
        //nueva respuesta
        $ticketReply                    = new TicketReply();
        $ticketReply->replie           = $request->replie;
        $ticketReply->ticket_id         = $ticket->id;
        $ticketReply->user_id                = Auth()->user()->id;
        if (!$ticketReply->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al insertar el registro.');
            return redirect()->back();
        }

        if (Auth()->user()->role_id == 2) {
            $ticketReply->customer_id      = Auth()->user()->customer_id;
        } else {
            $ticketReply->employee_id      = Auth()->user()->employee_id;
            //actualizar el ticket
            if ($request->filled('state_clock')) {
                if ($request->state_clock == 'Corriendo') {
                    $ticket->state_clock        = $request->state_clock;
                } else {
                    if ($request->state_clock != $ticket->state_clock) {
                        //se esta deteniendo el reloj
                        $ticket->state_clock        = $request->state_clock;
                        $ticket->time_clock         = Ticket::calculateTimeClock($timeActually, $ticket);
                        $ticket->datetime_clock     = $timeActually;
                    }
                }
            } else {
                if ($ticket->state_clock == 'Corriendo' &&  !$request->filled('state_clock')) {
                    $ticket->state_clock        = 'Detenido';
                    $ticket->time_clock         = Ticket::calculateTimeClock($timeActually, $ticket);
                    $ticket->datetime_clock     = $timeActually;
                }
            }
            $ticket->state = $request->state;
            if (is_null($ticket->employee_id)) {
                $ticket->employee_id = $request->employee_id;
            }
        }

        //guardar info ticket
        if (!$ticket->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al insertar el registro.');
            return redirect()->back();
        }

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                // Obtener el archivo
                // Carpeta de destino
                $destinationPath = public_path('storage/tickects');
                // Generar un nombre de archivo único
                $slugArchivo = 'cedula_' . uniqid() . '.' . $file->getClientOriginalExtension();
                // Mover el archivo a la carpeta de destino
                $file->move($destinationPath, $slugArchivo);
                // Definir la ruta del archivo
                $path = 'tickects/' . $slugArchivo;
                //guardar en base de datos
                $ticketReplyFile                        = new TicketReplyFile();
                $ticketReplyFile->ticket_replie_id      = $ticketReply->id;
                $ticketReplyFile->name_original         = $file->getClientOriginalName();
                $ticketReplyFile->name_file             = $slugArchivo;
                $ticketReplyFile->path                  = $path;
                $ticketReplyFile->extension             = $file->getClientOriginalExtension();
                if (!$ticketReplyFile->save()) {
                    DB::rollBack();
                    Alert::error('Error', 'Error al insertar el registro.');
                    return redirect()->back();
                }
            }
        }

        //enviar correo al cliente
        // $contactsTickets=CustomerContact::customerId($ticket->customer_id)
        // ->typeContactId(1)
        // ->get();

        // if (count($contactsTickets)> 0) {
        //     foreach ($contactsTickets as $key => $contact) {
        //         Mail::send('emails.new_replie', compact('contact','ticket','ticketReply'), function($message) use ($contact,$ticket) {
        //             $message->to($contact->email)->subject('Nueva respuesta ticket Stratecsa, consecutivo '.$ticket->id);
        //         });
        //     }
        // }

        DB::commit();
        Alert::success('Success!', 'Registro insertado correctamente');
        return redirect()->back();
    }
}
