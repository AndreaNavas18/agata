<?php

namespace App\Models\Tickets;

use App\Models\BaseModel;
use App\Models\Tickets\TicketVisit;
use App\Models\Employees\EmployeeFile;

class TicketVisitFile extends BaseModel {

	protected $table = 'tickets_visits_files';
	protected $fillable = [];
	protected $guarded = [];

    /* *************************************************************
	 * S C O P E S
	* *************************************************************/
    public function scopeName($query, $name)
    {
    	return $query->where('name', $name);
    }

    public function visit()
    {
        return $this->belongsTo(TicketVisit::class, 'ticket_visit_id');
    }

    public function employeeFile()
    {
        return $this->belongsTo(EmployeeFile::class, 'employee_file_id');
    }

}






