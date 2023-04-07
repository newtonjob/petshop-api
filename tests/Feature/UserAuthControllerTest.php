<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserAuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_login(): void
    {
        $user = User::factory()->create([
            'email' => 'jobnewton3@gmail.com'
        ]);

        $response = $this->post(route('user.login'), [
            'email'    => $user->email,
            'password' => 'userpassword'
        ]);

        $response->assertOk();
        $this->assertNotEmpty($response['data']['token']);
    }

    public function test_users_token_can_be_used_to_access_authenticated_routes(): void
    {
        $user  = User::factory()->create();
        $token = $user->createToken();

        $this->withToken($token)->get(route('orders.index'))->assertOk();

        $this->assertAuthenticatedAs($user);
    }

    public function test_users_can_logout(): void
    {
        $this->signIn();

        Auth::user()->createToken();

        $this->post(route('user.logout'))->assertOk();
        $this->assertTrue(Auth::user()->tokens()->doesntExist());
    }
}
