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
        $total_count = CartManagement::addItemToCartWithQty($book_id, $this->quantity);

        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

        $this->alert('success', 'Buku berhasil ditambahkan ke keranjang!', [
            'position' => 'bottom-end',
            'timer' => 3000,
            'toast' =>true
        ]);
    }

    public function render()
    {
        $book = Book::with('reviews.user')->findOrFail($this->book_id);
        $reviews = $book->reviews()->with('user')->latest()->get();
        
        $totalReviews = $reviews->count();
        $averageRating = $reviews->avg('rating');

        $ratingCounts = [
            5 => $reviews->where('rating', 5)->count(),
            4 => $reviews->where('rating', 4)->count(),
            3 => $reviews->where('rating', 3)->count(),
            2 => $reviews->where('rating', 2)->count(),
            1 => $reviews->where('rating', 1)->count(),
        ];

        $ratingPercentages = [];
        foreach ($ratingCounts as $star => $count) {
            $ratingPercentages[$star] = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
        }

        return view('livewire.book-detail-page', [
            'book' => $book,
            'reviews' => $reviews,
            'totalReviews' => $totalReviews,
            'averageRating' => round($averageRating, 2),
            'ratingCounts' => $ratingCounts,
            'ratingPercentages' => $ratingPercentages,
        ]);
    }
}
