<?php

namespace App\Models\Pqrs;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tickets\Ticket;

class Pqr extends Model
{
    protected $table = 'pqrs'; 

    protected $fillable = [
        'created_by',
        'department',
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
}
