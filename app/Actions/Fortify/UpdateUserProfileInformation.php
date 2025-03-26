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
        // Verificar se a foto existe
        if ($user->profile_photo_path && Storage::exists('public/' . $user->profile_photo_path)) {
            // Deletar a foto do armazenamento
            Storage::delete('public/' . $user->profile_photo_path);

            // Remover o caminho da foto do banco de dados
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

        // Verifica se o diretório existe e remove todos os arquivos temporários
        if (is_dir($tempDirectory)) {
            $files = scandir($tempDirectory);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    unlink($tempDirectory . '/' . $file); // Deleta o arquivo
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
