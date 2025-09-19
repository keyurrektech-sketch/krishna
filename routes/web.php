<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\VehicleController;
use Barryvdh\DomPDF\Facade\Pdf;

// Redirect root URL to /home if logged in, or to login otherwise
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return redirect()->route('login'); // or return view('welcome');
});

// Auth routes (login, register, forgot password, etc.)
Auth::routes();

// Home page after login
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('/register', [UserController::class, 'register'])->name('users.register');

// Protected routes (only accessible when logged in)
Route::middleware(['auth'])->group(function () {

    Route::get('/users/editindex', [UserController::class, 'editIndex'])->name('users.editIndex');

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('sales', SalesController::class);
    Route::resource('vehicle', VehicleController::class);

    Route::post('/vehicle/fetch-details', [VehicleController::class, 'fetchDetails'])->name('vehicle.details');

    Route::get('/settings/edit', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');

    

    
    Route::post('/change-password', [App\Http\Controllers\UserController::class, 'changePassword'])->name('user.changePassword');
    
    Route::get('/users/{user}/credentials-pdf', [UserController::class, 'streamPdf'])->name('users.credentials-pdf');
});

