<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Tickets\Ticket;
use App\Models\Tickets\TicketReply;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderEmail;

class CheckTicketResponse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tickets:check-response';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Revisar tickets sin respuesta pasadas las 24 horas';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   
        
        $thirtyHoursAgo = Carbon::now()->subHours(30);

        $tickets = Ticket::where('created_at', '<=', $thirtyHoursAgo)
        ->whereDoesntHave('replies', function ($query) {
            $query->where('created_at', '>=', Carbon::now()->subDay());
        })
        ->get();

        foreach ($tickets as $ticket) {
            $lastReply = $ticket->replies()->latest()->first();
            if ($lastReply && $lastReply->user->customer_id !== null) {
            Mail::to('karennavas333@gmail.com')->send(new ReminderEmail($ticket));
            }
        }

        // return Command::SUCCESS;
    }
}