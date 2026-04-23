<?php

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use App\Enums\ArticleStatus;
use App\Livewire\Pages\Home\Index;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('home page component displays featured and trending articles', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();
    
    $featured = Article::factory()->create([
        'category_id' => $category->id,
        'author_id' => $user->id,
        'status' => ArticleStatus::Published,
        'published_at' => now(),
        'title' => 'Featured Article'
    ]);

    $trending = Article::factory()->count(3)->create([
        'category_id' => $category->id,
        'author_id' => $user->id,
        'status' => ArticleStatus::Published,
        'published_at' => now()->subDay(),
    ]);

    Livewire::test(Index::class)
        ->assertSee('Featured Article')
        ->assertSet('featuredArticle.id', $featured->id)
        ->assertCount('trendingArticles', 3);
});
