<?php

namespace App\Services;

use App\Actions\FileUpload;
use App\Models\User;
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
    }
}
