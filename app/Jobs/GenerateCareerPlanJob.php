<?php

namespace App\Jobs;

use App\Ai\Agents\CareerGapAgent;
use App\Enums\CareerPlanStatus;
use App\Models\CareerPlan;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateCareerPlanJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public User $user,
        public CareerPlan $careerPlan
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->user->load('skills');

        $response = CareerGapAgent::make($this->user)->prompt(
            "Perform a full career gap analysis for this candidate who wants to become a {$this->user->target_job}."
        );

        $this->careerPlan->update([
            'missing_skills' => $response['missing_skills'] ?? [],
            'market_requirements' => $response['market_requirements'] ?? [],
            'readiness_score' => $response['readiness_score'] ?? 0,
            'gap_summary' => $response['gap_summary'] ?? '',
            'improvement_plan' => $response['improvement_plan'] ?? '',
            'status' => CareerPlanStatus::Active,
        ]);
    }
}
