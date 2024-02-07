<?php

namespace App\Models\Tickets;

use App\Models\BaseModel;
use App\Models\Customers\Customer;
use App\Models\Employees\Employee;
use App\Models\Users\User;

class TicketReply extends BaseModel {

	protected $table = 'tickets_replies';
	protected $fillable = [];
	protected $guarded = [];


    /* *************************************************************
	 * S C O P E S
	* *************************************************************/
    public function scopeIdentification($query, $identification)
    {
    	return $query->where('identification', 'like', '%'.$identification.'%');
    }


    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function files()
    {
        return $this->hasMany(TicketReplyFile::class, 'ticket_replie_id');
    }

    public function ticketsVisits()
    {
        return $this->hasMany(TicketVisit::class, 'ticket_replie_id');
    }

}






