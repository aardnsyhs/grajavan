<?php

namespace App\Livewire;

use App\Models\BookType;
use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Home Page - Grajavan')]
class HomePage extends Component
{
    public function render()
    {
        $bookTypes = BookType::where('is_active', 1)->get();
        $categories = Category::where('is_active', 1)->get();

        return view('livewire.home-page', [
            'bookTypes' => $bookTypes,
            'categories' => $categories
        ]);
    }
}
