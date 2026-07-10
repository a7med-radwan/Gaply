<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Skill extends Model
{
    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'category',
    ];

    public function userSkills(): HasMany
    {
        return $this->hasMany(UserSkill::class);
    }

    public function jobSkills(): HasMany
    {
        return $this->hasMany(JobSkill::class);
    }

    public function skillGapItems(): HasMany
    {
        return $this->hasMany(SkillGapItem::class);
    }

    public function planTasks(): HasMany
    {
        return $this->hasMany(PlanTask::class);
    }
}
