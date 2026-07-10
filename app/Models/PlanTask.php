<?php

namespace App\Models;

use App\Enums\PlanTaskStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlanTask extends Model
{
    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'plan_id',
        'skill_id',
        'title',
        'description',
        'order',
        'status',
        'completed_at',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => PlanTaskStatus::class,
            'order' => 'integer',
            'completed_at' => 'datetime',
        ];
    }

    public function developmentPlan(): BelongsTo
    {
        return $this->belongsTo(DevelopmentPlan::class, 'plan_id');
    }

    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }
}
