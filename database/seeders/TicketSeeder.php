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
        TicketPriority::firstOrCreate(['name' => 'Alta', 'color' => 'bg-danger']);
        TicketPriority::firstOrCreate(['name' => 'Media', 'color' => 'bg-warning']);
        TicketPriority::firstOrCreate(['name' => 'Baja', 'color' => 'bg-info']);
    }

}
