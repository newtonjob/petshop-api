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
            'Pet clean-up and odor control',
            'Pet vitamins and supplements',
            'Flea and tick medication',
            'Pet grooming supplies',
            'Pet treats and chews',
            'Heartworm medication',
            'Pet oral care',
            'Wet pet food',
            'Cat litter',
        ])->each(fn ($title) => Category::create(compact('title')));
    }
}
