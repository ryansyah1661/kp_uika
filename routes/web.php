<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

use App\Http\Controllers\DonationController;

Route::middleware(['auth'])->group(function () {
    Route::get('/donations', [DonationController::class, 'index'])->name('donations.index');
    Route::get('/donations/create', [DonationController::class, 'create'])->name('donations.create');
    Route::post('/donations', [DonationController::class, 'store'])->name('donations.store');
    Route::put('/donations/{donation}/approve', [DonationController::class, 'approve'])->name('donations.approve')->middleware('admin');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
