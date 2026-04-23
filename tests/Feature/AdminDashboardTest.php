<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('guest cannot access admin dashboard', function () {
    $this->get('/dashboard')
        ->assertRedirect('/login');
});

test('regular user cannot access admin dashboard', function () {
    $user = User::factory()->create(['role' => 'user']);
    
    $this->actingAs($user)
        ->get('/dashboard')
        ->assertStatus(403);
});

test('admin can access admin dashboard', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    
    $this->actingAs($admin)
        ->get('/dashboard')
        ->assertStatus(200);
});
