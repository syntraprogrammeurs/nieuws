<?php

namespace App\Livewire\Pages\Admin\Categories;

use App\Actions\Categories\CreateCategoryAction;
use App\Actions\Categories\UpdateCategoryAction;
use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

#[Layout('components.layouts.admin')]
class Form extends Component
{
    public ?Category $category = null;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|string|max:255|unique:categories,slug')]
    public string $slug = '';

    #[Validate('nullable|string')]
    public string $description = '';

    public function mount(?Category $category = null)
    {
        if ($category && $category->exists) {
            $this->category = $category;
            $this->name = $category->name;
            $this->slug = $category->slug;
            $this->description = $category->description ?? '';
        }
    }

    public function updatedName($value)
    {
        if (! $this->category || ! $this->category->exists) {
            $this->slug = \Illuminate\Support\Str::slug($value);
        }
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug' . ($this->category ? ',' . $this->category->id : ''),
            'description' => 'nullable|string',
        ];
    }

    public function save(CreateCategoryAction $createAction, UpdateCategoryAction $updateAction)
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
        ];

        if ($this->category && $this->category->exists) {
            $updateAction->execute($this->category, $data);
            session()->flash('status', 'Categorie succesvol bijgewerkt.');
        } else {
            $createAction->execute($data);
            session()->flash('status', 'Categorie succesvol aangemaakt.');
        }

        return $this->redirect('/dashboard/categorieen', navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.admin.categories.form');
    }
}
