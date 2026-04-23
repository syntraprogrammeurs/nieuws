<?php

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use App\Livewire\Pages\Admin\Articles\Form;
use Livewire\Livewire;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin can create an article with image', function () {
    Storage::fake('public');
    
    $admin = User::factory()->create(['role' => 'admin']);
    $category = Category::factory()->create();
    $file = UploadedFile::fake()->image('article.jpg');
    
    Livewire::actingAs($admin)
        ->test(Form::class)
        ->set('title', 'New Article')
        ->set('excerpt', 'Test excerpt')
        ->set('content', 'Test content')
        ->set('category_id', $category->id)
        ->set('image', $file)
        ->set('status', 'published')
        ->call('save')
        ->assertRedirect('/dashboard/artikels');

    $this->assertDatabaseHas('articles', [
        'title' => 'New Article',
        'status' => 'published',
    ]);
    
    $article = Article::where('title', 'New Article')->first();
    expect($article->image)->not->toBeNull();
    
    // Check if file exists in storage
    $path = str_replace('/storage/', '', $article->image);
    Storage::disk('public')->assertExists($path);
});
