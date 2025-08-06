<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_user_can_create_post()
    {
        $user = User::factory()->create();

        $data = [
            'user_id' => $user->id,
            'body' => 'This is a test post.',
        ];

        $response = $this->postJson('/api/v1/posts', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['body' => 'This is a test post.']);

        $this->assertDatabaseHas('posts', ['body' => 'This is a test post.']);
    }

    public function test_user_can_update_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->putJson("/api/v1/posts/{$post->id}", [
            'body' => 'Updated body text',
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['body' => 'Updated body text']);

        $this->assertDatabaseHas('posts', ['body' => 'Updated body text']);
    }

    public function test_user_can_delete_post()
    {
        $post = Post::factory()->create();

        $response = $this->deleteJson("/api/v1/posts/{$post->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
