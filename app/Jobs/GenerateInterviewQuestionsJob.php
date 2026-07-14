<?php

namespace App\Jobs;

use App\Ai\Agents\InterviewQuestionsAgent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class GenerateInterviewQuestionsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $skillName,
        public string $targetJob
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $response = InterviewQuestionsAgent::make($this->skillName, $this->targetJob)->prompt(
            "Generate questions for skill: {$this->skillName} and target job: {$this->targetJob}."
        );

        $questions = $response['questions'] ?? [];

        $hash = md5(strtolower($this->skillName) . '_' . strtolower($this->targetJob));
        $cacheKey = 'interview_questions:' . $hash;
        $pendingKey = 'interview_questions_pending:' . $hash;

        // Cache the result for 24 hours
        Cache::put($cacheKey, $questions, now()->addDay());

        // Clear the pending status
        Cache::forget($pendingKey);
    }
}
