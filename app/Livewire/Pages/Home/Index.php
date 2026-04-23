<?php

namespace App\Livewire\Pages\Home;

use App\Models\Article;
use App\Enums\ArticleStatus;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Index extends Component
{
    #[Computed]
    public function featuredArticle()
    {
        return Article::query()
            ->with(['category', 'author'])
            ->where('status', ArticleStatus::Published)
            ->latest('published_at')
            ->first();
    }

    #[Computed]
    public function trendingArticles()
    {
        $featuredId = $this->featuredArticle?->id;

        return Article::query()
            ->with(['category', 'author'])
            ->where('status', ArticleStatus::Published)
            ->when($featuredId, fn ($query) => $query->where('id', '!=', $featuredId))
            ->latest('published_at')
            ->take(12)
            ->get();
    }

    public function render()
    {
        return view('livewire.pages.home.index');
    }
}
