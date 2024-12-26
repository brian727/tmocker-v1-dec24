<?php

use App\Livewire\MySummits;
use App\Livewire\Leaderboard;
use App\Livewire\Summittracker;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Redirect root to login if not authenticated
Route::get('/', function () {
    return redirect()->route('login');
});

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/summit', Summittracker::class);
    Route::get('/my-summits', MySummits::class)->name('my-summits');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

// Public routes
Route::get('/leaderboard', Leaderboard::class)->name('leaderboard');

require __DIR__.'/auth.php';
