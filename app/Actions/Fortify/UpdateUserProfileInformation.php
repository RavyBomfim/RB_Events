<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        // Removes Livewire temporary files
        $this->removeLivewireTempFiles();

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
            ])->save();
        }
    }

    /**
     * Delete the user's profile photo.
     */
    public function deleteProfilePhoto(User $user)
    {
        $path = 'public/' . $user->profile_photo_path;

        if ($user->profile_photo_path && Storage::exists($path)) {
            // Delete the photo from storage
            Storage::delete($path);

            // Remove the photo path from the database
            $user->profile_photo_path = null;
            $user->save();
        }
    }


    /**
     * Removes Livewire temporary files stored in 'storage/app/livewire-tmp'.
     */
    protected function removeLivewireTempFiles()
    {
        $tempDirectory = storage_path('app/livewire-tmp');

        // Checks if the directory exists and removes all temporary files
        if (is_dir($tempDirectory)) {
            $files = scandir($tempDirectory);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    unlink($tempDirectory . '/' . $file); // Delete the file
                }
            }
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
