<?php

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use App\Enums\ArticleStatus;
use App\Livewire\Pages\News\Index;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('news page displays paginated articles', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();
    
    Article::factory()->count(15)->create([
        'category_id' => $category->id,
        'author_id' => $user->id,
        'status' => ArticleStatus::Published,
        'published_at' => now(),
    ]);

    Livewire::test(Index::class)
        ->assertViewHas('articles', function ($articles) {
            return $articles->count() === 12; // Per page
        })
        ->call('gotoPage', 2)
        ->assertViewHas('articles', function ($articles) {
            return $articles->count() === 3; // Remaining
        });
});

test('news page search filters articles', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();
    
    Article::factory()->create([
        'title' => 'Unique Search Term',
        'category_id' => $category->id,
        'author_id' => $user->id,
        'status' => ArticleStatus::Published,
        'published_at' => now(),
    ]);

    Article::factory()->count(5)->create([
        'title' => 'Regular Article',
        'category_id' => $category->id,
        'author_id' => $user->id,
        'status' => ArticleStatus::Published,
        'published_at' => now(),
    ]);

    Livewire::test(Index::class)
        ->assertViewHas('articles', function ($articles) {
            return $articles->count() === 6;
        })
        ->set('search', 'Unique')
        ->assertViewHas('articles', function ($articles) {
            return $articles->count() === 1;
        });
});

test('news page category filter works', function () {
    $user = User::factory()->create();
    $cat1 = Category::factory()->create();
    $cat2 = Category::factory()->create();
    
    Article::factory()->count(3)->create([
        'category_id' => $cat1->id,
        'author_id' => $user->id,
        'status' => ArticleStatus::Published,
        'published_at' => now(),
    ]);

    Article::factory()->count(2)->create([
        'category_id' => $cat2->id,
        'author_id' => $user->id,
        'status' => ArticleStatus::Published,
        'published_at' => now(),
    ]);

    Livewire::test(Index::class)
        ->call('selectCategory', $cat1->id)
        ->assertViewHas('articles', function ($articles) {
            return $articles->count() === 3;
        });
});
