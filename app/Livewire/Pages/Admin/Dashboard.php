<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.pages.admin.dashboard', [
            'stats' => [
                'articles' => Article::count(),
                'categories' => Category::count(),
                'views' => Article::sum('views'),
                'authors' => User::count(),
            ]
        ]);
    }
}
