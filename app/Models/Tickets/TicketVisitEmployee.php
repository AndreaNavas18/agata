<?php

namespace App\Models\Tickets;

use App\Models\BaseModel;

class TicketVisitEmployee extends BaseModel {

	protected $table = 'tickets_visits_employees';
	protected $fillable = [];
	protected $guarded = [];


    /* *************************************************************
	 * S C O P E S
	* *************************************************************/
    public function scopeIdentification($query, $identification)
    {
    	return $query->where('identification', 'like', '%'.$identification.'%');
    }
}






