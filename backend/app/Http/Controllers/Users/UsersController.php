<?php

namespace App\Http\Controllers\Users;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Socialite;

class UsersController extends Controller
{
    private $socialite;
    private UsersService $usersService;

    private function __construct(UsersService $usersService) {
        $this->usersService = $usersService;
        $this->socialite = Socialite::driver('github');
    }

    public function redirectToGithub() {
        return $this->socialite->redirect();
    }

    public function handleGithubCallback() {
        $githubUser = $this->socialite->user();

        return $this->usersService->createOrUpdateUser($githubUser);
    }
}
