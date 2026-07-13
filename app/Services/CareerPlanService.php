<?php

namespace App\Services;

use App\Ai\Agents\CareerGapAgent;
use App\Ai\Agents\InterviewQuestionsAgent;
use App\Enums\CareerPlanStatus;
use App\Models\CareerPlan;
use App\Models\User;

class CareerPlanService
{
    /**
     * Generate a new career gap analysis and save the plan.
     *
     * @throws \Exception
     */
    public function generateForUser(User $user): CareerPlan
    {
        if (! $user->target_job) {
            throw new \Exception('Please set your target job first before generating a career plan.', 400);
        }

        if ($user->skills->isEmpty()) {
            throw new \Exception('Please add at least one skill before generating a career plan.', 401);
        }

        $user->load('skills');

        $response = CareerGapAgent::make($user)->prompt(
            "Perform a full career gap analysis for this candidate who wants to become a {$user->target_job}."
        );

        return $user->careerPlans()->create([
            'target_job' => $user->target_job,
            'missing_skills' => $response['missing_skills'],
            'market_requirements' => $response['market_requirements'],
            'readiness_score' => $response['readiness_score'],
            'gap_summary' => $response['gap_summary'],
            'improvement_plan' => $response['improvement_plan'],
            'status' => CareerPlanStatus::Active,
        ]);
    }

    /**
     * Generate structured interview questions for a missing skill.
     */
    public function generateInterviewQuestions(string $skillName, string $targetJob): array
    {
        $response = InterviewQuestionsAgent::make($skillName, $targetJob)->prompt(
            "Generate questions for skill: {$skillName} and target job: {$targetJob}."
        );

        return $response['questions'] ?? [];
    }
}
