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
        $twentyFourHoursAgo = Carbon::now()->subHours(24);

        $tickets = Ticket::whereDoesntHave('replies', function ($query) use ($twentyFourHoursAgo) {
                            $query->where('created_at', '>=', $twentyFourHoursAgo);
                        })
                        ->get();

        $ticketsToSendEmail = [];

        foreach ($tickets as $ticket) {
            $lastReply = $ticket->replies()->latest()->first();
            if ($lastReply && $lastReply->user->customer_id !== null) {
                $ticketsToSendEmail[] = $ticket;
            }
        }

        if (!empty($ticketsToSendEmail)) {
            Mail::to('stratecsa@outlook.es')->send(new ReminderEmail($ticketsToSendEmail));
        }

        // return Command::SUCCESS;
    }
}