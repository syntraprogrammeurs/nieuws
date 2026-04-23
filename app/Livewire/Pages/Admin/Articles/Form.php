<?php

namespace App\Livewire\Pages\Admin\Articles;

use App\Actions\Articles\CreateArticleAction;
use App\Actions\Articles\UpdateArticleAction;
use App\Models\Article;
use App\Models\Category;
use App\Enums\ArticleStatus;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;

#[Layout('components.layouts.admin')]
class Form extends Component
{
    use WithFileUploads;

    public ?Article $article = null;

    public string $title = '';
    public string $slug = '';
    public string $excerpt = '';
    public string $content = '';
    public $image;
    public ?int $category_id = null;
    public string $status = 'draft';

    public function mount(?Article $article = null)
    {
        if ($article && $article->exists) {
            $this->article = $article;
            $this->title = $article->title;
            $this->slug = $article->slug;
            $this->excerpt = $article->excerpt;
            $this->content = $article->content;
            $this->category_id = $article->category_id;
            $this->status = $article->status->value;
        }
    }

    public function updatedTitle($value)
    {
        if (! $this->article || ! $this->article->exists) {
            $this->slug = Str::slug($value);
        }
    }

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:articles,slug' . ($this->article ? ',' . $this->article->id : ''),
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'image' => $this->article ? 'nullable|image|max:2048' : 'required|image|max:2048',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published',
        ];
    }

    public function save(CreateArticleAction $createAction, UpdateArticleAction $updateAction)
    {
        $this->validate();

        $imagePath = $this->article?->image;
        if ($this->image) {
            $imagePath = $this->image->store('articles', 'public');
            $imagePath = '/storage/' . $imagePath;
        }

        $data = [
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'image' => $imagePath,
            'category_id' => $this->category_id,
            'author_id' => auth()->id(),
            'status' => ArticleStatus::from($this->status),
        ];

        if ($this->article && $this->article->exists) {
            $updateAction->execute($this->article, $data);
            session()->flash('status', 'Artikel succesvol bijgewerkt.');
        } else {
            $createAction->execute($data);
            session()->flash('status', 'Artikel succesvol aangemaakt.');
        }

        return $this->redirect('/dashboard/artikels', navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.admin.articles.form', [
            'categories' => Category::all()
        ]);
    }
}
