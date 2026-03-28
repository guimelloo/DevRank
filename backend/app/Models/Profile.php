<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'github_username',
    'avatar_url',
    'score',
    'title',
    'tier',
    'repos_count',
    'stars_count',
    'followers_count',
])]

class Profile extends Model
{
    protected function casts(): array
    {
        return [
            'score' => 'integer',
            'repos_count' => 'integer',
            'stars_count' => 'integer',
            'followers_count' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}
