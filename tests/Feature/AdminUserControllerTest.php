<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminUserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_created(): void
    {
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)->post(route('admin.create'), [
            'first_name'            => fake()->firstName(),
            'last_name'             => fake()->lastName(),
            'email'                 => fake()->unique()->safeEmail(),
            'address'               => fake()->address(),
            'phone_number'          => fake()->unique()->phoneNumber(),
            'password'              => 'userpassword',
            'password_confirmation' => 'userpassword',
        ]);

        $response->assertOk();

        $this->assertNotEmpty($response['data']['token']);
    }
}
