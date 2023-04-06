<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            ['title' => 'Pet clean-up and odor control'],
            ['title' => 'Cat litter'],
            ['title' => 'Wet pet food'],
            ['title' => 'Pet oral care'],
            ['title' => 'Heartworm medication'],
            ['title' => 'Pet vitamins and supplements'],
            ['title' => 'Pet grooming supplies'],
            ['title' => 'Flea and tick medication'],
            ['title' => 'Pet treats and chews'],
        ])->each(fn ($item) => Category::create($item));
    }
}
