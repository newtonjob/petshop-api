<?php

namespace Tests\Feature;

use App\Models\Promotion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PromotionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_promotions_can_be_retrieved(): void
    {
        $this->signIn();

        Promotion::factory(10)->create();

        $response = $this->get(route('promotions.index'));

        $this->assertNotEmpty($response['data']);
    }
}
