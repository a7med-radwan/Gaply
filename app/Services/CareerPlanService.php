<?php

namespace App\Services;

use App\Ai\Agents\InterviewQuestionsAgent;
use App\Enums\CareerPlanStatus;
use App\Models\CareerPlan;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use App\Jobs\GenerateCareerPlanJob;
use App\Jobs\GenerateInterviewQuestionsJob;
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
     * Get AI generated interview questions for a missing skill (via Cache / Background Job).
     */
    public function getInterviewQuestions(string $skillName, string $targetJob): array
    {
        $hash = md5(strtolower($skillName) . '_' . strtolower($targetJob));
        $cacheKey = 'interview_questions:' . $hash;
        $pendingKey = 'interview_questions_pending:' . $hash;

        // 1. If questions are cached, return them
        if ($questions = Cache::get($cacheKey)) {
            return [
                'status' => 'cached',
                'questions' => $questions,
            ];
        }

        // 2. If not pending, dispatch the generation job
        if (!Cache::has($pendingKey)) {
            Cache::put($pendingKey, true, now()->addMinutes(5));
            GenerateInterviewQuestionsJob::dispatch($skillName, $targetJob);
        }

        return [
            'status' => 'pending',
        ];
    }
}
