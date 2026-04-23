<?php

namespace App\Livewire\Pages\Admin\Articles;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class Index extends Component
{
    use WithPagination;

    public function delete(Article $article)
    {
        $article->delete();
        session()->flash('status', 'Artikel succesvol verwijderd.');
    }

    public function render()
    {
        return view('livewire.pages.admin.articles.index', [
            'articles' => Article::latest()->paginate(10)
        ]);
    }
}
