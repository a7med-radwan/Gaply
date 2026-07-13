<?php

use App\Http\Controllers\CareerPlanController;
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

    // Career Gap Analysis Plan
    Route::get('/career-plan', [CareerPlanController::class, 'index'])->name('career-plan.index');
    Route::post('/career-plan/generate', [CareerPlanController::class, 'generate'])->name('career-plan.generate');
    Route::patch('/career-plan/{careerPlan}/complete', [CareerPlanController::class, 'complete'])->name('career-plan.complete');

    // AI Tools Routes
    Route::post('/profile/optimize-bio', [ProfileController::class, 'optimizeBio'])->name('profile.optimize-bio');
    Route::post('/career-plan/interview-questions', [CareerPlanController::class, 'interviewQuestions'])->name('career-plan.interview-questions');
});

// Temporary route to run migrations on Render Free Tier
Route::get('/run-migrations-secure-123', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate:status');
        $statusOutput = \Illuminate\Support\Facades\Artisan::output();
        
        \Illuminate\Support\Facades\Artisan::call('migrate --force');
        $migrateOutput = \Illuminate\Support\Facades\Artisan::output();
        
        return '<pre>Status:\n' . $statusOutput . '\n\nMigration Output:\n' . $migrateOutput . '</pre>';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

