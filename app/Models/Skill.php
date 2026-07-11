<?php

namespace App\Models;

use App\Enums\SkillLevel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Skill extends Model
{
    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'level',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'level' => SkillLevel::class,
        ];
    }

    /**
     * Get the user that owns this skill.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
