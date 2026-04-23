<?php

namespace App\Actions\Articles;

use App\Models\Article;
use Illuminate\Support\Str;
use App\Enums\ArticleStatus;

class CreateArticleAction
{
    public function execute(array $data): Article
    {
        return Article::create([
            'title' => $data['title'],
            'slug' => $data['slug'] ?? Str::slug($data['title']),
            'excerpt' => $data['excerpt'],
            'content' => $data['content'],
            'image' => $data['image'] ?? null,
            'category_id' => $data['category_id'],
            'author_id' => $data['author_id'],
            'status' => $data['status'] ?? ArticleStatus::Draft,
            'published_at' => ($data['status'] ?? null) === ArticleStatus::Published ? now() : null,
        ]);
    }
}
