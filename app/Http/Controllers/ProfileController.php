<?php

namespace App\Http\Controllers;

use App\Actions\FileUpload;
use App\Http\Requests\StoreUserSkillRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateUserSkillRequest;
use App\Models\Skill;
use App\Models\UserSkill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the professional profile.
     */
    public function show(): View
    {
        $user = auth()->user();

        return view('profile.show', compact('user'));
    }

    /**
     * Show the professional profile page.
     */
    public function edit(): View
    {
        $user = auth()->user();
        $jobTitles = config('job_titles');

        return view('profile.edit', compact('user', 'jobTitles'));
    }

    /**
     * Update the user's professional profile information (specialization, bio, image).
     */
    public function update(UpdateProfileRequest $request, FileUpload $fileUpload): RedirectResponse
    {
        $user = auth()->user();
        $data = $request->only(['name', 'email', 'experience', 'target_job']);

        $uploadedPath = $fileUpload->handle('profile_image', 'profile_images', 'public');
        if ($uploadedPath !== null) {
            // Remove old image if it exists
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

            $data['profile_image'] = $uploadedPath;
        }

        $user->update($data);

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }
}
