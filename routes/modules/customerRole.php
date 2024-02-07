<?php

use App\Http\Controllers\CustomerRole\HomeCustomerController;

/*
|-----------------------------------
| Home
|-----------------------------------
*/


Route::get('/cliente/inicio', [HomeCustomerController::class, 'index'])->name('customer.home');
