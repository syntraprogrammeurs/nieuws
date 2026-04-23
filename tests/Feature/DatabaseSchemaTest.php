<?php

use App\Models\User;
use App\Models\Category;
use App\Models\Article;
use App\Enums\ArticleStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('database schema is correct and mass assignment works', function () {
    $user = User::factory()->create(['role' => 'admin']);
    
    $category = Category::create([
        'name' => 'Technologie',
        'slug' => 'technologie',
        'description' => 'Alles over tech',
    ]);
    
    $article = Article::create([
        'title' => 'Nieuwe Tech',
        'slug' => 'nieuwe-tech',
        'excerpt' => 'Dit is een excerpt',
        'content' => 'Dit is de volledige content',
        'image' => 'image.jpg',
        'category_id' => $category->id,
        'author_id' => $user->id,
        'status' => ArticleStatus::Published,
    ]);
    
    expect($category->id)->toBeNumeric()
        ->and($category->name)->toBe('Technologie');
        
    expect($article->id)->toBeNumeric()
        ->and($article->title)->toBe('Nieuwe Tech')
        ->and($article->status)->toBe(ArticleStatus::Published);
        
    // Test foreign keys and relations
    expect($article->category->id)->toBe($category->id)
        ->and($article->author->id)->toBe($user->id)
        ->and($category->articles->first()->id)->toBe($article->id)
        ->and($user->articles->first()->id)->toBe($article->id);
});
