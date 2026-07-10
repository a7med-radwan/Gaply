<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DevelopmentPlan extends Model
{
    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'job_title',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function planTasks(): HasMany
    {
        return $this->hasMany(PlanTask::class, 'plan_id');
    }
}
