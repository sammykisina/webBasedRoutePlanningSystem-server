<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/**
 * version 1
 */
Route::prefix('v1')->as('v1:')->group(
    base_path('routes/v1/api.php')
);

/**
 * other versions
 */
