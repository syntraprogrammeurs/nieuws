<?php

namespace App\Livewire\Pages\News;

use App\Models\Article;
use App\Models\Category;
use App\Enums\ArticleStatus;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Index extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public string $search = '';

    #[Url(history: true)]
    public ?int $selectedCategory = null;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function selectCategory(?int $categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.pages.news.index', [
            'articles' => Article::query()
                ->with(['category', 'author'])
                ->where('status', ArticleStatus::Published)
                ->when($this->search, fn ($query) => $query->where('title', 'like', '%' . $this->search . '%'))
                ->when($this->selectedCategory, fn ($query) => $query->where('category_id', $this->selectedCategory))
                ->latest('published_at')
                ->paginate(12),
            'categories' => Category::all(),
        ]);
    }
}
