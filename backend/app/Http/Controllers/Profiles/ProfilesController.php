<?php

namespace App\Http\Controllers\Profiles;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Socialite;

class ProfilesController extends Controller
{
    private ProfilesService $profilesService;

    private function __construct(ProfilesService $profilesService) {
        $this->profilesService = $profilesService;
    }
}
