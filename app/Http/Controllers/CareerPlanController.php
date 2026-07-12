<?php

namespace App\Http\Controllers;

use App\Enums\CareerPlanStatus;
use App\Models\CareerPlan;
use App\Services\CareerPlanService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CareerPlanController extends Controller
{
    /**
     * Create a new CareerPlanController instance.
     */
    public function __construct(protected CareerPlanService $careerPlanService) {}

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

        try {
            $this->careerPlanService->generateForUser($user);

            return redirect()->route('career-plan.index')
                ->with('success', 'Career gap analysis completed successfully!');
        } catch (\Exception $e) {
            if ($e->getCode() === 400) {
                return redirect()->route('profile.edit')->with('status', $e->getMessage());
            }

            if ($e->getCode() === 401) {
                return redirect()->route('skills.index')->with('status', $e->getMessage());
            }

            throw $e;
        }
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
