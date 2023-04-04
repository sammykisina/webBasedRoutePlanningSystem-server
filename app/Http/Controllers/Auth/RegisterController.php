<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Services\Auth\ProfileService;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class RegisterController extends Controller {
    public function __invoke(
        RegisterRequest $request,
        ProfileService $service
    ): JsonResponse {
        if ($user = $service->register(
            newUserData: $request->getNewUserData()
        )) {
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
        } else {
            return new JsonResponse(
                data: [
                    'error' => 1,
                    'message' => 'Something went wrong.Account not created.'
                ],
                status: Http::NOT_ACCEPTABLE()
            );
        }
    }
}
