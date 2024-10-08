<?php

namespace App\Livewire;

use Livewire\Component;

class Rating extends Component
{
    public $rating = 0;

    public function setRating($value)
    {
        $this->rating = $value;
        $this->dispatch('ratingUpdated', $this->rating);
    }

    public function render()
    {
        return view('livewire.rating');
    }
}
