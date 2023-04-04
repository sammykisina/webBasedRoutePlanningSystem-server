<?php

declare(strict_types=1);

namespace App\Http\Services\Auth;

use App\Models\User;

class ProfileService {
    public function getUserProfile(User $user): User {
        return User::query()
            ->where('id', $user->id)
            ->with([
                'paths',
            ])->first();
    }

    public function updatePassword(array $updatePasswordData): bool {
        $user = User::query()
            ->where('id', $updatePasswordData['userId'])
            ->first();

        return $user->update([
            'password' => $updatePasswordData['password']
        ]);
    }

    public function register(array $newUserData): User {
        return User::create($newUserData);
    }
}
