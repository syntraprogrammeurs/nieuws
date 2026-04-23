<?php

use App\Actions\Categories\CreateCategoryAction;
use App\Actions\Categories\UpdateCategoryAction;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);

test('CreateCategoryAction creates a category', function () {
    $action = new CreateCategoryAction();
    $data = [
        'name' => 'New Category',
        'slug' => 'new-category',
        'description' => 'Test description',
    ];

    $category = $action->execute($data);

    expect($category)->toBeInstanceOf(Category::class)
        ->name->toBe('New Category')
        ->slug->toBe('new-category')
        ->description->toBe('Test description');
});

test('UpdateCategoryAction updates a category', function () {
    $category = Category::factory()->create();
    $action = new UpdateCategoryAction();
    $data = [
        'name' => 'Updated Name',
        'slug' => 'updated-slug',
        'description' => 'Updated description',
    ];

    $updated = $action->execute($category, $data);

    expect($updated)
        ->name->toBe('Updated Name')
        ->slug->toBe('updated-slug')
        ->description->toBe('Updated description');
});
