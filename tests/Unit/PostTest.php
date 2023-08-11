<?php

namespace Tests\Unit;

use App\Services\CachedPostService;
use App\Services\PostService;
use App\Traits\AssertArrayStructureTrait;
use Illuminate\Cache\CacheManager;
use Mockery;
use Tests\TestCase;

class PostTest extends TestCase
{
    use AssertArrayStructureTrait;

    public function test_posts_are_cached_successfully()
    {
        $cacheMock = Mockery::mock(CacheManager::class);

        $cacheMock->shouldReceive('remember')
            ->once()
            ->with('posts', CachedPostService::TTL, Mockery::type('Closure'))
            ->andReturn([]);

        $cachedPostService = new CachedPostService($cacheMock, Mockery::mock(PostService::class));

        $cachedPostService->index();
    }

    public function test_get_single_post_from_cache_success()
    {
        $id = 1;
        $cacheMock = Mockery::mock(CacheManager::class);

        $cacheMock->shouldReceive('remember')
            ->once()
            ->with("posts.{$id}", CachedPostService::TTL, Mockery::type('Closure'))
            ->andReturn([]);

        $cachedPostService = new CachedPostService($cacheMock, Mockery::mock(PostService::class));

        $cachedPostService->find($id);
    }
}
