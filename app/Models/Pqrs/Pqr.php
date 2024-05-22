<?php

namespace App\Models\Pqrs;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tickets\Ticket;
use App\Models\Pqrs\TemaPqr;
use App\Models\Customers\CustomerService;
use App\Models\Providers\Provider;
use App\Models\Employees\Employee;
use App\Models\Customers\Customer;
use App\Models\General\Proyecto;

class Pqr extends Model
{
    protected $table = 'pqrs'; 

    protected $fillable = [
        'created_by',
        'department',
        'tema_id',
        'service_id',
        'provider_id',
        'employee_id',
        'customer_id',
        'project_id',
        'issue',
        'description',
        'status',
        'ticket_id',
    ];

    //Relaciones

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function tema()
    {
        return $this->belongsTo(TemaPqr::class, 'ticket_id');
    }
}
