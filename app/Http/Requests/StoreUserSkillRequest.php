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
            'skill_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('skills', 'name')->where(function ($query) {
                    return $query->where('user_id', $this->user()->id);
                }),
            ],
            'level' => ['required', Rule::enum(SkillLevel::class)],
        ];
    }
}
