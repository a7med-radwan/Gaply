<?php

namespace App\Http\Controllers;

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
     * Show the professional profile page.
     */
    public function edit(): View
    {
        $user = auth()->user();

        $userSkills = $user->userSkills()->with('skill')->get();
        $allSkills = Skill::orderBy('name')->get();
        $jobTitles = config('job_titles');

        return view('profile.edit', compact('user', 'userSkills', 'allSkills', 'jobTitles'));
    }

    /**
     * Update the user's professional profile information (specialization, bio, image).
     */
    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $user = auth()->user();
        $data = $request->only(['specialization', 'bio']);

        if ($request->hasFile('profile_image')) {
            // Remove old image if it exists
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

            $data['profile_image'] = $request->file('profile_image')
                ->store('profile_images', 'public');
        }

        $user->update($data);

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

    /**
     * Add a new skill to the authenticated user's profile.
     */
    public function storeSkill(StoreUserSkillRequest $request): RedirectResponse
    {
        auth()->user()->userSkills()->create($request->validated());

        return redirect()->route('profile')->with('success', 'Skill added successfully.');
    }

    /**
     * Update the level of a user skill (ownership enforced).
     */
    public function updateSkill(UpdateUserSkillRequest $request, UserSkill $userSkill): RedirectResponse
    {
        abort_if($userSkill->user_id !== auth()->id(), 403);

        $userSkill->update($request->validated());

        return redirect()->route('profile')->with('success', 'Skill level updated.');
    }

    /**
     * Delete a user skill from the authenticated user's profile.
     */
    public function destroySkill(UserSkill $userSkill): RedirectResponse
    {
        abort_if($userSkill->user_id !== auth()->id(), 403);

        $userSkill->delete();

        return redirect()->route('profile')->with('success', 'Skill removed from your profile.');
    }

    /**
     * Update the user's target job.
     */
    public function updateTargetJob(Request $request): RedirectResponse
    {
        $request->validate([
            'target_job' => ['required', 'string', Rule::in(config('job_titles'))],
        ]);

        auth()->user()->update(['target_job' => $request->target_job]);

        return redirect()->route('profile')->with('success', 'Target job updated successfully.');
    }
}
