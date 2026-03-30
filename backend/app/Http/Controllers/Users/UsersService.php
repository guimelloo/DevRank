<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use Illuminate\Support\Facades\Http;

class UsersService
{
    private User $user;

    private function __construct(User $user) {
        $this->user = $user;
    }

    public function createOrUpdateUser($githubUser) {
        $userData = [
            'nickname' => $githubUser->getNickname(),
            'email' => $githubUser->getEmail(),
            'token' => $githubUser->token,
        ];

        $githubInfos = $this->getInfos($githubUser->getNickname());
        $profileData = $this->calculateData($githubInfos);

        $this->user->profile()->updateOrCreate(
            ['github_username' => $githubInfos['login']],
            [
                'github_username' => $githubUser->getNickname(),
                'avatar_url' => $githubInfos['avatar_url'] ?? null,
                'score' => $profileData['score'],
                'title' => $profileData['title'],
                'tier' => $profileData['tier'],
                'repos_count' => $githubInfos['public_repos'] ?? null,
                'stars_count' => $githubInfos['public_gists'] ?? null,
                'followers_count' => $githubInfos['followers'] ?? null,
            ]
        );

        return $this->user->updateOrCreate(
            ['github_username' => $githubUser->getNickname()],
            $userData
        );
    }

    private function getInfos($username) {
        $response = Http::get("https://api.github.com/users/{$username}");

        return $response->json();
    }

    private function calculateData($profileData) {
        $reposCount = $profileData['repos_count'] ?? 0;
        $followersCount = $profileData['followers_count'] ?? 0;
        $starsCount = $profileData['stars_count'] ?? 0;

        $score = ($reposCount * 2) * ($followersCount * 3) + ($starsCount * 1);

        return [
            'score' => $score,
            'title' => $score > 1000 ? 'Top Dev' : 'Rising Star',
            'tier' => $score > 1000 ? 'Gold' : 'Silver',
        ];
    }
}
