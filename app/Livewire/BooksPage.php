<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\BookType;
use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Buku - Grajavan')]
class BooksPage extends Component
{
    use WithPagination;

    public function render()
    {
        $bookQuery = Book::where('is_active', 1);

        return view('livewire.books-page', [
            'books' => $bookQuery->paginate(6),
            'bookTypes' => BookType::where('is_active', 1)->get(),
            'categories' => Category::where('is_active', 1)->get(),
        ]);
    }
}
