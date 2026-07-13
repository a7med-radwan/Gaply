<?php

namespace App\Models;

use App\Enums\CareerPlanStatus;
use App\Observers\CareerPlanObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class CareerPlan extends Model
{
    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'target_job',
        'missing_skills',
        'market_requirements',
        'readiness_score',
        'gap_summary',
        'improvement_plan',
        'status',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'missing_skills' => 'array',
            'market_requirements' => 'array',
            'readiness_score' => 'integer',
            'status' => CareerPlanStatus::class,
        ];
    }

    /**
     * Get the user that owns this career plan.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::observe(CareerPlanObserver::class);
    }

    /**
     * Scope a query to only include active career plans.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', CareerPlanStatus::Active);
    }

    /**
     * Scope a query to only include pending career plans.
     */
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', CareerPlanStatus::Pending);
    }

    /**
     * Check if the career plan is active.
     */
    public function isActive(): bool
    {
        return $this->status === CareerPlanStatus::Active;
    }

    /**
     * Check if the career plan is pending.
     */
    public function isPending(): bool
    {
        return $this->status === CareerPlanStatus::Pending;
    }
}
