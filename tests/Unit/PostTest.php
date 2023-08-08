<?php

namespace Tests\Unit;

use App\Services\PostService;
use App\Traits\AssertArrayStructureTrait;
use Tests\TestCase;

class PostTest extends TestCase
{
    use AssertArrayStructureTrait;

    private PostService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new PostService();
    }

    public function test_get_posts_success(): void
    {
        $result = $this->service->getPostsFromCache();

        foreach ($result as $post) {
            $this->assertHasKeys($post);
        }
    }

    public function test_single_post_from_cache_success()
    {
        $post = $this->service->find(1);

        $this->assertHasKeys($post);
    }
}
