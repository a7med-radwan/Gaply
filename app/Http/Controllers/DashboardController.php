<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the career readiness dashboard.
     */
    public function index(): View
    {
        $user = auth()->user();
        $targetJob = $user->target_job;
        $userSkills = $user->skills()->get();

        return view('dashboard', compact(
            'user',
            'targetJob',
            'userSkills'
        ));
    }
}
