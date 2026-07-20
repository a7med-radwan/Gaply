<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    /**
     * Redirect the user to Google's OAuth page.
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle the callback from Google after authentication.
     */
    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::where('google_id', $googleUser->getId())
            ->orWhere('email', $googleUser->getEmail())
            ->first();

        if ($user) {
            // Update google_id if signing in with Google for the first time
            if (! $user->google_id) {
                $user->google_id = $googleUser->getId();
            }

            // If profile_image is empty or invalid URL, fetch and download the new one
            if (empty($user->profile_image) || str_starts_with($user->profile_image, 'http')) {
                $downloaded = $this->downloadGoogleAvatar($googleUser->getAvatar());
                if ($downloaded) {
                    $user->profile_image = $downloaded;
                }
            }

            $user->save();
        } else {
            // Download avatar for new users
            $avatarPath = $this->downloadGoogleAvatar($googleUser->getAvatar());

            // Create a new user automatically
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'username' => $this->generateUsername($googleUser->getName()),
                'profile_image' => $avatarPath,
                'email_verified_at' => now(),
                'password' => null,
            ]);
        }

        Auth::login($user, remember: true);

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Download Google Avatar and save it locally in public storage.
     * Only downloads from trusted Google domains.
     */
    protected function downloadGoogleAvatar(?string $url): ?string
    {
        if (! $url) {
            return null;
        }

        // Only trust Google's own CDN domains
        $parsed = parse_url($url);
        $host = $parsed['host'] ?? '';
        $trustedDomains = ['googleusercontent.com', 'googleapis.com'];
        $isTrusted = collect($trustedDomains)->contains(fn ($d) => str_ends_with($host, $d));

        if (! $isTrusted) {
            return null;
        }

        try {
            if (! Storage::disk('public')->exists('profile_images')) {
                Storage::disk('public')->makeDirectory('profile_images');
            }

            $fileContents = @file_get_contents($url);
            if ($fileContents) {
                $fileName = 'profile_images/'.Str::random(40).'.jpg';
                Storage::disk('public')->put($fileName, $fileContents);

                return $fileName;
            }
        } catch (\Exception $e) {
            return null;
        }

        return null;
    }

    /**
     * Generate a unique username based on Google display name.
     */
    protected function generateUsername(string $name): string
    {
        $base = Str::slug($name);
        $username = $base.'-'.Str::random(5);

        $attempts = 0;
        while (User::where('username', $username)->exists() && $attempts < 5) {
            $username = $base.'-'.Str::random(6);
            $attempts++;
        }

        return $username;
    }
}
