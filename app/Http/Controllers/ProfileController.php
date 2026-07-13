<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Services\ProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Create a new ProfileController instance.
     */
    public function __construct(protected ProfileService $profileService) {}

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
    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $user = auth()->user();
        $data = $request->only(['name', 'email', 'experience', 'target_job']);

        $this->profileService->updateProfile($user, $data);

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }

    /**
     * Optimize user bio using AI.
     */
    public function optimizeBio(Request $request): JsonResponse
    {
        $user = auth()->user();
        $rawText = $request->input('experience', '');

        try {
            $optimizedText = $this->profileService->optimizeBio($user, $rawText);
            return response()->json([
                'success' => true,
                'optimized' => $optimizedText,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to optimize biography: ' . $e->getMessage(),
            ], 500);
        }
    }
}
