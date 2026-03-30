<?php
use App\Http\Controllers\Users\UsersController;
use Illuminate\Support\Facades\Route;

Route::prefix('github')->group(function () {
    Route::get('/redirect', [UsersController::class, 'redirectToGithub']);
    Route::get('/callback', [UsersController::class, 'handleGithubCallback']);
});
