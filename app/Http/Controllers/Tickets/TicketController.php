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
use App\Models\Tickets\GeneralTypesPriority;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\andreaDeveloper;
use App\Mail\newAnswer;
use App\Mail\answerSoporte;
use App\Mail\NewTicketClient;
use App\Mail\ticketSoporte;
use App\Mail\TicketAsignado;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    /**
     * Muestra la página de listado de tickets.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Obtener una instancia de consulta en lugar de una colección
        $tickets = Ticket::query();
        $user = Auth::user();
        $customerServices = null;
        $priorities = TicketPriority::all();
        $customers = Customer::all();
        $employees = Employee::all();
        $providers = Provider::all();

        // Verificar si el usuario tiene el rol con ID 2, 3, 7 o 8
        if($user->role_id == 2 || $user->role_id == 3 || $user->role_id == 7 || $user->role_id == 8) {
           
            $states = Ticket::distinct()->pluck('state')->toArray();    
            $customerId = Auth()->user()->customer_id;
            $tickets = Ticket::where('customer_id', $customerId)
                ->orderBy('id', 'DESC')
                ->paginate();
            $customerServices = CustomerService::where('customer_id', $user->customer_id)->get();
            // $tickets = $tickets->paginate();
            
            return view('modules.tickets.index', compact(
                'tickets', 
                'customerServices', 
                'states',
                'priorities',
                'customers',
                'employees',
                'providers'
            ));

        }else {

            $tickets = Ticket::orderBy('id', 'DESC')->paginate();
            $priorities = TicketPriority::all();
            $customers = Customer::all();
            $employees = Employee::all();
            $providers = Provider::all();
    
            // Definir un array de estados
            $states = Ticket::distinct()->pluck('state')->toArray();  

            // $states = ['Abierto', 'Cerrado'];
    
            // Devolver la vista 'modules.tickets.index' con los datos necesarios
            return view('modules.tickets.index', compact(
                'tickets',
                'priorities',
                'customers',
                'employees',
                'providers',
                'states',
                'customerServices',
            ));

            }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Busqueda funcional para los tickets --karen--

    public function search(Request $request) {

        $tickets = Ticket::query();
        // Obtener el usuario logueado
        $user = Auth::user();
        
        // Verificar si el usuario tiene un cliente asociado
        if ($user->role_id == 2 || $user->role_id == 3 || $user->role_id == 7 || $user->role_id == 8) {
            
            $ticketIssue = strtolower($request->input('ticket_issue'));
            $customerServiceId = $request->input('customer_service_id');
            // $states = $request->input('states');
            // Obtener los servicios asociados al cliente del usuario
            $customerServices = CustomerService::where('customer_id', $user->customer_id)->get();
            $selectedState = $request->input('state');
            
            $query = Ticket::query();
            
            // Aplicar la búsqueda por asunto si se proporcionó
            if (!empty($ticketIssue)) {
                $query->where('ticket_issue', 'LIKE', "%$ticketIssue%");
            }
            
            // Aplicar la búsqueda por servicio si se seleccionó
            if (!empty($customerServiceId)) {
                $query->where('customer_service_id', $customerServiceId);
            }
            
            // Aplicar la búsqueda por estado si se seleccionó
            if (!empty($selectedState)) {
                $query->where('state', $selectedState);
            }
        
            // Ordenar los resultados
            $states = Ticket::distinct()->pluck('state')->toArray();    
            $tickets = $query->orderBy('ticket_issue')->paginate();
            $data = $request->all();
            
            // Pasar los servicios al formulario
            return view('modules.tickets.index', 
            ['customerServices' => $customerServices], 
            compact('tickets', 'data', 'states'));

        }
        else{

            $ticketIssue = strtolower($request->input('ticket_issue'));

            $priorityId = $request->input('priority_id');
            //Obtener las prioridades asociadas al ticket
            $priorities = TicketPriority::where('id', $priorityId)->get();

            //Agente-empleado
            $employeeId = $request->input('employee_id');
            $employees = Employee::where('id', $employeeId)->get();

            //Cliente
            $customerId = $request->input('customer_id');
            $customers = Customer::where('id', $customerId)->get();

            //Servicio
            $customerServiceId = $request->input('customer_service_id');
            $customerServices = CustomerService::where('customer_id', $customerId)->get();

            //Proveedor
            $providerId = $request->input('provider_id');
            $providers = Provider::where('id', $providerId)->get();
            
            $selectedState = $request->input('state');

            // Obtener las fechas de inicio y fin del request
            $startDate = $request->input('start_date');
            $finalDate = $request->input('final_date');

            $query = Ticket::query();

             // Aplicar la búsqueda por asunto si se proporcionó
             if (!empty($ticketIssue)) {
                $query->where('ticket_issue', 'LIKE', "%$ticketIssue%");
            }

             // Aplicar la búsqueda por prioridad si se proporcionó
             if (!empty($priorityId)) {
                $query->where('priority_id', $priorityId);
            }

            if(!empty($employeeId)) {
                $query->where('employee_id', $employeeId);
            }

            if(!empty($customerId)) {
                $query->where('customer_id', $customerId);
            }

            // Aplicar la búsqueda por servicio si se seleccionó
            if (!empty($customerServiceId)) {
                $query->where('customer_service_id', $customerServiceId);
            }

            if (!empty($providerId)) {
                $query->join('customers_services as cs', 
                'tickets.customer_service_id', '=', 'cs.id')
              ->where('cs.provider_id', $providerId);
            }

            // Aplicar la búsqueda por estado si se seleccionó
            if (!empty($selectedState)) {
                $query->where('state', $selectedState);
            }

            // Condición para filtrar por fecha si se proporcionan las fechas de inicio y fin
            if (!empty($startDate) && !empty($finalDate)) {
                // Convertir las fechas a objetos Carbon para realizar la comparación
                $start = Carbon::parse($startDate);
                $end = Carbon::parse($finalDate)->endOfDay();

                // Condición para buscar los tickets en el rango de fechas
                $query->whereBetween('tickets.created_at', [$start, $end]);

                 // Agregar las fechas al array de datos que se pasará a la vista
                $data['start_date'] = $startDate;
                $data['final_date'] = $finalDate;
            }

            //Ordenar los resultados
            $states = Ticket::distinct()->pluck('state')->toArray(); 
            $tickets = $query->orderBy('ticket_issue')->paginate();
            $data = $request->all();

            return view('modules.tickets.index', [
                // 'customerServices' => $customerServices,
                'priorities' => $priorities,
                'employees' => $employees,
                'customers' => $customers,
                'customerServices' => $customerServices,
                'providers' => $providers,
                'tickets' => $tickets,
                'data' => $data,
                'states' => $states,
            ]);

            // return view('modules.tickets.index',
            // // ['customerServices' => $customerServices], 
            // ['priorities' => $priorities],
            // ['employees' => $employees],
            // compact(
            //     'tickets', 
            //     'data', 
            // )->with('states', $states));

        }
    }
    

    /**
     * Show the form for creating a new resource
     *
     * @return \Illuminate\Http\Response
     */
    public function create($serviceId = null)
    {
        $user = Auth::user();
        $customersList = Customer::get();
        $positionsDepartmanets = EmployeePositionDepartment::get();
        // $prioritiesList = TicketPriority::get();
        if ($user->role_id == 2 || $user->role_id == 3 || $user->role_id == 7 || $user->role_id == 8) {
            $prioritiesList = GeneralTypesPriority::all();
            $serviceList = CustomerService::customerId(Auth()->user()->customer_id)->get();
        } else {
            $prioritiesList = TicketPriority::all();
            $serviceList = [];
        }
        $date = Carbon::now()->format('Y-m-d');
        
        if($serviceId != null){
            Log::info($serviceId);
            Log::info("Si tiene servicio Id");
            //Quiero que le mande ese valor a la vista
            return view('modules.tickets.create', compact(
            'serviceId', 
            'customersList',
            'positionsDepartmanets',
            'prioritiesList',
            // 'serviceArray',
            'serviceList',
            'date'));
        }

        return view('modules.tickets.create', compact(
            'customersList',
            'positionsDepartmanets',
            'prioritiesList',
            // 'serviceArray',
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
        $user = Auth::user();
        $serviceId = $request->customer_service_id;
        $si = "Si";

        $ticket = new Ticket();
        $ticket->ticket_issue                       = $request->ticket_issue;
        $ticket->date                               = $request->date;
        $ticket->send_email                         = $si;
        $ticket->other_priority                     = $request->other_priority;

        
        // Verifica el rol del usuario y establece la prioridad adecuada
        if ($user->role_id == 2 || $user->role_id == 3 || $user->role_id == 7 || $user->role_id == 8) {
            
            // Que si la prioridad que da es otro motivo la guarde en other_priority
            if($request->filled('other_priority')) {
                $ticket->priority_id = 3;
                $ticket->customer_service_id = $serviceId;
            }else {
                // Si el usuario es cliente (rol == 2), establece la prioridad basada en general_types_priorities
                $priority = GeneralTypesPriority::find($request->priority_id); // Obtén la prioridad correspondiente desde la tabla general_types_priorities
                $ticket->priority_id = $priority->ticketPriority->id; // Asigna la prioridad de la tabla general_types_priorities al ticket
                $ticket->customer_service_id = $serviceId;
                $ticket->other_priority = null;
            }

        } else {
            // Si el usuario no es cliente, utiliza la prioridad proporcionada en el formulario
            $ticket->priority_id                        = $request->priority_id;
            $ticket->customer_service_id                = $request->customer_service_id;
            $ticket->other_priority = null;

        }


        // $ticket->priority_id                        = $request->priority_id;
        $ticket->state                              = 'Abierto';
        $ticket->description                        = $request->description;
      
        // $ticket->send_email                         = $request->send_email;
        if ($request->filled('emails_notification')) {
            $ticket->emails_notification                = $request->emails_notification;
        }else {
            if($user->role_id == 1 || $user->role_id == 6){
                $ticket->emails_notification = '';
            }else {
                $ticket->emails_notification = '';

            }
        }
        if ($user->role_id == 2 || $user->role_id == 3 || $user->role_id == 7 || $user->role_id == 8) {
            $ticket->customer_id                    = Auth()->user()->customer_id;
        } else {
            $ticket->customer_id                        = $request->customer_id;
            $ticket->employee_position_department_id    = $request->employee_position_department_id;
            $ticket->employee_id                        = $request->employee_id;
        }

        //corre el reloj si es prioridad alta el ticket
        Log::info($request->priority_id);
        if ($request->priority_id == 1) {
            $ticket->state_clock                    = 'Corriendo';
            $ticket->datetime_clock                 = Carbon::now();
            $ticket->time_clock                     = '00:00:00';
        } else {
            $ticket->state_clock                    = 'Detenido';
            Log::info("Si llego como detenido");
        }
        Log::info($ticket->state_clock);
        if (!$ticket->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al insertar registro.');
            return redirect()->back();
        }
            // Pasa el ticket como dato de sesión
            // session()->put('ticket', $ticket);


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
        // Log::info("Send email", $ticket->send_email);


        DB::commit();
        Alert::success('¡Éxito!', 'Registro insertado correctamente');
        // Verificar si el usuario ha optado por enviar un correo electrónico
        $this->sendEmail($ticket, $request->input('emails_notification'));
      
        return redirect()->route('tickets.index')->with('ticket', $ticket);
    
    }

    public function sendEmail(Ticket $ticket, $emails)
    {
        Mail::to(['soporte@stratecsa.com', 'karennavas333@gmail.com'])->send(new ticketSoporte($ticket));
        //Si fue el cliente quien creo el ticket, no va haber un empleado asigando y se enviaran dos series de correo distintas
        if (is_null($ticket->employee)) {
            $agentEmail = 'soporte@stratecsa.com';

            if (!empty($agentEmail) || !empty($emails)) {

                // Envía correo al agente asignado si está presente
                if (!empty($agentEmail)) {
                    Mail::to($agentEmail)->send(new ticketSoporte($ticket));
                }
    
                if (!empty($emails)) {
                    // Envía correos electrónicos a cada dirección de correo especificada por el usuario
                    foreach (explode(';', $emails) as $email) {
                        Mail::to(trim($email))->send(new NewTicketClient($ticket));
                    }
                }
            } else {
                // Maneja el caso en que no haya destinatarios especificados
                Log::error('No hay destinatarios especificados para el correo electrónico.');
            }

        } else {
           //Si fue soporte quien creo el ticket, se le envia esto al cliente y a soporte
           $agentEmail = $ticket->employee->email;
           
            if (!empty($agentEmail) || !empty($emails)) {

                // Envía correo al agente asignado si está presente
                if (!empty($agentEmail)) {
                    Mail::to($agentEmail)->send(new ticketSoporte($ticket));
                }

                if (!empty($emails)) {
                    // Envía correos electrónicos a cada dirección de correo especificada por el usuario
                    foreach (explode(';', $emails) as $email) {
                        Mail::to(trim($email))->send(new andreaDeveloper($ticket));
                    }
                }
            } else {
                // Maneja el caso en que no haya destinatarios especificados
                Log::error('No hay destinatarios especificados para el correo electrónico.');
            }

        }

        Log::info('Agent Email: ' . $agentEmail);
        Log::info('Emails: ' . $emails);

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
        $si = "Si";


        $ticket = Ticket::findOrFail($id);
        $ticket->ticket_issue                       = $request->ticket_issue;
        $ticket->ticket_issue                       = $request->ticket_issue;
        $ticket->priority_id                        = $request->priority_id;
        $ticket->employee_position_department_id    = $request->employee_position_department_id;
        $ticket->customer_id                        = $request->customer_id;
        $ticket->employee_id                        = $request->employee_id;
        $ticket->customer_service_id                = $request->customer_service_id;
        $ticket->description                        = $request->description;
        $ticket->send_email                         = $si;
        $ticket->other_priority                     = $request->other_priority;

        if ($request->filled('emails_notification')) {
            $ticket->emails_notification                = $request->emails_notification;
        }
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
        try {
            DB::beginTransaction();
            if (!Ticket::findOrFail($id)->delete()) {
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


    public function manage($id, Request $request) {

        $user = Auth::user();
        $ticket= Ticket::findOrFail($id);
        $timeActually= Carbon::now();
        $technicals= Employee::positionId(1)->get();
        $employeesAll = Employee::all();
        $lastReplyId = TicketReply::latest()->first();
            if ($ticket->priority_id == 1) {
                if(strcasecmp($ticket->state_clock, 'Corriendo') === 0 && !is_null($ticket->datetime_clock)) {
                    // $timeSaved = Carbon::parse($ticket->time_clock);
                    // $timeClock = Ticket::calculateTimeClock($timeActually, $ticket);
                    // $timeClock = date('H:i:s', $timeSaved->timestamp + strtotime($timeClock)); 

                    $timeSaved = Carbon::parse($ticket->time_clock);
                    $datetimeClock = Carbon::parse($ticket->datetime_clock);
                    $timeClockInterval = $timeActually->diff($datetimeClock);
                    $timeClock = $timeClockInterval->format('%H:%I:%S');
                    $timeSaved->addHours($timeClockInterval->h)
                    ->addMinutes($timeClockInterval->i)
                    ->addSeconds($timeClockInterval->s);
                    // $timeClock = Ticket::calculateTimeClock($timeActually, $ticket);

                    // Convertimos el tiempo del reloj calculado a un objeto Carbon
                    // $timeClockCarbon = Carbon::createFromFormat('H:i:s', $timeClock);

                    // Sumamos el tiempo del reloj calculado al tiempo guardado previamente
                    // $timeClock = $timeSaved->addHours($timeClockCarbon->hour)->addMinutes($timeClockCarbon->minute)->addSeconds($timeClockCarbon->second);
                    $timeClock = $timeSaved->format('H:i:s');
                    Log::info("ENTRO: ".$timeClock);

                } else {
                    // Calculate the time difference between created_at and current date
                        // $createdAt = Carbon::parse($ticket->created_at);
                        // $now = Carbon::parse($timeActually);
                        // $timeDifference = $now->diff($createdAt);

                    // Format the time difference as hours, minutes, and seconds
                    // $timeClock = $timeDifference->format('%H:%I:%S');
                    $timeClock = $ticket->time_clock;
                    Log::info("timeClock: ".$timeClock);
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

        Log::info("horas,minutos,segundos: ".$hoursClock." ".$minutesClock." ".$secondsClock);

        $customersList= Customer::get();
        $positionsDepartmanets= EmployeePositionDepartment::get();
        $prioritiesList= TicketPriority::get();
        $serviceList= CustomerService::customerId($ticket->customer_id)->get();
        $employeesList= Employee::whereHas('position', function($q) use($ticket) {
            return $q->where('employees_positions.department_id', $ticket->employee_position_department_id);
        })->get();

        $action = $request->input('action');

        if($action === 'manage'){
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
                'technicals',
                'employeesAll',
                'lastReplyId'
            ));
        }else {
            $allowedRoles = [2, 3, 7, 8];
            if (in_array($user->role_id, $allowedRoles)){
                return view('modules.tickets.show', compact(
                    'hoursClock',
                    'minutesClock',
                    'secondsClock',
                    'ticket',
                    'customersList',
                    'positionsDepartmanets',
                    'prioritiesList',
                    'serviceList',
                    'employeesList',
                    'technicals',
                    'employeesAll',
                    'lastReplyId'

                ));
            } else {
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
                    'technicals',
                    'employeesAll',
                    'lastReplyId'

                ));
            }
        }


    }

    //Para customer_manage
    

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
        $ticketReply                        = new TicketReply();
        $ticketReply->replie                = $request->replie;
        $ticketReply->ticket_id             = $ticket->id;
        $ticketReply->user_id               = Auth()->user()->id;

       if($ticket->priority_id == 1){
           if($request->state == 'Cerrado'){
               $ticket->state_clock = 'Detenido';
               $ticket->time_clock         = Ticket::calculateTimeClock($timeActually, $ticket);
               $ticket->datetime_clock     = $timeActually;
           }
       }else {
           if($request->state == 'Cerrado'){
               $ticket->state = 'Cerrado';
           }
        }

        if (!$ticketReply->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al insertar el registro.');
            return redirect()->back();
        }

        if($ticket->customer_id == Auth()->user()->customer_id) {
            Log::info("AQUI ESTAMOS REY" .$ticket->state_clock);
            if($ticket->priority_id == 1){
                if($ticket->state_clock == 'DETENIDO'){
                    $ticket->state_clock        = 'CORRIENDO';
                    $ticket->datetime_clock     = $timeActually; 
                }
            }
            $ticketReply->customer_id      = Auth()->user()->customer_id;
    
        } else {
            $ticketReply->employee_id      = Auth()->user()->employee_id;
            //actualizar el ticket
            if(strcasecmp(strtolower($request->state_clock), strtolower($ticket->state_clock)) !== 0){
                if ($request->filled('state_clock')) {
                    Log::info("Este es el estado del ticketclock".$ticket->state_clock);
                    if ($request->state_clock == 'Corriendo') {
                        $ticket->state_clock        = $request->state_clock;
                        $ticket->datetime_clock     = $timeActually;
                        Log::info("Efectivamente es corriendo");
                        Log::info($request->state_clock);
                    } else {
                        Log::info("No, no fue corriendo");
                        Log::info($request->state_clock);
                        if ($request->state_clock != $ticket->state_clock) {
                            //se esta deteniendo el reloj
                            $ticket->state_clock        = $request->state_clock;
                            $ticket->time_clock         = Ticket::calculateTimeClock($timeActually, $ticket);
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
            }else {

            }
            
        }

        //guardar info ticket
        if (!$ticket->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al insertar la respuesta.');
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
                    Alert::error('Error', 'Error al insertar la respuesta.');
                    return redirect()->back();
                }
            }
        }
        // Le voy a pasar el ticket y la ultima respuesta
        $this->sendEmailAnswer($ticket);
        // $this->sendEmailAnswer($ticket);
        DB::commit();
        Alert::success('¡Éxito!', 'Respuesta insertada correctamente');
        return redirect()->back();
    }

    public function sendEmailAnswer (Ticket $ticket){
        // Obtener la última respuesta al ticket
        $lastReply = TicketReply::where('ticket_id', $ticket->id)->latest()->first();

        if ($lastReply) {
            // Obtener el usuario que respondió al ticket
            $responder = $lastReply->user;

            // Si el usuario tiene un customer_id, es un cliente
            if ($responder->customer_id) {
                // Enviar correo al empleado asignado y a soporte
                if ($ticket->employee_id) {
                    // Si hay un agente asignado, enviar correo al agente y a soporte
                   // Verificar si el correo electrónico del agente es válido
                   $employeeEmail = $ticket->employee->email;
                   $supportEmail = 'soporte@stratecsa.com';
                   $validator = Validator::make(['email' => $employeeEmail], ['email' => 'email']);

                    if($validator->fails() || empty($employeeEmail)) {
                        $recipients = [$supportEmail];
                    }else{
                        $recipients = [$employeeEmail, $supportEmail];
                    }
                } else {
                    // Si no hay agente asignado, enviar correo únicamente a soporte
                    $recipients = ['soporte@stratecsa.com'];
                }

                if (!empty($recipients)) {
                    // Enviar el correo electrónico
                    foreach ($recipients as $recipient) {
                        //NUEVA PLANTILLA
                        Mail::to($recipient)->send(new answerSoporte($ticket, $lastReply));
                        Log::info("Si, se estan enviando");
                    }
                }else {
                    Log::error('No hay destinatarios especificados para el correo electrónico.');
                }

            } else {
                // Si el usuario no tiene un customer_id, es un empleado
                // Enviar correo al cliente
                Log::info("Es un empleado el que respondio");
                $clientEmails = explode(';', $ticket->emails_notification);
                $recipients = array_filter($clientEmails);
                // dd($recipients);
                Log::info($recipients);

                if (!empty($recipients)) {
                    // Enviar el correo electrónico
                    
                    foreach ($recipients as $recipient) {
                        Mail::to($recipient)->send(new newAnswer($ticket, $lastReply));
                        Log::info("Si, se estan enviando");
                    }
                }else {
                    Log::error('No hay destinatarios especificados para el correo electrónico.');
                }
            }
           
        } else {
            // Manejar el caso en que no haya respuestas al ticket
            Log::error('No se ha encontrado una respuesta al ticket.');
        }
    }

    //funcion para que un boton cambie el estado de cerrado a abierto en un ticket 
    public function reopen(Request $request, $id) {
        DB::beginTransaction();
        try {
            $ticket = Ticket::findOrFail($id);
    
            // Verificamos si el estado actual es 'CERRADO' para cambiarlo a 'ABIERTO'
            if($ticket->state == 'CERRADO') {
                $ticket->state = 'ABIERTO';
                if($ticket->priority_id == 1) {
                    $ticket->state_clock = 'Corriendo';
                    $ticket->datetime_clock = Carbon::now();
                }else{

                }
                $ticket->save();
                DB::commit();
                Alert::success('Bien hecho!', 'El estado del ticket se ha cambiado a ABIERTO');
            } else {
                DB::rollBack();
                Alert::warning('Advertencia', 'El ticket no está cerrado, no se puede reabrir.');
            }
    
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Error al cambiar el estado del ticket.');
        }
    
        return redirect()->back();
    }

    public function getEmployeeFiles(Request $request) {
        $employeeIds = $request->input('employeeIds', []);
        $data = [];
    
        foreach ($employeeIds as $employeeId) {
            $employee = Employee::findOrFail($employeeId);
            $employeeName = $employee->short_name;
            $files = $employee->files->pluck('id', 'name_original')->toArray(); // Modificación aquí
    
            // Agregar el nombre del empleado y los IDs de sus archivos al array de datos
            $data[] = [
                'employeeName' => $employeeName,
                'files' => $files,
            ];
        }
    
        return response()->json($data);
    }

    public function asignarAgente(Request $request, $id) {
            DB::beginTransaction();
    
            $ticket = Ticket::findOrFail($id);
            // $positionsDepartmanets = EmployeePositionDepartment::get();
            // $employees = Employee::where('position_id', $request->employee_position_department_id)->get();
            
            //Actualizo el ticket
            $ticket->employee_position_department_id = $request->employee_position_department_id;
            $ticket->employee_id = $request->employee_id;
            
            //imprimir en logs lo que llega por request 
            Log::info($request->employee_id);
            Log::info($request->employee_position_department_id);

            if (!$ticket->save()) {
                DB::rollBack();
                Alert::error('Error', 'Error al asignar el agente.');
                return redirect()->back();
            }
            
            // Verificar si se asigno un agente al ticket
            
        DB::commit();
        Alert::success('Success!', 'Agente asignado correctamente');
            
        $this->sendEmailAgent($ticket, $request->input('employee_id'));
        return redirect()->back();
    }

    public function sendEmailAgent(Ticket $ticket, $employeeId)
    {
        // Obtener el correo electrónico del agente asignado
        $agentEmail = Employee::find($employeeId)->email;

        // Verificar si el correo electrónico del agente no está vacío
        if (!empty($agentEmail)) {
            // Enviar correo electrónico al agente asignado
            Mail::to($agentEmail)->send(new TicketAsignado($ticket));
        } else {
            // Manejar el caso en que el correo electrónico del agente esté vacío
            Log::error('No se ha especificado un correo electrónico para el agente asignado.');
        }

    }

    public function cambiarPrioridad(Request $request, $id) {
        DB::beginTransaction();
        
        try{
            $ticket = Ticket::findOrFail($id);
            // $positionsDepartmanets = EmployeePositionDepartment::get();
            // $employees = Employee::where('position_id', $request->employee_position_department_id)->get();
            
            //Actualizo el ticket
            $ticket->priority_id = $request->priority_id;
            
            //imprimir en logs lo que llega por request 
            Log::info($request->priority_id);
            $ticket->save();

            DB::commit();
            Alert::success('Success!', 'Prioridad asignada correctamente');
        }catch (\Exception $e){
            DB::rollBack();
            Alert::error('Error', 'Error al asignar la prioridad al ticket.');
        }
        return redirect()->back();
    }
    



}
