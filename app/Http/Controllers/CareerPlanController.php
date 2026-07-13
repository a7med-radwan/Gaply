<?php

namespace App\Http\Controllers;

use App\Enums\CareerPlanStatus;
use App\Models\CareerPlan;
use App\Services\CareerPlanService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
    public function index(): View|RedirectResponse
    {
        $user = auth()->user();
        $careerPlan = $user->careerPlans()->latest()->first();

        if ($careerPlan && $careerPlan->isPending()) {
            return redirect()->route('career-plan.processing');
        }

        return view('career-plan.index', compact('user', 'careerPlan'));
    }

    /**
     * Display the career plan processing page.
     */
    public function processing(): View|RedirectResponse
    {
        $user = auth()->user();
        $careerPlan = $user->careerPlans()->latest()->first();

        if (!$careerPlan || !$careerPlan->isPending()) {
            return redirect()->route('career-plan.index');
        }

        return view('career-plan.processing');
    }

    /**
     * Generate a new career gap analysis and save the plan.
     */
    public function generate(): RedirectResponse
    {
        $user = auth()->user();

        try {
            $this->careerPlanService->generateForUser($user);

            return redirect()->route('career-plan.processing')
                ->with('status', 'Career gap analysis started in the background.');
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

    /**
     * Get AI generated interview questions for a missing skill.
     */
    public function interviewQuestions(Request $request): View|RedirectResponse
    {
        $user = auth()->user();
        $skillName = $request->query('skill_name');

        if (!$skillName || !$user->target_job) {
            return redirect()->route('career-plan.index')
                ->withErrors(['error' => 'Invalid parameters or missing target job.']);
        }

        try {
            $questions = $this->careerPlanService->generateInterviewQuestions($skillName, $user->target_job);

            return view('career-plan.questions', compact('user', 'skillName', 'questions'));
        } catch (\Exception $e) {
            return redirect()->route('career-plan.index')
                ->withErrors(['error' => 'Failed to generate interview questions: ' . $e->getMessage()]);
        }
    }

    /**
     * Display all missing skills for the user.
     */
    public function missingSkills(): View
    {
        $user = auth()->user();
        $careerPlan = $user->careerPlans()->latest()->first();
        $missingSkills = $careerPlan?->missing_skills ?? [];

        return view('career-plan.missing-skills', compact('user', 'missingSkills', 'careerPlan'));
    }
}
