<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        $notification->markAsRead();

        // Redirigir al usuario al ticket correspondiente
        return redirect()->route('tickets.manage', $notification->data['ticket_id']);
    }
}
