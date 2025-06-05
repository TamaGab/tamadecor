<?php

use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CLIENTES
    Route::prefix('clients')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->name('clients.index');       // listagem
        Route::get('/create', [ClientController::class, 'create'])->name('clients.create'); // formulário
        Route::post('/', [ClientController::class, 'store'])->name('clients.store');       // salvar
        Route::get('/{client}', [ClientController::class, 'show'])->name('clients.show');  // visualizar
        Route::get('/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit'); // editar
        Route::put('/{client}', [ClientController::class, 'update'])->name('clients.update');  // atualizar
        Route::delete('/{client}', [ClientController::class, 'destroy'])->name('clients.destroy'); // deletar
        Route::get('clients/search', [ClientController::class, 'search'])->name('clients.search');
    });

    // PEDIDOS
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');       // listagem
        Route::get('/create', [OrderController::class, 'create'])->name('orders.create'); // formulário
        Route::post('/', [OrderController::class, 'store'])->name('orders.store');       // salvar
        Route::get('/{order}', [OrderController::class, 'show'])->name('orders.show');  // visualizar
        Route::get('/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit'); // editar
        Route::put('/{order}', [OrderController::class, 'update'])->name('orders.update');  // atualizar
        Route::delete('/{order}', [OrderController::class, 'destroy'])->name('orders.destroy'); // deletar
    });

    // PRODUTOS
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');       // listagem
        Route::get('/create', [ProductController::class, 'create'])->name('products.create'); // formulário
        Route::post('/', [ProductController::class, 'store'])->name('products.store');       // salvar
        Route::get('/{product}', [ProductController::class, 'show'])->name('products.show');  // visualizar
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit'); // editar
        Route::put('/{product}', [ProductController::class, 'update'])->name('products.update');  // atualizar
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy'); // deletar
    });

    Route::get('/desenvolvimento', function () {
        return view('error.desenvolvimento');
    })->name('dev');
});

require __DIR__ . '/auth.php';
// Route::get('edit/{id?}', [MessagesController::class, 'edit'])->name('messages.edit')->middleware('permission:messages.edit');
        // Route::post('save/{id?}', [MessagesController::class, 'save'])->name('messages.save')->middleware('permission:messages.save');
        // Route::post('saveAi/{id?}', [MessagesController::class, 'generateAiAndSave'])->name('messages.generateAiAndSave')->middleware('permission:messages.generateAiAndSave');
        // Route::get('delete/{id?}', [MessagesController::class, 'delete'])->name('messages.delete')->middleware('permission:messages.delete');
        // Route::get('view/{id}', [MessagesController::class, 'view'])->name('messages.view')->middleware('permission:messages.view');
