<?php

declare(strict_types=1);

use App\Http\Controllers\Authenticated\PathStoreController;
use App\Http\Controllers\Authenticated\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'paths',
    'as' => 'paths:'
], function () {
    Route::post('/', PathStoreController::class)->name('pathStore');
});

/**
 * profile
 */
Route::get('/{user}/profile', ProfileController::class)->name('profile');
