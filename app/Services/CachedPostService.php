<?php

namespace App\Services;

use App\Interfaces\CachedPostsInterface;
use Illuminate\Cache\CacheManager;

class CachedPostService implements CachedPostsInterface
{
    const TTL = 60 * 5; # 5 minutes

    public function __construct(
        private readonly CacheManager $cache,
        private readonly PostService $service
    ) {}

    public function index(): array
    {
        return $this->cache->remember('posts', self::TTL, function () {
            return $this->service->getPostsFromCache();
        });
    }

    public function find(int $id): array
    {
        return $this->cache->remember('posts.'.$id, self::TTL, function () use ($id) {
            return $this->service->find($id);
        });
    }
}