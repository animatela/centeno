<?php

use App\Http\Controllers\CustomerInformationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
});

require __DIR__.'/auth.php';
