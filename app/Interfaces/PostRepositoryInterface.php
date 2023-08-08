<?php

namespace App\Interfaces;

use App\Services\PostService;
use Illuminate\Http\Client\Response;

interface PostRepositoryInterface
{
    public function store(array $request): string|Response;
    public function update(int $id, array $post): array;
    public function delete(int $id): array;
}