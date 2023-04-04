<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use JustSteveKing\StatusCode\Http;

class LoginController extends Controller {
    public function __invoke(
        LoginRequest $request
    ): JsonResponse {
        $user = User::query()
            ->where('email', $request->get(key: 'email'))
            ->first();

        if (! $user || ! Hash::check(value: $request->get(key: 'password'), hashedValue: $user->password)) {
            return new JsonResponse(
                data: [
                    'error' => 1,
                    'message' => 'The credentials do not match our records.',
                ],
                status: Http::NOT_FOUND()
            );
        }

        $role = $user
            ->role()
            ->pluck('slug')
            ->all();

        $plainTextToken = $user
                ->createToken('webBasedRoutePlanning-api-token', $role)
                ->plainTextToken;

        return new JsonResponse(
            data: [
                'error' => 0,
                'message' => 'Welcome '.$user->name,
                'user' => [
                    'id' => $user->id,
                    'role' => $role[0],
                ],
                'token' => $plainTextToken
            ],
            status: Http::ACCEPTED()
        );
    }
}
