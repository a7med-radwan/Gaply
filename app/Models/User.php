<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['name', 'email', 'password', 'username', 'experience', 'profile_image', 'target_job'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Interact with the user's name to sanitize inputs.
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn(?string $value) => $value ? strip_tags(trim($value)) : null,
        );
    }

    /**
     * Interact with the user's experience to sanitize inputs.
     */
    protected function experience(): Attribute
    {
        return Attribute::make(
            set: fn(?string $value) => $value ? strip_tags(trim($value)) : null,
        );
    }

    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class);
    }

    public function careerPlans(): HasMany
    {
        return $this->hasMany(CareerPlan::class);
    }
}
