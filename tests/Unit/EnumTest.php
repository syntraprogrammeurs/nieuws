<?php

use App\Enums\ArticleStatus;
use App\Enums\UserRole;

test('article status enum has correct values', function () {
    expect(ArticleStatus::Draft->value)->toBe('draft')
        ->and(ArticleStatus::Published->value)->toBe('published');
});

test('user role enum has correct values', function () {
    expect(UserRole::Admin->value)->toBe('admin')
        ->and(UserRole::User->value)->toBe('user');
});
