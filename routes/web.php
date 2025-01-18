<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupportController;

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

// Landing Page Route
Route::get('/', function () {
    return view('welcome');
});

// Dashboard Route (Requires Authentication and Email Verification)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// AI Chat Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/live-support', [SupportController::class, 'showLiveSupport'])->name('live-support');
    Route::post('/chat', [SupportController::class, 'handleChat'])->name('chat');
});

// Include Auth Routes (For Breeze Authentication)
require __DIR__ . '/auth.php';
