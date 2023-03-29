<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Models\User;
use App\Notifications\ForgotPassword;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class ForgotPasswordController extends Controller {
    public function __invoke(
        ForgotPasswordRequest $request
    ): JsonResponse {
        $user = User::query()->where('email', $request->get(key: 'email'))->first();

        $user->generateTwoFactorCode();
        $user->notify(new ForgotPassword);

        return new JsonResponse(
            data: [
                'error' => 0,
                'message' => 'Check you email for verification code to prove its you.',
                'user' => [
                    'id' => $user->id
                ],
            ],
            status: Http::ACCEPTED()
        );
    }
}
