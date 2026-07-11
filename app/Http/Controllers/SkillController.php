<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserSkillRequest;
use App\Http\Requests\UpdateUserSkillRequest;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SkillController extends Controller
{
    /**
     * Display a listing of the user's skills.
     */
    public function index(): View
    {
        $user = auth()->user();
        $userSkills = $user->skills()->get();

        return view('skills.index', compact('user', 'userSkills'));
    }

    /**
     * Store a newly created skill in storage.
     */
    public function store(StoreUserSkillRequest $request): RedirectResponse
    {
        auth()->user()->skills()->create([
            'name' => $request->skill_name,
            'level' => $request->level,
        ]);

        return redirect()->route('skills.index')->with('success', 'Skill added successfully.');
    }

    /**
     * Show the form for editing the specified skill.
     */
    public function edit(Skill $skill): View
    {
        abort_if($skill->user_id !== auth()->id(), 403);

        return view('skills.edit', compact('skill'));
    }

    /**
     * Update the specified skill in storage.
     */
    public function update(UpdateUserSkillRequest $request, Skill $skill): RedirectResponse
    {
        abort_if($skill->user_id !== auth()->id(), 403);

        $skill->update([
            'name' => $request->skill_name,
            'level' => $request->level,
        ]);

        return redirect()->route('skills.index')->with('success', 'Skill updated successfully.');
    }

    /**
     * Remove the specified skill from storage.
     */
    public function destroy(Skill $skill): RedirectResponse
    {
        abort_if($skill->user_id !== auth()->id(), 403);

        $skill->delete();

        return redirect()->route('skills.index')->with('success', 'Skill removed successfully.');
    }
}
