<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SkillGapItem extends Model
{
    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'report_id',
        'skill_id',
    ];

    public function skillGapReport(): BelongsTo
    {
        return $this->belongsTo(SkillGapReport::class, 'report_id');
    }

    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }
}
