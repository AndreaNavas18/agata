public function manage($id, Request $request) {
    $user = Auth::user();
    $ticket = Ticket::findOrFail($id);
    $timeActually = Carbon::now();
    $technicals = Employee::positionId(1)->get();
    $employeesAll = Employee::all();
    $lastReplyId = TicketReply::latest()->first();

    if ($ticket->priority_id == 1) {
        if (strcasecmp($ticket->state_clock, 'Corriendo') === 0 && !is_null($ticket->datetime_clock)) {
            $datetimeClock = Carbon::parse($ticket->datetime_clock);
            $timeClockInterval = $timeActually->diff($datetimeClock);

            // Obtener horas, minutos y segundos de time_clock sin usar Carbon::parse
            list($hoursClock, $minutesClock, $secondsClock) = explode(':', $ticket->time_clock);

            // Sumar el tiempo actual al tiempo guardado en time_clock
            $totalSeconds = ($hoursClock * 3600 + $minutesClock * 60 + $secondsClock) +
                            ($timeClockInterval->h * 3600 + $timeClockInterval->i * 60 + $timeClockInterval->s);

            $hoursClock = floor($totalSeconds / 3600);
            $totalSeconds %= 3600;
            $minutesClock = floor($totalSeconds / 60);
            $secondsClock = $totalSeconds % 60;

            // Formatear el resultado para mostrarlo en HH:MM:SS
            $timeClock = sprintf('%02d:%02d:%02d', $hoursClock, $minutesClock, $secondsClock);
            Log::info("ENTRO: ".$timeClock);
        } else {
            $timeClock = $ticket->time_clock;
            Log::info("timeClock: ".$timeClock);
            list($hoursClock, $minutesClock, $secondsClock) = explode(':', $timeClock);
        }
    } else {
        $hoursClock = NULL;
        $minutesClock = NULL;
        $secondsClock = NULL;
    }

    Log::info("horas,minutos,segundos: ".$hoursClock." ".$minutesClock." ".$secondsClock);

    $customersList = Customer::get();
    $positionsDepartmanets = EmployeePositionDepartment::get();
    $prioritiesList = TicketPriority::get();
    $serviceList = CustomerService::customerId($ticket->customer_id)->get();
    $employeesList = Employee::whereHas('position', function($q) use($ticket) {
        return $q->where('employees_positions.department_id', $ticket->employee_position_department_id);
    })->get();

    $action = $request->input('action');

    \Log::info("Estado del tickedttt: ".$ticket->state);

    if ($action === 'manage'){
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
    } else {
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

Ajuste de la Vista
Asegúrate de que la vista maneje correctamente el tiempo calculado y lo formatee adecuadamente
JAVASCRIPT

var clearTime;
var seconds = {{ $secondsClock }},
    minutes = {{ $minutesClock }},
    hours = {{ $hoursClock }};
var secs, mins, gethours;

function startWatch() {
    if (seconds === 60) {
        seconds = 0;
        minutes = minutes + 1;
    }

    mins = minutes < 10 ? "0" + minutes : minutes;

    if (minutes === 60) {
        minutes = 0;
        hours = hours + 1;
    }

    gethours = hours < 10 ? "0" + hours : hours;
    secs = seconds < 10 ? "0" + seconds : seconds;

    document.getElementById("clockHour").innerHTML = gethours;
    document.getElementById("clockMinute").innerHTML = mins;
    document.getElementById("clockSecond").innerHTML = secs;

    seconds++;

    clearTime = setTimeout(startWatch, 1000);
}

window.addEventListener("load", function() {
    startWatch();
});


Conclusión
Con estos ajustes, tu aplicación debería poder manejar y mostrar correctamente los tiempos superiores a 24 horas sin problemas, tanto cuando el reloj está corriendo como cuando está detenido. Asegúrate de probar estos cambios para confirmar que funcionan según lo esperado