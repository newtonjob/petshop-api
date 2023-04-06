<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PromotionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title'    => fake()->sentence(),
            'content'  => fake()->realText(),
            'metadata' => json_encode([
                'image'      => fake()->uuid(),
                'valid_from' => now()->subDay()->toDateString(),
                'valid_to'   => now()->addDays(3)->toDateString(),
            ])
        ];
    }
}
