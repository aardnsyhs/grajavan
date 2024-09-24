<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Detail Buku - Grajavan')]
class BookDetailPage extends Component
{
    public $book_id;

    public function mount($book_id)
    {
        $this->book_id = $book_id;
    }

    public function render()
    {
        return view('livewire.book-detail-page', [
            'book' => Book::where('id', $this->book_id)->firstOrFail(),
        ]);
    }
}
