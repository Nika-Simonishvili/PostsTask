<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class PostService
{
    public function getPostsFromCache(): array
    {
        return Http::get(config('services.jsonPlaceholder.posts.url'))->json();
    }

    public function find(int $id): array
    {
        return Http::get(config('services.jsonPlaceholder.posts.url')."/{$id}")->json();
    }
}