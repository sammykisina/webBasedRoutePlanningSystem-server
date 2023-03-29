<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\VerifyTwoFactorCodeRequest;
use App\Http\Services\Auth\ProfileService;
use App\Models\User;
use App\Notifications\RevokeLogin;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class VerifyTwoFactorCode {
    public function __invoke(
        VerifyTwoFactorCodeRequest $request,
        User $user,
        ProfileService $service
    ): JsonResponse {
        if ($user->twoFactorCode) {
            if ($user->twoFactorExpiresAt->lt(now())) {
                $user->resetTwoFactorCode();
                $user->tokens()->delete();

                return new JsonResponse(
                    data: [
                        'error' => 1,
                        'message' => "Code expired. Login to get a new one."
                    ],
                    status: Http::NOT_IMPLEMENTED()
                );
            } else {
                if ($request->get(key: 'twoFactorCode') === $user->twoFactorCode) {
                    if ($request->get(key:'forgotPassword')) {
                        // $service->systemUpdatePasswordAndNotifyUser(user: $user);
                        return new JsonResponse(
                            data: [
                                'error' => 0,
                                'message' => 'We updated your password for you.Check your email.',
                            ],
                            status: Http::ACCEPTED()
                        );
                    }

                    $role = $user
                        ->role()
                        ->pluck('slug')
                        ->all();

                    $plainTextToken = $user
                            ->createToken('secureLMS-api-token', $role)
                            ->plainTextToken;

                    $user->notify(new RevokeLogin);

                    return new JsonResponse(
                        data: [
                            'error' => 0,
                            'message' => 'Welcome '.$user->name,
                            'user' => [
                                'id' => $user->id,
                                'regNumber' => $user->regNumber,
                                'email' => $user->email,
                                'role' => $role[0],
                            ],
                            'token' => $plainTextToken,
                        ],
                        status: Http::ACCEPTED()
                    );
                } else {
                    return new JsonResponse(
                        data: [
                            'error' => 1,
                            'message' => 'The provided code is wrong'
                        ],
                        status: Http::NOT_IMPLEMENTED()
                    );
                }
            }
        } else {
            return new JsonResponse(
                data: [
                    'error' => 1,
                    'message' => "Your code does not much our records."
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
