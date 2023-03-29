<?php

declare(strict_types=1);

namespace App\Http\Services\Auth;

use App\Models\User;
use App\Notifications\SystemPasswordUpdate;
use Illuminate\Support\Facades\Hash;

class ProfileService {
    // public function getStudentProfile(User $student): User {
    //     return User::query()
    //         ->where('id', $student->id)
    //         ->with([
    //             'course.units',
    //             'results.task.unit',
    //         ])->first();
    // }

    public function updatePassword(array $updatePasswordData): bool {
        $user = User::query()
            ->where('email', $updatePasswordData['email'])
            ->first();

        return $user->update([
            'password' => $updatePasswordData['password']
        ]);
    }

    // public function systemUpdatePasswordAndNotifyUser(User $user) {
    //     $user->update([
    //         'password' => Hash::make(value: $user->regNumber)
    //     ]);

    //     $user->notify(new SystemPasswordUpdate);
    // }
}
