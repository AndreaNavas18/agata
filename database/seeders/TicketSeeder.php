<?php

namespace Database\Seeders;

use App\Models\Tickets\TicketPriority;
use Illuminate\Database\Seeder;

class TicketSeeder  extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
    */
    public function run()
    {
        // prioridades
        TicketPriority::create(['name' => 'Alta', 'color' => 'bg-danger']);
        TicketPriority::create(['name' => 'Media', 'color' => 'bg-warning']);
        TicketPriority::create(['name' => 'Baja', 'color' => 'bg-info']);
    }

}
