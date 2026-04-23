<?php

namespace App\Livewire\Pages\Article;

use App\Models\Article;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Show extends Component
{
    public Article $article;

    public function mount(Article $article, \App\Services\SeoService $seo)
    {
        $this->article = $article;
        
        // Verhoog view counter
        $this->article->increment('views');

        // Set SEO data
        $seo->setForArticle($this->article);
    }

    public function render()
    {
        return view('livewire.pages.article.show');
    }
}
