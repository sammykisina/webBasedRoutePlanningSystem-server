<?php

declare(strict_types=1);

namespace App\Http\Controllers\Authenticated;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authenticated\StorePathRequest;
use App\Http\Services\Authenticated\PathService;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class PathStoreController extends Controller {
    public function __invoke(
        StorePathRequest $request,
        PathService $service
    ): JsonResponse {
        if ($service->storePath(newPathData: $request->validated())) {
            return new JsonResponse(
                data: [
                    'error' => 0,
                    'message' => 'Path store successfully.'
                ],
                status: Http::CREATED()
            );
        } else {
            return new JsonResponse(
                data: [
                    'error' => 1,
                    'message' => 'Something went wrong.Path not created.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
