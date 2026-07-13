<?php

namespace App\Observers;

use App\Models\CareerPlan;

class CareerPlanObserver
{
    /**
     * Handle the CareerPlan "created" event.
     */
    public function created(CareerPlan $careerPlan): void
    {
        // Delete all previous career plans for the same user
        $careerPlan->user->careerPlans()
            ->where('id', '!=', $careerPlan->id)
            ->delete();
    }
}
