<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    // Professional profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/skills', [ProfileController::class, 'storeSkill'])->name('profile.skills.store');
    Route::patch('/profile/skills/{userSkill}', [ProfileController::class, 'updateSkill'])->name('profile.skills.update');
    Route::delete('/profile/skills/{userSkill}', [ProfileController::class, 'destroySkill'])->name('profile.skills.destroy');
    Route::post('/profile/target-job', [ProfileController::class, 'updateTargetJob'])->name('profile.target-job.update');

    // Placeholder routes — redirect to profile until those features are built
    Route::get('/dashboard', fn() => redirect()->route('profile'))->name('dashboard');
    Route::get('/tasks', fn() => redirect()->route('profile'))->name('tasks.index');
    Route::get('/tasks/create', fn() => redirect()->route('profile'))->name('tasks.create');
});
