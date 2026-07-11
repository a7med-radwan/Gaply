<?php

namespace App\Http\Requests;

use App\Enums\SkillLevel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserSkillRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $skill = $this->route('skill');
        $skillId = $skill instanceof \App\Models\Skill ? $skill->id : $skill;

        return [
            'skill_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('skills', 'name')->where(function ($query) {
                    return $query->where('user_id', $this->user()->id);
                })->ignore($skillId),
            ],
            'level' => ['required', Rule::enum(SkillLevel::class)],
        ];
    }
}
