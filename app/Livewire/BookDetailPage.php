<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Book;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Detail Buku - Grajavan')]
class BookDetailPage extends Component
{
    use LivewireAlert;

    public $book_id;
    public $quantity = 1;

    public function mount($book_id)
    {
        $this->book_id = $book_id;
    }

    public function increaseQty()
    {
        $this->quantity++;
    }

    public function decreaseQty()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

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
        return view('livewire.book-detail-page', [
            'book' => Book::where('id', $this->book_id)->firstOrFail(),
        ]);
    }
}
