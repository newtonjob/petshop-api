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
        $this->signInAsAdmin();

        User::factory(10)->create();

        $response = $this->get(route('admin.users.index'));

        $this->assertNotEmpty($response['data']);
    }

    public function test_admin_can_update_users(): void
    {
        $this->signInAsAdmin();
        $user = User::factory()->create();

        $this->put(route('admin.users.update', $user), [
            'first_name' => $name = fake()->firstName()
        ])->assertOk();

        $user->refresh();

        $this->assertSame($user->first_name, $name);
    }

    public function test_admin_cannot_update_an_admin_account(): void
    {
        $this->signInAsAdmin();
        $user = User::factory()->admin()->create();

        $this->put(route('admin.users.update', $user), [
            'first_name' => fake()->firstName()
        ])->assertForbidden();
    }

    public function test_admin_can_delete_users(): void
    {
        $this->signInAsAdmin();
        $user = User::factory()->create();

        $this->delete(route('admin.users.destroy', $user))->assertOk();

        $this->assertSoftDeleted($user);
    }
}
