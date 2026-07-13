<?php

namespace App\Services;

use App\Actions\FileUpload;
use App\Ai\Agents\BioOptimizerAgent;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileService
{
    /**
     * Create a new ProfileService instance.
     */
    public function __construct(protected FileUpload $fileUpload) {}

    /**
     * Update the user's professional profile.
     */
    public function updateProfile(User $user, array $data): User
    {
        return DB::transaction(function () use ($user, $data) {
            $uploadedPath = $this->fileUpload->handle('profile_image', 'profile_images', 'public');
            if ($uploadedPath !== null) {
                // Remove old image if it exists
                if ($user->profile_image) {
                    Storage::disk('public')->delete($user->profile_image);
                }

                $data['profile_image'] = $uploadedPath;
            }

            $user->update($data);

            return $user;
        });
    }

    /**
     * Optimize the user's bio using AI.
     */
    public function optimizeBio(User $user, string $rawText): string
    {
        if (empty(trim($rawText))) {
            return '';
        }

        return BioOptimizerAgent::make($user, $rawText)->prompt(
            "Optimize the following biography text:\n\n" . $rawText
        );
    }
}
