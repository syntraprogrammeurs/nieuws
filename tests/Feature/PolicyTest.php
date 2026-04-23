<?php

use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin can update any article', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $user = User::factory()->create(['role' => 'user']);
    
    $category = Category::create(['name' => 'Tech', 'slug' => 'tech']);
    $article = Article::create([
        'title' => 'Test', 'slug' => 'test', 'content' => 'Content', 
        'category_id' => $category->id, 'author_id' => $user->id
    ]);

    expect($admin->can('update', $article))->toBeTrue();
});

test('user can only update their own article', function () {
    $user1 = User::factory()->create(['role' => 'user']);
    $user2 = User::factory()->create(['role' => 'user']);
    
    $category = Category::create(['name' => 'Tech', 'slug' => 'tech']);
    $article1 = Article::create([
        'title' => 'Test 1', 'slug' => 'test-1', 'content' => 'Content', 
        'category_id' => $category->id, 'author_id' => $user1->id
    ]);

    expect($user1->can('update', $article1))->toBeTrue()
        ->and($user2->can('update', $article1))->toBeFalse();
});

test('only admin can update categories', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $user = User::factory()->create(['role' => 'user']);
    
    $category = Category::create(['name' => 'Tech', 'slug' => 'tech']);

    expect($admin->can('update', $category))->toBeTrue()
        ->and($user->can('update', $category))->toBeFalse();
});
