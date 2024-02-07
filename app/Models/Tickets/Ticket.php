<?php

namespace App\Models\Tickets;

use App\Models\BaseModel;
use App\Models\Customers\Customer;
use App\Models\Customers\CustomerService;
use App\Models\Employees\Employee;
use App\Models\Employees\EmployeePositionDepartment;
use App\Models\Helpers;

class Ticket extends BaseModel {

	protected $table = 'tickets';
	protected $fillable = [];
	protected $guarded = [];


    /* *************************************************************
	 * S C O P E S
	* *************************************************************/
        // Scopes
        public function scopeDate($query, $date)
        {
            return $query->where('date', $date);
        }

        public function scopeDateBetween($query, $startDate, $finalDate)
        {
            return $query->whereBetween('date', [$startDate, $finalDate]);
        }

        public function scopeTicketIssue($query, $issue)
        {
            return $query->where('ticket_issue', 'LIKE', '%"'.$issue.'%');
        }

        public function scopePriorityId($query, $priorityid)
        {
            return $query->where('priority_id', $priorityid);
        }

        public function scopeDepartmentPositionId($query, $positionDepartmentId)
        {
            return $query->where('employee_position_department_id', $positionDepartmentId);
        }

        public function scopeCustomerId($query, $customerId)
        {
            return $query->where('customer_id', $customerId);
        }

        public function scopeEmployeeId($query, $employeeId)
        {
            return $query->where('employee_id', $employeeId);
        }

        public function scopeCustomerServiceId($query, $customerServiceId )
        {
            return $query->where('employee_id', $customerServiceId );
        }

        public function scopeState($query, $state )
        {
            return $query->where('state', $state );
        }


    /* *************************************************************
	 * relaciones
	* *************************************************************/

    /**
     * Get the user that owns the Ticket
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function priority()
    {
        return $this->belongsTo(TicketPriority::class, 'priority_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function service()
    {
        return $this->belongsTo(CustomerService::class, 'customer_service_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function department()
    {
        return $this->belongsTo(EmployeePositionDepartment::class, 'employee_position_department_id');
    }

    public function replies()
    {
        return $this->hasMany(TicketReply::class, 'ticket_id');
    }

    public function ticketsVisits()
    {
        return $this->hasMany(TicketVisit::class, 'ticket_id');
    }

    public static function buscar($data,$objetoId,$modulo) {
        $tickets = new Ticket();
        $tickets= $tickets->with(
            'department:id,name',
            'priority:id,name',
            'customer:id,name',
            'service',
            'service.city:id,name',
            'service.service:id,name',
            'employee',
        );

        //si la consulta viene desde clientes o proveedores
        if ($modulo=='customers') {
            $tickets = $tickets->customerId($objetoId);
        } else if ($modulo=='providers') {
            $tickets = $tickets->whereHas('service', function($q) use($objetoId) {
                return $q->where('customers_services.provider_id',$objetoId);
            });
        }

        if (isset($data['start_date']) && !is_null($data['start_date']) &&
            isset($data['final_date']) && !is_null($data['final_date'])) {
            $tickets = $tickets->dateBetween($data['start_date'], $data['final_date']);
        }

        if (isset($data['ticket_issue']) && !is_null($data['ticket_issue']) ) {
            $tickets = $tickets->ticketIssue($data['ticket_issue']);
        }

        if (isset($data['priority_id']) && !is_null($data['priority_id']) ) {
            $tickets = $tickets->priorityId($data['priority_id']);
        }

        if (isset($data['employee_id']) && !is_null($data['employee_id']) ) {
            $tickets = $tickets->employeeId($data['employee_id']);
        }

        if (isset($data['customer_id']) && !is_null($data['customer_id']) ) {
            $tickets = $tickets->customerId($data['customer_id']);
        }

        if (isset($data['customer_service_id']) && !is_null($data['customer_service_id']) ) {
            $tickets = $tickets->customerServiceId($data['customer_service_id']);
        }

        if (isset($data['provider_id']) && !is_null($data['provider_id']) ) {
            $tickets = $tickets->whereHas('service', function($q) use($data) {
                return $q->where('customers_services.provider_id',$data['provider_id']);
            });
        }

        if (isset($data['state']) && !is_null($data['state']) ) {
            $tickets = $tickets->state($data['state']);
        }

        return $tickets;

    }

    public static function calculateTimeClock($timeActually,$ticket) {

        $timeToCompare= !is_null($ticket->datetime_clock) ? $ticket->datetime_clock : $ticket->created_at;
        $diffHoursHmS = Helpers::calcularDiffHoursHmS($timeActually, $timeToCompare);
        $hourClock = is_null($ticket->time_clock) ?  $diffHoursHmS : Helpers::sumaHora($ticket->time_clock, $diffHoursHmS);
        return $hourClock;
    }

}






