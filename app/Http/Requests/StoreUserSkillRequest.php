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

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'skill_id' => [
                'required',
                'integer',
                Rule::exists('skills', 'id'),
                Rule::unique('user_skills')->where(function ($query) {
                    return $query->where('user_id', $this->user()->id);
                }),
            ],
            'level' => ['required', Rule::enum(SkillLevel::class)],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'skill_id.unique' => 'You have already added this skill to your profile.',
        ];
    }
}
