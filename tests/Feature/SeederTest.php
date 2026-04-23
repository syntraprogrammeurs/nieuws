<?php

use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('database seeder runs correctly', function () {
    $this->artisan('db:seed');

    expect(User::where('email', 'admin@example.com')->exists())->toBeTrue()
        ->and(Category::count())->toBe(4)
        ->and(Article::count())->toBe(40);
});
