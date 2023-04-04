<?php

declare(strict_types=1);

namespace App\Http\Controllers\Authenticated;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Services\Auth\ProfileService;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller {
    public function __invoke(
        User $user,
        ProfileService $service
    ): JsonResponse {
        return new JsonResponse(
            data: new UserResource(
                resource: $service->getUserProfile(
                    user: $user
                )
            )
        );
    }
}
