<?php

use App\Http\Controllers\CustomerInformationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', WelcomeController::class)->name('welcome');

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/customer', [CustomerInformationController::class, 'create'])->name('customer.create');
    Route::post('/customer', [CustomerInformationController::class, 'store'])->name('customer.store');
    Route::get('/customer/edit', [CustomerInformationController::class, 'edit'])->name('customer.edit');
    Route::patch('/customer/{id}', [CustomerInformationController::class, 'update'])->name('customer.update');

    Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles');
    Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
    Route::post('/vehicles/store', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::get('/vehicles/{id}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');
    Route::put('/vehicles/{id}/update', [VehicleController::class, 'update'])->name('vehicles.update');
    Route::delete('/vehicles/{id}/delete', [VehicleController::class, 'destroy'])->name('vehicles.destroy');

    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations/store', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations/{id}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
    Route::put('/reservations/{id}/update', [ReservationController::class, 'update'])->name('reservations.update');
    Route::delete('/reservations/{id}/delete', [ReservationController::class, 'destroy'])->name('reservations.destroy');
});

require __DIR__.'/auth.php';
