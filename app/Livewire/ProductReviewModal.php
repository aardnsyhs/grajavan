<?php

namespace App\Livewire;

use App\Models\Review;
use Livewire\Component;

class ProductReviewModal extends Component
{
    public $book;
    public $order;
    public $rating = 0;
    public $comment;
    public $userHasReviewed = false;

    protected $listeners = ['ratingUpdated' => 'setRating'];

    public function setRating($value)
    {
        $this->rating = $value;
    }

    public function mount($order)
    {
        $this->order = $order;

        $this->userHasReviewed = Review::where('user_id', auth()->id())
            ->whereHas('book', function($query) use ($order) {
                $query->where('id', $order->book_id);
            })
            ->exists();
    }

    public function submitReview()
    {
        foreach ($this->order->items as $item) {
            if (!$this->rating) {
                session()->flash('error', 'Silakan berikan rating.');
                return;
            }

            $alreadyReviewed = Review::where('user_id', auth()->id())
                ->where('book_id', $item->book_id)
                ->exists();

            if ($alreadyReviewed) {
                session()->flash('error', 'Anda sudah pernah memberikan review untuk buku: ' . $item->book->title);
                return;
            }

            Review::create([
                'user_id' => auth()->id(),
                'book_id' => $item->book_id,
                'rating' => $this->rating,
                'comment' => $this->comment,
            ]);
        }

        $this->userHasReviewed = true;
        session()->flash('success', 'Review Anda telah berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.product-review-modal');
    }
}
