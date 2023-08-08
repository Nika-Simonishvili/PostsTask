<?php

namespace App\Repositories;

use App\Interfaces\PostRepositoryInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class PostRepository implements PostRepositoryInterface
{
    private string $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.jsonPlaceholder.posts.url');
    }

    public function store(array $request): string|Response
    {
        $response = Http::post($this->apiUrl, $request);

        if ($response->status() != 201) {
            return 'Something wrong with api';
        }

        return $response;
    }

    public function update(int $id, array $post): array
    {
        return Http::put($this->apiUrl . "/{$id}", $post)->json();
    }

    public function delete(int $id): array
    {
        return Http::put($this->apiUrl . "/{$id}",)->json();
    }
}