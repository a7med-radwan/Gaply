<?php

use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\CareerPlanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Google OAuth Routes
Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('auth.google.callback');

Route::middleware('auth')->group(function () {
    // Dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Professional Profile (Individual Routes)
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Dedicated User Skills (Resource Routes)
    Route::resource('skills', SkillController::class)->except(['create', 'show']);

    // Career Gap Analysis Plan
    Route::get('/career-plan', [CareerPlanController::class, 'index'])->name('career-plan.index');
    Route::get('/career-plan/processing', [CareerPlanController::class, 'processing'])->name('career-plan.processing');
    Route::post('/career-plan/generate', [CareerPlanController::class, 'generate'])->name('career-plan.generate');
    Route::patch('/career-plan/{careerPlan}/complete', [CareerPlanController::class, 'complete'])->name('career-plan.complete');
    Route::get('/career-plan/missing-skills', [CareerPlanController::class, 'missingSkills'])->name('career-plan.missing-skills');

    // AI Tools Routes
    Route::put('/profile/optimize-bio', [ProfileController::class, 'optimizeBio'])->name('profile.optimize-bio');
    Route::get('/career-plan/interview-questions', [CareerPlanController::class, 'interviewQuestions'])->name('career-plan.interview-questions');
});
