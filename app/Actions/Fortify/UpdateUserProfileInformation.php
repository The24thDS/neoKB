<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
  /**
   * Validate and update the given user's profile information.
   *
   * @param  mixed  $user
   * @param  array  $input
   * @return void
   */
  public function update($user, array $input)
  {
    $roleOptions = collect(config('general.roles'))->values()->toArray();

    Validator::make($input, [
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
      'photo' => ['nullable', 'image', 'max:1024'],
      'is_admin' => ['nullable', Rule::in($roleOptions)]
    ])->validateWithBag('updateProfileInformation');

    if (isset($input['photo'])) {
      $user->updateProfilePhoto($input['photo']);
    }

    if (
      $input['email'] !== $user->email &&
      $user instanceof MustVerifyEmail
    ) {
      $this->updateVerifiedUser($user, $input);
    } else {
      $fieldsToUpdate = [
        'name' => $input['name'],
        'email' => $input['email'],
      ];

      if ($user->is_admin) {
        $fieldsToUpdate = array_merge($fieldsToUpdate, ['is_admin' => $input['is_admin']]);
      }

      $user->forceFill($fieldsToUpdate)->save();
    }
  }

  /**
   * Update the given verified user's profile information.
   *
   * @param  mixed  $user
   * @param  array  $input
   * @return void
   */
  protected function updateVerifiedUser($user, array $input)
  {
    $fieldsToUpdate = [
      'name' => $input['name'],
      'email' => $input['email'],
      'email_verified_at' => null,
    ];

    if ($user->is_admin) {
      $fieldsToUpdate = array_merge($fieldsToUpdate, ['is_admin' => $input['is_admin']]);
    }

    $user->forceFill($fieldsToUpdate)->save();

    $user->sendEmailVerificationNotification();
  }
}
