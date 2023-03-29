<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authenticated\UpdatePasswordRequest;
use App\Http\Services\Auth\ProfileService;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class UpdatePasswordController extends Controller {
    public function __invoke(
        UpdatePasswordRequest $request,
        ProfileService $profileService
    ): JsonResponse {
        if ($profileService->updatePassword(updatePasswordData: $request->getUpdatedPasswordData())) {
            return response()->json(
                data: [
                    'error' => 0,
                    'message' => 'Password updated successfully.'
                ],
                status: Http::ACCEPTED()
            );
        } else {
            return response()->json(
                data: [
                    'error' => 1,
                    'message' => 'Something went wrong.Password not updated.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
