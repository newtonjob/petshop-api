<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_retrieved_users(): void
    {
        $user = User::factory()->admin()->create();
        User::factory(10)->create();

        $response = $this->be($user, 'api')->get(route('admin.users.index'));

        $this->assertNotEmpty($response['data']);
    }
}
