<?php

namespace App\Actions\Articles;

use App\Models\Article;
use Illuminate\Support\Str;
use App\Enums\ArticleStatus;

class UpdateArticleAction
{
    public function execute(Article $article, array $data): Article
    {
        $statusChangedToPublished = ($data['status'] ?? null) === ArticleStatus::Published && $article->status !== ArticleStatus::Published;

        $article->update([
            'title' => $data['title'],
            'slug' => $data['slug'] ?? Str::slug($data['title']),
            'excerpt' => $data['excerpt'],
            'content' => $data['content'],
            'image' => $data['image'] ?? $article->image,
            'category_id' => $data['category_id'],
            'status' => $data['status'] ?? $article->status,
            'published_at' => $statusChangedToPublished ? now() : $article->published_at,
        ]);

        return $article;
    }
}
