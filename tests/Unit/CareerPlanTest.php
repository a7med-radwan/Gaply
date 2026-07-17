<?php

namespace Tests\Unit;

use App\Enums\CareerPlanStatus;
use App\Models\CareerPlan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CareerPlanTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_determine_its_status(): void
    {
        $user = User::factory()->create();

        $activePlan = new CareerPlan([
            'user_id' => $user->id,
            'target_job' => 'Software Engineer',
            'status' => CareerPlanStatus::Active,
        ]);

        $pendingPlan = new CareerPlan([
            'user_id' => $user->id,
            'target_job' => 'Software Engineer',
            'status' => CareerPlanStatus::Pending,
        ]);

        $this->assertTrue($activePlan->isActive());
        $this->assertFalse($activePlan->isPending());

        $this->assertTrue($pendingPlan->isPending());
        $this->assertFalse($pendingPlan->isActive());
    }

    public function test_it_has_active_and_pending_scopes(): void
    {
        $user = User::factory()->create();

        $pendingPlan = $user->careerPlans()->create([
            'target_job' => 'Frontend Developer',
            'status' => CareerPlanStatus::Pending,
        ]);

        $this->assertCount(1, CareerPlan::pending()->get());
        $this->assertEquals($pendingPlan->id, CareerPlan::pending()->first()->id);

        $activePlan = $user->careerPlans()->create([
            'target_job' => 'Backend Developer',
            'status' => CareerPlanStatus::Active,
        ]);

        $this->assertCount(1, CareerPlan::active()->get());
        $this->assertEquals($activePlan->id, CareerPlan::active()->first()->id);
        $this->assertCount(0, CareerPlan::pending()->get());
    }

    public function test_creating_active_plan_deletes_other_plans_of_same_user(): void
    {
        $user = User::factory()->create();

        $completedPlan = $user->careerPlans()->create([
            'target_job' => 'Data Scientist',
            'status' => CareerPlanStatus::Completed,
        ]);

        $pendingPlan = $user->careerPlans()->create([
            'target_job' => 'Data Scientist',
            'status' => CareerPlanStatus::Pending,
        ]);

        $this->assertDatabaseHas('career_plans', ['id' => $completedPlan->id]);
        $this->assertDatabaseHas('career_plans', ['id' => $pendingPlan->id]);

        $activePlan = $user->careerPlans()->create([
            'target_job' => 'Data Scientist',
            'status' => CareerPlanStatus::Active,
        ]);

        $this->assertDatabaseMissing('career_plans', ['id' => $completedPlan->id]);
        $this->assertDatabaseMissing('career_plans', ['id' => $pendingPlan->id]);
        $this->assertDatabaseHas('career_plans', ['id' => $activePlan->id]);
    }
}
