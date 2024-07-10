<?php

namespace App\Listeners;

use App\Events\TicketCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\TicketCreatedNotification;
use App\Models\Users\User;

class SendTicketCreatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\TicketCreated  $event
     * @return void
     */
    public function handle(TicketCreated $event)
    {
        //
        $users = User::all();
        foreach ($users as $user) {
            $user->notify(new TicketCreatedNotification($event->ticket));
        }
    }
}
