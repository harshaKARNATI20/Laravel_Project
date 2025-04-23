<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminTicketController;

// Authentication Routes
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


// Default route redirecting to login page
Route::get('/', function () {
    return redirect()->route('login');
});

// Group routes that require authentication
Route::middleware(['auth'])->group(function () {


    // Ticket routes
    Route::get('tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('tickets/create', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::get('tickets/{ticket}/edit', [TicketController::class, 'edit'])->name('tickets.edit');
    Route::put('tickets/{ticket}', [TicketController::class, 'update'])->name('tickets.update');
    // Use DELETE method for deleting tickets for RESTful consistency
    Route::delete('tickets/delete/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');
    // Optional: keep GET route for delete confirmation page if needed
    Route::get('tickets/delete/{ticket}', [TicketController::class, 'delete'])->name('tickets.delete');

    Route::get('tickets/{ticket}/buy', [TicketController::class, 'buy'])->name('tickets.buy');
    Route::post('tickets/{ticket}/pay', [TicketController::class, 'pay'])->name('tickets.pay');

    // New route for user purchased tickets
    Route::get('my-purchases', [TicketController::class, 'myPurchases'])->name('tickets.my-purchases');

    // Admin ticket routes with admin middleware
    Route::prefix('admin/tickets')->middleware(['auth', 'admin'])->group(function () {
        Route::get('/', [AdminTicketController::class, 'index'])->name('admin.tickets.index');
        Route::get('/create', [AdminTicketController::class, 'create'])->name('admin.tickets.create');
        Route::post('/create', [AdminTicketController::class, 'store'])->name('admin.tickets.store');
        Route::get('/{ticket}', [AdminTicketController::class, 'show'])->name('admin.tickets.show');
        Route::get('/{ticket}/edit', [AdminTicketController::class, 'edit'])->name('admin.tickets.edit');
        Route::put('/{ticket}', [AdminTicketController::class, 'update'])->name('admin.tickets.update');
        Route::get('/delete/{ticket}', [AdminTicketController::class, 'delete'])->name('admin.tickets.delete');
        Route::post('/delete/{ticket}', [AdminTicketController::class, 'destroy'])->name('admin.tickets.destroy');
    });
});
