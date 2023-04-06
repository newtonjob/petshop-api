<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Post;
use App\Models\Promotion;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->admin()->create(['email' => 'admin@buckhill.co.uk']);
        User::factory(100)->create();
        Promotion::factory(4)->create();
        Post::factory(10)->create();
        Brand::factory(10)->create();

        $this->call(CategorySeeder::class);
    }
}
