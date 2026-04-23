<?php

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use App\Enums\ArticleStatus;
use App\Livewire\Pages\Article\Show;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('article page is accessible via slug and increments views', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();
    
    $article = Article::factory()->create([
        'category_id' => $category->id,
        'author_id' => $user->id,
        'status' => ArticleStatus::Published,
        'slug' => 'test-article',
        'views' => 10,
    ]);

    Livewire::test(Show::class, ['article' => $article])
        ->assertSee($article->title);

    $article->refresh();
    expect($article->views)->toBe(11);
});

test('article page contains correct seo tags', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();
    
    $article = Article::factory()->create([
        'category_id' => $category->id,
        'author_id' => $user->id,
        'status' => ArticleStatus::Published,
        'title' => 'SEO Test Article',
        'excerpt' => 'This is a test excerpt for SEO.',
    ]);

    $this->get(route('article.show', $article->slug))
        ->assertStatus(200)
        ->assertSee('<title>SEO Test Article - PinNews</title>', false)
        ->assertSee('<meta name="description" content="This is a test excerpt for SEO.">', false)
        ->assertSee('<meta property="og:title" content="SEO Test Article - PinNews">', false);
});
