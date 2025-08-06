<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StorePostRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_post_validation_fails_with_missing_fields()
    {
        $response = $this->postJson('/api/v1/posts', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['user_id', 'body']);
    }

    public function test_store_post_validation_fails_with_short_body()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/v1/posts', [
            'user_id' => $user->id,
            'body' => 'Hi',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['body']);
    }

    public function test_store_post_validation_passes()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/v1/posts', [
            'user_id' => $user->id,
            'body' => 'This is a valid post.',
        ]);

        $response->assertStatus(201);
    }
}
