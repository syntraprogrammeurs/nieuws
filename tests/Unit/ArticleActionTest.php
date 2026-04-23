<?php

use App\Actions\Articles\CreateArticleAction;
use App\Actions\Articles\UpdateArticleAction;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use App\Enums\ArticleStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);

test('CreateArticleAction creates an article', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();
    
    $action = new CreateArticleAction();
    $data = [
        'title' => 'New Article',
        'slug' => 'new-article',
        'excerpt' => 'Excerpt',
        'content' => 'Content',
        'category_id' => $category->id,
        'author_id' => $user->id,
        'status' => ArticleStatus::Published,
    ];

    $article = $action->execute($data);

    expect($article)
        ->title->toBe('New Article')
        ->status->toBe(ArticleStatus::Published)
        ->published_at->not->toBeNull();
});

test('UpdateArticleAction updates an article', function () {
    $article = Article::factory()->create(['status' => ArticleStatus::Draft]);
    $action = new UpdateArticleAction();
    $data = [
        'title' => 'Updated Title',
        'excerpt' => 'Updated Excerpt',
        'content' => 'Updated Content',
        'category_id' => $article->category_id,
        'status' => ArticleStatus::Published,
    ];

    $updated = $action->execute($article, $data);

    expect($updated)
        ->title->toBe('Updated Title')
        ->status->toBe(ArticleStatus::Published)
        ->published_at->not->toBeNull();
});
