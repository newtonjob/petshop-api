<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title'    => fake()->realText(35),
            'content'  => fake()->realText(),
            'metadata' => json_encode([
                'image'  => fake()->uuid(),
                'author' => fake()->name(),
            ])
        ];
    }
}
