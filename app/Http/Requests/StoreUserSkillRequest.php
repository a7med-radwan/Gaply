<?php

namespace App\Http\Requests;

use App\Enums\SkillLevel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserSkillRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'skill_name' => ['required', 'string', 'max:255'],
            'level' => ['required', Rule::enum(SkillLevel::class)],
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $skillName = trim($this->skill_name);
            if (empty($skillName)) {
                return;
            }
            if ($this->user()->skills()->where('name', $skillName)->exists()) {
                $validator->errors()->add('skill_name', 'You have already added this skill to your profile.');
            }
        });
    }
}
