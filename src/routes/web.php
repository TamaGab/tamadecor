<?php

use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CLIENTS
    Route::group(['prefix' => 'clients'], function () {
        Route::get('', [ClientController::class, 'create'])->name('clients.create');
        // Route::get('edit/{id?}', [MessagesController::class, 'edit'])->name('messages.edit')->middleware('permission:messages.edit');
        // Route::post('save/{id?}', [MessagesController::class, 'save'])->name('messages.save')->middleware('permission:messages.save');
        // Route::post('saveAi/{id?}', [MessagesController::class, 'generateAiAndSave'])->name('messages.generateAiAndSave')->middleware('permission:messages.generateAiAndSave');
        // Route::get('delete/{id?}', [MessagesController::class, 'delete'])->name('messages.delete')->middleware('permission:messages.delete');
        // Route::get('view/{id}', [MessagesController::class, 'view'])->name('messages.view')->middleware('permission:messages.view');
    });
});


// Route::resource('clients', ClientController::class);

require __DIR__ . '/auth.php';
