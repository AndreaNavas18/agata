<?php

namespace App\Models\Tickets;

use Illuminate\Database\Eloquent\Model;

class GeneralTypesPriority extends Model
{
    protected $table = 'general_types_priorities'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'name',
        'id_ticket_priority',
        // Otros campos
    ];

    // Relaciones con otros modelos si es necesario
    public function ticketPriority()
    {
        return $this->belongsTo(TicketPriority::class, 'id_ticket_priority');
    }
}
