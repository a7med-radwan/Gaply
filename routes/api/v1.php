<?php

use App\Http\Controllers\Api\V1\CareerPlanController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/career-plans/active', [CareerPlanController::class, 'active']);
    Route::post('/career-plans/generate', [CareerPlanController::class, 'generate']);
});