<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OpenAIController;

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
    Route::get('/chat', [OpenAIController::class, 'index'])->name('chat'); // Chat page
    Route::post('/api/chat', [OpenAIController::class, 'chat']);          // Chat API endpoint
});

// Include Auth Routes (For Breeze Authentication)
require __DIR__ . '/auth.php';
