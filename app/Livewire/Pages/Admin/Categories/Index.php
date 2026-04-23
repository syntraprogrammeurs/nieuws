<?php

namespace App\Livewire\Pages\Admin\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class Index extends Component
{
    public function delete(Category $category)
    {
        $category->delete();
        session()->flash('status', 'Categorie succesvol verwijderd.');
    }

    public function render()
    {
        return view('livewire.pages.admin.categories.index', [
            'categories' => Category::latest()->get()
        ]);
    }
}
