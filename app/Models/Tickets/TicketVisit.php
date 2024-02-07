<?php

namespace App\Models\Tickets;

use App\Models\BaseModel;
use App\Models\Employees\Employee;

class TicketVisit extends BaseModel {

	protected $table = 'tickets_visits';
	protected $fillable = [];
	protected $guarded = [];


    /* *************************************************************
	 * S C O P E S
	* *************************************************************/
    public function scopeIdentification($query, $identification)
    {
    	return $query->where('identification', 'like', '%'.$identification.'%');
    }

    /* *************************************************************
	 * relaciones
	* *************************************************************/

    public function employees() {
        return $this->belongsToMany(Employee::class, 'tickets_visits_employees', 'ticket_visit_id', 'employee_id')
            ->withTimestamps();
    }

}






