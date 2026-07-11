<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    // Dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Professional Profile (Individual Routes)
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Dedicated User Skills (Resource Routes)
    Route::resource('skills', SkillController::class)->except(['create', 'show']);
});
