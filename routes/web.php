<?php

use App\Livewire\MySummits;
use App\Livewire\Leaderboard;
use App\Livewire\Summittracker;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/summit', Summittracker::class);
    Route::get('/my-summits', MySummits::class)->name('my-summits');
});

Route::get('/leaderboard', Leaderboard::class)->name('leaderboard');

require __DIR__.'/auth.php';
