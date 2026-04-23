<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = \App\Models\User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        $categories = [
            'Technologie', 'Architectuur', 'Fotografie', 'Design'
        ];

        $categoryModels = [];
        foreach ($categories as $cat) {
            $categoryModels[] = \App\Models\Category::create([
                'name' => $cat,
                'slug' => \Illuminate\Support\Str::slug($cat),
                'description' => "Alles over $cat",
            ]);
        }

        foreach ($categoryModels as $category) {
            \App\Models\Article::factory(10)->create([
                'category_id' => $category->id,
                'author_id' => $admin->id,
            ]);
        }
    }
}
