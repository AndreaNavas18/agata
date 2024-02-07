<?php

use App\Http\Controllers\Submodules\SubmoduleController;

Route::middleware(['can:submodules_show'])->namespace('Submodules')->name('submodules.')->group(function () {

	Route::get('/submodules', [SubmoduleController::class, 'index'])->name('index')
		->middleware('can:submodules_show');

	Route::post('/submodules/crear', [SubmoduleController::class, 'store'])->name('store')
		->middleware('can:submodules_create');

	Route::put('/submodules/editar/{id}', [SubmoduleController::class, 'update'])->name('update')
		->where('id', '[0-9]+')
		->middleware('can:submodules_edit');

	Route::delete('/submodules/eliminar/{id}', [SubmoduleController::class, 'destroy'])->name('destroy')
		->where('id', '[0-9]+')
		->middleware('can:submodules_destroy');

	Route::get('/submodules/search', [SubmoduleController::class, 'search'])->name('search')
		->middleware('can:submodules_show');

});
