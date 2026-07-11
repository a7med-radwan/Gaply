<?php

namespace App\Models;

use App\Enums\CareerPlanStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
