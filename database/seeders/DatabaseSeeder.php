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
        $admin = \App\Models\User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Test Admin',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'admin',
            ]
        );

        $categories = [
            'Technologie', 'Architectuur', 'Fotografie', 'Design'
        ];

        foreach ($categories as $cat) {
            $category = \App\Models\Category::firstOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($cat)],
                [
                    'name' => $cat,
                    'description' => "Alles over $cat",
                ]
            );

            // Only seed articles if the category was just created or if we want to add more
            if ($category->articles()->count() === 0) {
                \App\Models\Article::factory(10)->create([
                    'category_id' => $category->id,
                    'author_id' => $admin->id,
                ]);
            }
        }
    }
}
