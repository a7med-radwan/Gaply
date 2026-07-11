<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
        $userId = auth()->id();

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $userId],
            'experience' => ['nullable', 'string', 'max:5000'],
            'profile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'target_job' => ['nullable', 'string', Rule::in(config('job_titles'))],
        ];
    }
}
