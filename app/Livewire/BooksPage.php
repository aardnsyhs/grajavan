<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Book;
use App\Models\BookType;
use App\Models\Category;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Buku - Grajavan')]
class BooksPage extends Component
{
    use WithPagination;
    use LivewireAlert;

    #[Url]
    public $selected_categories = [];

    #[Url]
    public $selected_bookType = [];
    
    #[Url]
    public $price_range = 350000;

    #[Url]
    public $sort = 'latest';

    // add product to cart method
    public function addToCart($book_id)
    {
        $total_count = CartManagement::addItemToCart($book_id);

        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

        $this->alert('success', 'Buku berhasil ditambahkan ke keranjang!', [
            'position' => 'bottom-end',
            'timer' => 3000,
            'toast' =>true
        ]);
    }

    public function render()
    {
        $bookQuery = Book::query()->where('is_active', 1);

        if (!empty($this->selected_categories)) {
            $bookQuery->whereIn('category_id', $this->selected_categories);
        }
        
        if (!empty($this->selected_bookType)) {
            $bookQuery->where('book_type_id', $this->selected_bookType);
        }

        if ($this->price_range) {
            $bookQuery->whereBetween('price', [0, $this->price_range]);
        }

        if ($this->sort === 'latest') {
            $bookQuery->latest();
        }

        if ($this->sort === 'price') {
            $bookQuery->orderBy('price');
        }

        return view('livewire.books-page', [
            'books' => $bookQuery->paginate(6),
            'bookTypes' => BookType::where('is_active', 1)->get(['id', 'name']),
            'categories' => Category::where('is_active', 1)->get(['id', 'name']),
        ]);
    }
}
