<?php

namespace App\Models\Employees;

use App\Models\BaseModel;
use App\Models\General\TypeDocument;
use App\Models\Tickets\TicketVisit;
use App\Models\Users\User;

class Employee extends BaseModel {

	protected $table = 'employees';
	protected $fillable = [];
	protected $guarded = [];


    /* *************************************************************
	 * S C O P E S
	* *************************************************************/
    public function scopeIdentification($query, $identification)
    {
    	return $query->where('identification', 'like', '%'.$identification.'%');
    }

    public function scopeName($query, $name)
    {
    	return $query->where('full_name', 'like', '%'.$name.'%');
    }


	public function getShortNameAttribute()
    {
		$names =  $this->attributes['first_name'];
		$surnames =  $this->attributes['surname'];
		return $names." ".$surnames;
    }

    public function scopePositionId($query, $positionId)
    {
    	return $query->where('position_id', $positionId);
    }

    /* *************************************************************
	 * relaciones
	* *************************************************************/

    public function state()
    {
        return $this->belongsTo(EmployeeState::class, 'state_id');
    }

    public function position()
    {
        return $this->belongsTo(EmployeePosition::class, 'position_id');
    }

    public function typeDocument()
    {
        return $this->belongsTo(TypeDocument::class, 'type_document_id');
    }

    public function arl()
    {
        return $this->belongsTo(EmployeeArl::class, 'arl_id');
    }

    public function pension()
    {
        return $this->belongsTo(EmployeePensionFund::class, 'fund_pension_id');
    }

    public function cesantias()
    {
        return $this->belongsTo(EmployeeSeverance::class, 'severance_fund_id');
    }

    public function eps()
    {
        return $this->belongsTo(EmployeeEps::class, 'eps_id');
    }

	public function user()
    {
        return $this->hasOne(User::class);
    }

    public function files()
    {
        return $this->hasMany(EmployeeFile::class,'employee_id');
    }

    public function ticketsVisits() {
        return $this->belongsToMany(TicketVisit::class, 'tickets_visits_employees', 'employee_id', 'ticket_visit_id')
            ->withTimestamps();
    }


}






