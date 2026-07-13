<?php

namespace App\Observers;

use App\Models\CareerPlan;
use App\Enums\CareerPlanStatus;

class CareerPlanObserver
{
    /**
     * Handle the CareerPlan "created" event.
     */
    public function created(CareerPlan $careerPlan): void
    {
        if ($careerPlan->isActive()) {
            $this->deleteOldPlans($careerPlan);
        }
    }

    /**
     * Handle the CareerPlan "updated" event.
     */
    public function updated(CareerPlan $careerPlan): void
    {
        if ($careerPlan->isDirty('status') && $careerPlan->isActive()) {
            $this->deleteOldPlans($careerPlan);
        }
    }

    /**
     * Delete all other career plans for the same user.
     */
    protected function deleteOldPlans(CareerPlan $careerPlan): void
    {
        $careerPlan->user->careerPlans()
            ->where('id', '!=', $careerPlan->id)
            ->delete();
    }
}
