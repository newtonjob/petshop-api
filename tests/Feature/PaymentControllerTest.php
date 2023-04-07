<?php

namespace Tests\Feature;

use App\Models\Payment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_payments_can_be_retrieved(): void
    {
        $this->signInAsAdmin();

        Payment::factory(5)->create();

        $response = $this->get(route('payments.index'));

        $this->assertNotEmpty($response['data']);
    }

    public function test_single_payment_can_be_retrieved(): void
    {
        $this->signInAsAdmin();

        $payment = Payment::factory()->create();

        $response = $this->get(route('payments.show', $payment))->assertOk();

        $this->assertSame($payment->uuid, $response['data']['uuid']);
    }

    public function test_payments_can_be_created(): void
    {
        $this->signInAsAdmin();

        $this->post(route('payments.store'), [
            'type'    => 'credit_card',
            'details' => fake()->creditCardDetails()
        ])->assertOk();
    }

    public function test_payments_can_be_updated(): void
    {
        $this->signInAsAdmin();
        $payment = Payment::factory()->create();

        $this->put(route('payments.update', $payment), [
            'type' => $type = 'credit_card'
        ])->assertOk();

        $payment->refresh();

        $this->assertSame($payment->type, $type);
    }

    public function test_payments_can_be_deleted(): void
    {
        $this->signInAsAdmin();
        $payment = Payment::factory()->create();

        $this->delete(route('payments.destroy', $payment))->assertOk();

        $this->assertDatabaseMissing(Payment::class, ['id' => $payment->id]);
    }
}
