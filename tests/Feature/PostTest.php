<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    public function test_homepage_has_posts()
    {
        $response = $this->get('/posts');

        $response->assertStatus(200);
        $response->assertSee('Title');
        $response->assertDontSee('No Posts yet.');
    }

    public function test_add_post_success(): void
    {
        $response = $this->post('/posts', $this->postArray());

        $response->assertStatus(302);
        $response->assertSessionHas('success');
    }


    public function test_add_update_success(): void
    {
        $response = $this->put('/posts/1', $this->postArray());

        $response->assertStatus(302);
        $response->assertSessionHas('success');
    }


    public function test_add_delete_success(): void
    {
        $response = $this->delete('/posts/1', $this->postArray());

        $response->assertStatus(302);
        $response->assertSessionHas('success');
    }

    public function postArray(): array
    {
        return [
            'userId' => 1,
            'title' => 'Post title.',
            'body' => 'Post body.',
        ];
    }
}
