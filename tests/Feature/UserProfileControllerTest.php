<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_retrieved_their_profile_data(): void
    {
        $this->signIn();

        $response = $this->get(route('user.show'));

        $response->assertOk();
        $this->assertSame($response['data']['uuid'], Auth::user()->uuid);
    }

    public function test_users_can_update_their_account(): void
    {
        $this->signIn();

        $this->put(route('user.update'), [
            'first_name' => $name = fake()->firstName()
        ])->assertOk();

        $this->assertSame(Auth::user()->first_name, $name);
    }

    public function test_users_can_delete_their_account(): void
    {
        $this->signIn();

        $this->delete(route('user.destroy'))->assertOk();
        $this->assertSoftDeleted(Auth::user());
    }
}
