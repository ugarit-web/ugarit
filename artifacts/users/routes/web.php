<?php

use Heritage\Support\Facades\Route;
use Ugarit\Artifacts\Users\Http\Controllers\Artifact\ArtifactController;
use Ugarit\Artifacts\Users\Http\Controllers\User\Capabilities\UserController as UserCapabilitiesController;

Route::middleware(['web', 'auth'])->prefix('panel/artifact/users')->group(function () {
    Route::get('/', [ArtifactController::class, 'show'])->name('users.artifact.show');

    Route::resource('user', UserCapabilitiesController::class);
});
