<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PromotionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title'    => fake()->realText(35),
            'content'  => fake()->realText(),
            'metadata' => [
                'image'      => fake()->uuid(),
                'valid_from' => now()->subDay()->toDateString(),
                'valid_to'   => now()->addDays(3)->toDateString(),
            ]
        ];
    }
}
