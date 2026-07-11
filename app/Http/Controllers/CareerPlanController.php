<?php

namespace App\Http\Controllers;

use App\Ai\Agents\CareerGapAgent;
use App\Enums\CareerPlanStatus;
use App\Models\CareerPlan;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CareerPlanController extends Controller
{
    /**
     * Display the user's latest career plan.
     */
    public function index(): View
    {
        $user = auth()->user();
        $careerPlan = $user->careerPlans()->latest()->first();

        return view('career-plan.index', compact('user', 'careerPlan'));
    }

    /**
     * Generate a new career gap analysis and save the plan.
     */
    public function generate(): RedirectResponse
    {
        $user = auth()->user();

        if (! $user->target_job) {
            return redirect()->route('profile.edit')
                ->with('status', 'Please set your target job first before generating a career plan.');
        }

        if ($user->skills->isEmpty()) {
            return redirect()->route('skills.index')
                ->with('status', 'Please add at least one skill before generating a career plan.');
        }

        $user->load('skills');

        $response = CareerGapAgent::make($user)->prompt(
            "Perform a full career gap analysis for this candidate who wants to become a {$user->target_job}."
        );

        $user->careerPlans()->create([
            'target_job' => $user->target_job,
            'missing_skills' => $response['missing_skills'],
            'market_requirements' => $response['market_requirements'],
            'readiness_score' => $response['readiness_score'],
            'gap_summary' => $response['gap_summary'],
            'improvement_plan' => $response['improvement_plan'],
            'status' => CareerPlanStatus::Active,
        ]);

        return redirect()->route('career-plan.index')
            ->with('success', 'Career gap analysis completed successfully!');
    }

    /**
     * Mark a career plan as completed.
     */
    public function complete(CareerPlan $careerPlan): RedirectResponse
    {
        abort_if($careerPlan->user_id !== auth()->id(), 403);

        $careerPlan->update(['status' => CareerPlanStatus::Completed]);

        return redirect()->route('career-plan.index')
            ->with('success', 'Career plan marked as completed. Great work!');
    }
}
