<?php

namespace App\Models;

use App\Enums\JobSkillImportance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobSkill extends Model
{
    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'job_title',
        'skill_id',
        'importance',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'importance' => JobSkillImportance::class,
        ];
    }

    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }
}
