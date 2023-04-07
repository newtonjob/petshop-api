<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserOrderControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_retrieved_their_orders(): void
    {
        $this->signIn();

        $response = $this->get(route('user.orders.index'));

        $response->assertOk();
    }
}
