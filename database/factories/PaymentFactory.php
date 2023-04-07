<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'type'    => collect(['credit_card', 'cash_on_delivery', 'bank_transfer'])->random(),
            'details' => fake()->creditCardDetails()
        ];
    }
}
