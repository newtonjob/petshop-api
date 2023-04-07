<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_login(): void
    {
        $user = User::factory()->admin()->create([
            'email' => 'jobnewton3@gmail.com'
        ]);

        $response = $this->post(route('admin.login'), [
            'email'    => $user->email,
            'password' => 'admin'
        ]);

        $response->assertOk();
        $this->assertNotEmpty($response['data']['token']);
    }

    public function test_admin_token_can_be_used_to_access_authenticated_routes(): void
    {
        $user  = User::factory()->admin()->create();
        $token = $user->createToken();

        $this->withToken($token)->get(route('admin.users.index'))->assertOk();

        $this->assertAuthenticatedAs($user);
    }

    public function test_admin_can_logout(): void
    {
        $user = User::factory()->admin()->create();

        $user->createToken();

        $this->be($user, 'api')->post(route('admin.logout'))->assertOk();

        $this->assertTrue($user->tokens()->doesntExist());
    }
}
