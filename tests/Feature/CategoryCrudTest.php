<?php

use App\Models\Category;
use App\Models\User;
use App\Livewire\Pages\Admin\Categories\Form;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin can create a category via livewire', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    
    Livewire::actingAs($admin)
        ->test(Form::class)
        ->set('name', 'New Category')
        ->set('slug', 'new-category')
        ->call('save')
        ->assertRedirect('/dashboard/categorieen');

    $this->assertDatabaseHas('categories', [
        'name' => 'New Category',
        'slug' => 'new-category',
    ]);
});

test('category name is required', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    
    Livewire::actingAs($admin)
        ->test(Form::class)
        ->set('name', '')
        ->call('save')
        ->assertHasErrors(['name' => 'required']);
});

test('category slug must be unique', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    Category::factory()->create(['slug' => 'existing-slug']);
    
    Livewire::actingAs($admin)
        ->test(Form::class)
        ->set('name', 'New Category')
        ->set('slug', 'existing-slug')
        ->call('save')
        ->assertHasErrors(['slug' => 'unique']);
});
