<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SkillGapReport extends Model
{
    /**
     * Disable the updated_at timestamp — reports are immutable once created.
     *
     * @var string|null
     */
    const UPDATED_AT = null;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'job_title',
        'readiness_percentage',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'readiness_percentage' => 'integer',
            'created_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function skillGapItems(): HasMany
    {
        return $this->hasMany(SkillGapItem::class, 'report_id');
    }
}
