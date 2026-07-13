<?php

namespace App\Services;

use App\Ai\Agents\CareerGapAgent;
use App\Ai\Agents\InterviewQuestionsAgent;
use App\Enums\CareerPlanStatus;
use App\Models\CareerPlan;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use App\Jobs\GenerateCareerPlanJob;
use Illuminate\Support\Facades\DB;

class CareerPlanService
{
    /**
     * Generate a new career gap analysis and save the plan.
     *
     * @throws \Exception
     */
    public function generateForUser(User $user): CareerPlan
    {
        if (!$user->target_job) {
            throw new \Exception('Please set your target job first before generating a career plan.', 400);
        }

        if ($user->skills->isEmpty()) {
            throw new \Exception('Please add at least one skill before generating a career plan.', 401);
        }

        $user->load('skills');

        return DB::transaction(function () use ($user) {
            $careerPlan = $user->careerPlans()->create([
                'target_job' => $user->target_job,
                'status' => CareerPlanStatus::Pending,
            ]);

            GenerateCareerPlanJob::dispatch($user, $careerPlan)->afterCommit();

            return $careerPlan;
        });
    }

    /**
     * Generate structured interview questions for a missing skill.
     */
    public function generateInterviewQuestions(string $skillName, string $targetJob): array
    {
        $cacheKey = 'interview_questions:' . md5(strtolower($skillName) . '_' . strtolower($targetJob));

        return Cache::remember($cacheKey, now()->addDay(), function () use ($skillName, $targetJob) {
            $response = InterviewQuestionsAgent::make($skillName, $targetJob)->prompt(
                "Generate questions for skill: {$skillName} and target job: {$targetJob}."
            );

            return $response['questions'] ?? [];
        });
    }
}
