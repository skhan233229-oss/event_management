<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserEventController;
use App\Http\Controllers\AdminRegistrationController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TicketController;

// Home Route
Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Admin Routes
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Admin Dashboard
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Event CRUD Routes
        Route::resource('events', EventController::class);
// Add Ticket to Event
Route::post('/events/{event}/tickets', [TicketController::class, 'store'])
    ->name('events.tickets.store');
        // Category CRUD Routes
        Route::resource('categories', CategoryController::class);

        // Manage Registrations
        Route::get('/registrations', [AdminRegistrationController::class, 'index'])
            ->name('registrations.index');

        // Manage Users
        Route::get('/users', [AdminUserController::class, 'index'])
            ->name('users.index');

        // Update User Role
        Route::patch('/users/{user}/role', [AdminUserController::class, 'updateRole'])
            ->name('users.updateRole');

        // Delete User
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])
            ->name('users.destroy');
    });


// User Event Routes

// All Events
Route::get('/events', [UserEventController::class, 'index'])
    ->name('events.index');

// AJAX Event Search
Route::get('/events/search', [UserEventController::class, 'search'])
    ->name('events.search');

// Event Details
Route::get('/events/{event}', [UserEventController::class, 'show'])
    ->name('events.show');


// User Profile and Registration Routes
Route::middleware('auth')->group(function () {

    // Register for Event
    Route::post('/events/{event}/register', [RegistrationController::class, 'register'])
        ->name('events.register');

    // My Registrations
    Route::get('/my-registrations', [RegistrationController::class, 'myRegistrations'])
        ->name('my.registrations');

    // Cancel Registration
    Route::delete('/registrations/{registration}', [RegistrationController::class, 'cancel'])
        ->name('registrations.cancel');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';