<?php

use App\Http\Controllers\Tickets\TicketController;
use App\Mail\NewTicketCreatedMailable;
use Illuminate\Support\Facades\Route;


/*
|-----------------------------------
| Home
|-----------------------------------
*/


Route::get('prueba',function () {
    Mail::to('andreadeveloper18@gmail.com')
        ->send(new NewTicketCreatedMailable);

        return 'Email enviado';

})->name('prueba');

Route::get('prueba2',function () {
    Mail::to('andreadeveloper18@gmail.com')
        ->send(new andreaDeveloper);

        return 'Email enviado';

})->name('prueba2');
