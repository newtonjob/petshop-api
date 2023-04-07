<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Promotion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_posts_can_be_retrieved(): void
    {
        $this->signIn();

        Post::factory(10)->create();

        $response = $this->get(route('blog.index'));

        $this->assertNotEmpty($response['data']);
    }

    public function test_single_post_can_be_retrieved(): void
    {
        $this->signIn();

        $post = Post::factory()->create();

        $response = $this->get(route('blog.show', $post));

        $this->assertNotEmpty($response['data']);
        $this->assertSame($response['data']['uuid'], $post->uuid);
    }
}
