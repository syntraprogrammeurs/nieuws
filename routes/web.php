<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Pages\Home\Index as HomeIndex;
use App\Livewire\Pages\News\Index as NewsIndex;
use App\Livewire\Pages\Article\Show as ArticleShow;

Route::get('/', HomeIndex::class)->name('home');
Route::get('/ontdekken', NewsIndex::class)->name('news.index');
Route::get('/artikel/{article:slug}', ArticleShow::class)->name('article.show');

Route::middleware(['auth', 'admin'])->prefix('dashboard')->group(function () {
    Route::get('/', \App\Livewire\Pages\Admin\Dashboard::class)->name('dashboard');
    
    // Categorieën
    Route::get('/categorieen', \App\Livewire\Pages\Admin\Categories\Index::class)->name('admin.categories.index');
    Route::get('/categorieen/create', \App\Livewire\Pages\Admin\Categories\Form::class)->name('admin.categories.create');
    Route::get('/categorieen/{category}/edit', \App\Livewire\Pages\Admin\Categories\Form::class)->name('admin.categories.edit');

    // Artikels
    Route::get('/artikels', \App\Livewire\Pages\Admin\Articles\Index::class)->name('admin.articles.index');
    Route::get('/artikels/create', \App\Livewire\Pages\Admin\Articles\Form::class)->name('admin.articles.create');
    Route::get('/artikels/{article}/edit', \App\Livewire\Pages\Admin\Articles\Form::class)->name('admin.articles.edit');
});

require __DIR__.'/settings.php';
