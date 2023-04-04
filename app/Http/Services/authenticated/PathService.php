<?php

declare(strict_types=1);

namespace App\Http\Services\Authenticated;

use App\Models\Path;

class PathService {
    public function storePath(array $newPathData): Path {
        return Path::create($newPathData);
    }
}
