<?php

namespace App\Http\Controllers\Profiles;

use App\Models\Profile;

class ProfilesService
{
    private Profile $profile;

    private function __construct(Profile $profile) {
        $this->profile = $profile;
    }
}
